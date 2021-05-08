 <template>

  <div class="row">
        <div class="col-md-12">
            <div class="row">
                
                        <div class="col-md-3">
							<div class="form-group">
								<div class="form-group">
                                    <label class="col-form-label">From <span class="text-danger">*</span></label>
                                        <date-picker display-format="MM" format="YYYY-MM-DD" locale="en" v-model="form.from" ></date-picker>
                                </div>       
                            </div>
						</div>
                        
                        <div class="col-md-3">
							<div class="form-group">
								<div class="form-group">
                                    <label class="col-form-label">To <span class="text-danger">*</span></label>
                                    <date-picker display-format="MM" format="YYYY-MM-DD" locale="en" v-model="form.to" ></date-picker>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label"># Adults<span class="text-danger">*</span></label>
                                        <input v-model="form.adults" type="number" name="adults"
                                        class="form-control">
                                        
                                    </div>
                        </div>
                        <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label"># Childrens<span class="text-danger">*</span></label>
                                        <input v-model="form.childrens" type="number" name="choldrens"
                                        class="form-control">
                                    </div>
                        </div>
                

                 

                 
            </div>
            <div class="submit-section">
                <button class="btn btn-info  btn-block" @click="load_filter">Generate</button>
            </div>
        </div>

  
                <div class="col-md-12 mt-5">
                            
                                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="receipt_transactions">
                        <thead>
                            <tr>
                                <th>{{ 'ID'}}</th>
                                <th>{{ 'Hotel'}}</th>
                                <th>{{ 'Date'}}</th>
                               
                                <th>{{ 'Adult Rate'}}</th>
                                <th>{{ 'Children Rate'}}</th>
                                 <th>Total Rate Of Adults</th>
                                <th>Total Rate Of Children</th>
                                <th>{{ 'Unit Total' }}</th>
                                <th>{{ 'Total' }}</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr v-for="rate in rates.data" :key="rate.id">
                                <td>{{rate.id}}</td>
                                <td>{{rate.hotel.name}}</td>
                                <td>{{rate.date}}</td>
                                <td>{{rate.adult_rate_per_night}}</td>
                                <td>{{rate.children_rate_per_night}}</td>
                                <td>{{rate.adult_rate_per_night * Number(form.adults)}}</td>
                                <td>{{rate.children_rate_per_night* Number(form.childrens)}}</td>
                                <td>{{rate.adult_rate_per_night + rate.children_rate_per_night}}</td>
                                <td>{{(rate.adult_rate_per_night * Number(form.adults)) + (rate.children_rate_per_night * Number(form.childrens)) }}</td>
                                
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


 </template>
<script>

export default {
 
    data(){
        return{
            rates:{},
            form:{
                from:'',
                to:'',
                adults:'',
                childrens:''
            },
            
        }
    
    },
    methods:{
        getResults(page = 1) {
                axios.get('/filter/?page=' + page)
                    .then(response => {
                        this.$Progress.start();
                        this.rates = response.data;
                        this.$Progress.finish();
                    });
            },
        
        load_filter(){
            axios.post('/filter',this.form).then(({data}) => (this.rates = data))
        }
    },
    created(){
         Fire.$on('AfterEvent',() => {
                this.load_filter();
            });
        
    },

    mounted(){

    }
  
    
}
</script>