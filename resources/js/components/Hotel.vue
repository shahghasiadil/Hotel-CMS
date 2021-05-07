<template>
    <div>
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                
                    <h3 class="page-title">{{ 'Hotel' }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{ 'dashboard'  }}</a></li>
                        <li class="breadcrumb-item active">{{ 'Hotels' }}</li>
                        
                    </ul>
                </div>
               
                <div class="col-auto float-right ml-auto">
                    <a href="javascript:void(0);" class="btn add-btn" @click="new_modal"><i class="fa fa-plus"></i> {{ 'Add' }} </a>
                </div>
            </div>
        </div>
        <div class="row">
            
        <div class="col-auto float-right ml-auto mb-3">
            <input type="text" :placeholder="'search'" v-model="search_input" @keyup="search_it"  class="form-control" name="" id="">    
        </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="receipt_transactions">
                        <thead>
                            <tr>
                                <th>{{ 'ID'}}</th>
                                <th>{{ 'Name'}}</th>
                                <th>{{ 'Stars'}}</th>
                                <th>{{ 'Address'}}</th>
                                <th>{{ 'Action' }}</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr v-for="hotel in hotels.data" :key="hotel.id">
                                <td>{{hotel.id}}</td>
                                <td>{{hotel.name}}</td>
                                <td>{{hotel.stars}}</td>
                                <td>{{hotel.address}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" @click="edit_modal(hotel)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" @click="delete_hotel(hotel.id)"><i class="fa fa-trash m-r-5"></i> Delete</a>                                                
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="hotels" @pagination-change-page="getResults">
                        <span slot="prev-nav">&lt; {{ 'previous'  }}</span>
	                    <span slot="next-nav"> {{ 'next'  }} &gt;</span>
                    </pagination>
                </div>
            </div>
        </div>
        <!-- Edit Hotel Modal -->
        <div id="add_hotel" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="edit_mode" class="modal-title">Edit Hotel</h5>
                        <h5 v-show="!edit_mode" class="modal-title">Add Hotel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="edit_mode ? update_hotel() : create_hotel()" >
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input v-model="form.name" type="text" name="name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Stars <span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="form.stars" name="stars" title="stars" data-live-search="true" >
                                            <option  v-for="(star,id) in stars" :key="id" :value="star">
                                                {{ star}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group row">
										<div class="col-lg-12">
									<textarea rows="4" cols="30" class="form-control" placeholder="Enter Address" v-model="form.address"></textarea>
										</div>
								</div>
                                </div>
                                
                            </div>
                            <div class="submit-section">
                                <button v-show="edit_mode" class="btn btn-primary submit-btn">Update</button>
                                <button v-show="!edit_mode" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Hotel Modal -->
    </div>
</template>

<script>

    export default {
        data() {
            return {
                edit_mode: false,
                hotels: {},
                search_input: '',
                stars:[1,2,3,4,5,6,7,8],

                form: new form({
                    id:'',
                    name:'',
                    address:'',
                    stars:'',
                })
            }
        },
        methods: {
            //Search methds
            search_it() {
                let query = this.search_input;
                axios.get('search_hotel?q=' + query)
                .then((data) => {
                    this.hotels = data.data
                })
                .catch(e => console.log('404'))

            },
            //pagination
            getResults(page = 1) {

                axios.get('get_hotel/?page=' + page)
                    .then(response => {
                        this.$Progress.start();

                        this.hotels = response.data;

                        this.$Progress.finish();

                    });
            },
            // this method we open a modal for both edit and adding new hotel
            new_modal() {
                this.edit_mode = false;
                this.form.reset();
                $('#add_hotel').modal('show');
            },

            edit_modal(hotel) {
                this.edit_mode = true;
                this.form.reset();
                $('#add_hotel').modal('show');
                this.form.fill(hotel);
            },

            //this method goes to hotel.store and store hotel data
            create_hotel() {
                 this.form.post('hotel')
                .then((res)=>{
                    $('#add_hotel').modal('hide');

                    this.$Progress.start();
                        toast.fire({
                        icon: 'success',
                        title: 'Hotel created successfully'
                        });
                    Fire.$emit('AfterEvent');

                    this.$Progress.finish();
                    console.log(res)
                })
                .catch(( err)=>{
                        console.log(err)
                });
                
            },

            // update hotel
            update_hotel() 
            {
                this.form.put('hotel/'+this.form.id)
                .then((res)=>{

                    $('#add_hotel').modal('hide');

                    this.$Progress.start();

                    Fire.$emit('AfterEvent');
                        toast.fire({
                        icon: 'success',
                        title: 'Hotel updated successfully'
                        });
                    this.$Progress.finish();
                    console.log(res)
                })
                .catch(()=>{

                });
            },
            // this function goes to hotel.index and returns data and then we save it into hotels object
            load_hotels() {

              
                     axios.get('get_hotel').then(({data}) => (this.hotels = data));
            
               
              
            },

            delete_hotel(id) {
               
                    swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        if (result.isConfirmed) {

                            this.form.delete('hotel/'+id).then(()=>{
                                swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                            Fire.$emit('AfterEvent');

                            }).catch(()=>{
                                swal.fire(
                                    'Failed!',
                                    'There was something wrong.',
                                    'warning'
                                    )
                            })
                        }
                    })
                
               
            }
        },
        created() {
            this.load_hotels()
            Fire.$on('AfterEvent',() => {
                this.load_hotels();
            });
        }
    }
</script>
