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
                                        <input v-model="form.choldrens" type="number" name="choldrens"
                                        class="form-control">
                                    </div>
                        </div>
                

                 

                 
            </div>
            <div class="submit-section">
                <button class="btn btn-info  btn-block" @click="load_filter">Generate</button>
            </div>
        </div>
  
                <div class="col-md-12 mt-5">
                                <table class="table table-bordered custom-table" id="report">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Project</th>
                                            <th>Budgetcode</th>
                                            <th>Budget Category Code</th>
                                            <th>Expensecode</th>
                                            <th>Unit</th>
                                            <th># of Activities</th>
                                            <th>Unit Cost</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8"></th>
                                            <th  style="text-align:right">Total: &nbsp; </th>
                                            <th width="15%"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>


 </template>
<script>
import $ from "jquery"
import DataTable from 'datatables.net-dt'

export default {
 
    data(){
        selected:null
        return{
            rates:{},
            form:new form({
                from:'',
                to:'',
                adults:'',
                childrens:''
            }),
            dataTable:null,
            
        }
    
    },
    methods:{
        load_filters(){
            axios.post('/filter?data='+this.form).then((response) => {
                response.data.data.forEach(rates =>{
                    this.dataTable.row.add([
                                rates.id,
                                rates.hotel.name,
                                rates.from,
                                rates.to,
                                rates.adult_rate_per_night,
                                rates.children_rate_per_night,
                                
        ]).draw(false);
       
    })
            
            }).catch(err => console.log(err));
        
        }
,
InitDataTable(){
   this.dataTable =  $('#report').DataTable( {
    dom: 'Bfrtip',
    searching: true,
    paging: false,
    info: true,
    "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
               var total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
 
                var numFormat = $.fn.dataTable.render.number( '\,', '.', 0, ).display;
                  $( api.column( 9).footer() ).html(
                    numFormat( total )
            );
        },
    buttons: [
        {
            extend: 'excel',
            title: 'Agency for Assisstance and Development of Afghanistan',
            message: ' ',
            text : '<i class="fa fa-file-excel-o"> Excel</i>',
            footer:true,
            exportOptions: {
                stripHtml: true,
                columns:':visible'
            }
        },
        {
            extend: 'pdf',
            title: 'Agency for Assisstance and Development of Afghanistan',
            message: ' ',
            text: '<i class="fa fa-file-pdf-o"> PDF</i>',
            pageSize: 'A4',
            download: 'open',
            orientation: 'landscape',
            footer:true,
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            },
            customize : function(doc) {
                doc.content[2].table.widths = [ '5%', '8%', '8%', '20%', '15%', '15%', '9%','10%','10%'];
                doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 8 
                doc.styles.tableHeader.fontSize = 8,
                doc.styles.tableHeader.alignment = 'left';
                doc.styles.tableBodyEven.alignment = 'left';
                doc.styles.tableBodyOdd.alignment = 'left'; 
            }
        },
       
    ]
    
} );
    }
    },
    created(){
        
    },

    mounted(){
        this.InitDataTable();
      
    }
  
    
}
</script>