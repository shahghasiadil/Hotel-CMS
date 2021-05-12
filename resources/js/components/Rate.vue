<template>
    <div>
        <div class="page-header" >
            <div class="row align-items-center">
                <div class="col">
                
                    <h3 class="page-title">{{ 'Rates' }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{ 'dashboard'  }}</a></li>
                        <li class="breadcrumb-item active">{{ 'Rates' }}</li>
                        
                    </ul>
                </div>
               
                <div class="col-auto float-right ml-auto">
                    <a href="javascript:void(0);" class="btn add-btn" @click="new_modal"><i class="fa fa-plus"></i> {{ 'Add' }} </a>
                </div>
            </div>
        </div>
        <div class="row" >
            
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
                                <th>{{ 'Hotel'}}</th>
                                <th>{{ 'Date Range'}}</th>
                                <th>{{ 'Adult Rate'}}</th>
                                <th>{{ 'Children Rate'}}</th>
                                <th>{{ 'Action' }}</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr v-for="rate in rates.data" :key="rate.id">
                                <td>{{rate.id}}</td>
                                <td>{{rate.hotel.name}}</td>
                                <td>{{`${rate.from}  -  ${rate.to}`}}</td>
                                <td>{{rate.adult_rate_per_night}}</td>
                                <td>{{rate.children_rate_per_night}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" @click="edit_modal(rate)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" @click="delete_rate(rate.id)"><i class="fa fa-trash m-r-5"></i> Delete</a>                                                
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="rates" @pagination-change-page="getResults">
                        <span slot="prev-nav">&lt; {{ 'previous'  }}</span>
	                    <span slot="next-nav"> {{ 'next'  }} &gt;</span>
                    </pagination>
                </div>
            </div>
        </div>
        <!-- Edit Rate Modal -->
        <div id="add_rate" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="edit_mode" class="modal-title">Edit Rate</h5>
                        <h5 v-show="!edit_mode" class="modal-title">Add Rate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="edit_mode ? update_rate() : create_rate()" >
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Hotles <span class="text-danger">*</span></label>
                                        <select class="form-control" v-model="form.hotel_id" name="hotel" title="hotel" data-live-search="true" >
                                            <option  v-for="(hotel,id) in hotels" :key="id" :value="id">
                                                {{ hotel}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Adult Rate Per Night<span class="text-danger">*</span></label>
                                        <input v-model="form.adult_rate_per_night" type="text" name="adult_rate_per_night"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('adult_rate_per_night') }">
                                        <has-error :form="form" field="adult_rate_per_night"></has-error>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Children Rate Per Night<span class="text-danger">*</span></label>
                                        <input v-model="form.children_rate_per_night" type="text" name="adult_rate_per_night"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('children_rate_per_night') }">
                                        <has-error :form="form" field="children_rate_per_night"></has-error>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group">
										<div class="form-group">
                                        <label class="col-form-label">From <span class="text-danger">*</span></label>
                                        <date-picker display-format="MM" format="YYYY-MM-DD" locale="en" v-model="form.from" ></date-picker>
										</div>
									</div>
							    </div>
                                <div class="col-sm-6">
									<div class="form-group">
										<div class="form-group">
                                        <label class="col-form-label">To <span class="text-danger">*</span></label>
                                        <date-picker display-format="MM" format="YYYY-MM-DD" locale="en" v-model="form.to" ></date-picker>
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
        <!-- /Edit Rate Modal -->
    </div>
</template>

<script>

    export default {
        data() {
            return {
                edit_mode: false,
                hotels: {},
                rates:{},
                search_input: '',
                form: new form({
                    id:'',
                    hotel_id:'',
                    from:'',
                    to:'',
                    adult_rate_per_night:'',
                    children_rate_per_night:'',
                })
            }
        },
        methods: {
            //Search methds
            search_it() {
                let query = this.search_input;
                axios.get('search_rate?q=' + query)
                .then((data) => {
                    this.rates = data.data
                })
                .catch(e => console.log('404'))

            },
            //pagination
            getResults(page = 1) {

                axios.get('get_rate/?page=' + page)
                    .then(response => {
                        this.$Progress.start();
                        this.rates = response.data;
                        this.$Progress.finish();


                    });
            },
            // this method we open a modal for both edit and adding new rates
            new_modal() {
                this.edit_mode = false;
                this.form.reset();
                $('#add_rate').modal('show');
            },

            edit_modal(rate) {
                this.edit_mode = true;
                this.form.reset();
                $('#add_rate').modal('show');
                this.form.fill(rate);
            },

            //this method goes to RateController.store and store rate data
            create_rate() {
                 this.form.post('rate')
                .then((res)=>{
                    $('#add_rate').modal('hide');

                    this.$Progress.start();
                        toast.fire({
                        icon: 'success',
                        title: 'Rate created successfully'
                        });
                    Fire.$emit('AfterEvent');

                    this.$Progress.finish();
                    console.log(res)
                })
                .catch(( err)=>{
                        console.log(err)
                });
                
            },

            // update rate
            update_rate() 
            {
                this.form.put('rate/'+this.form.id)
                .then((res)=>{

                    $('#add_rate').modal('hide');

                    this.$Progress.start();

                    Fire.$emit('AfterEvent');
                        toast.fire({
                        icon: 'success',
                        title: 'Rate updated successfully'
                        });
                    this.$Progress.finish();
                    console.log(res)
                })
                .catch(()=>{

                });
            },
            // this function goes to RateController.index and returns data and then we save it into rates object
            load_rates() {
               
                axios.get('get_rate').then(({data}) => (this.rates = data));
            },
            load_hotels(){
                axios.get('get_hotels').then(({data}) => (this.hotels = data));
            }
            ,

            delete_rate(id) {
               
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

                            this.form.delete('rate/'+id).then(()=>{
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
            this.load_rates()
            Fire.$on('AfterEvent',() => {
                this.load_rates();
            });
        }
    }
</script>
