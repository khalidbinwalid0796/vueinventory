 <template>
    <div>
        <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Search Order</li>
      </ol>
        <!-- Icon Cards-->
       <div class="row container">
          <div class="card col-lg-12">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Search Orders 
              <router-link to="/order" class="btn btn-sm btn-info" id="add_new"> Today Order</router-link>
            </div>
            <div class="row">
            	<div class="col-lg-6">
            	  <form @submit.prevent="searchDate">
    	            <div class="card-body">
      	            <div class="form-group">
      		            <div class="form-row">
      		               <div class="col-md-12">
      		                <div class="form-group">
            						    <label for="exampleFormControlSelect2">Search By Date</label>
            						    <input type="date" required="" class="form-control" v-model="date">
            						  </div>
      		               </div><br>
      		               <button type="submit" class="btn btn-success">Search</button>
      		            </div>
      		          </div>     
    		          </div>
  	            </form>
            	</div>
            	<div class="col-lg-6">
  	            <div class="card-body">
  	                <div class="form-group">
  		              <div class="form-row">
  		               <div class="col-md-12">
  		               <div class="form-group">
  		                   <label for="exampleFormControlSelect2">Search By Month</label>
  		                   <select  class="form-control" id="exampleFormControlSelect2" >
  		                     <option value="January">January</option>
  		                     <option value="February">February</option>
  		                     <option value="March">March</option>
  		                     <option value="April">April</option>
  		                     <option value="May">May</option>
  		                     <option value="june">june</option>
  		                     <option value="July">July</option>
  		                     <option value="August">August</option>
  		                     <option value="September">September</option>
  		                     <option value="October">October</option>
  		                     <option value="November">November</option>
  		                     <option value="December">December</option>
  		                   </select>
  		                 </div>
  		               </div><br>
  		               <button type="submit" class="btn btn-success">Search</button>
  		             </div>
  		            </div>     
  		          </div>
            	</div>
            </div>
          </div>
        </div>

      <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
           Order  Details 
          </div>
          <div class="card-body">
             <div class="row">
              <div class="table-responsive">
                  <table class="table table-bordered" id="" width="100%" cellspacing="0">

                    <thead>
                      <tr >
                        <th>Name</th>
                        <th>Qty</th>
                        <th>SubTotal</th>
                        <th>Vat</th>
                        <th>Total</th>
                        <th>Pay</th>
                        <th>Due</th>
                      </tr>
                    </thead>
                  
                    <tbody>

                      <tr v-for="order in orders">
                        <td>{{ order.name }}</td>
                        <td>{{ order.qty }}</td>
                        <td>{{ order.sub_total }}</td>
                        <td>{{ order.vat }}</td>
                        <td>{{ order.total }}</td>
                        <td>{{ order.pay }}</td>
                        <td>{{ order.due }}</td>
                      </tr> 
          
                    </tbody>

                    <tfoot>
                      <td></td>
                      <td>{{ quantity }}</td>
                      <td>{{ subtotal }}</td>
                      <td></td>
                      <td>{{ total }}</td>
                      <td>{{ pay }}</td>
                      <td>{{ due }}</td>
                    </tfoot>

                  </table>
                </div>
              </div> 
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
         </div>
      </div>
    </div>
</template>

<script>

    export default {
    	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            } 
        },
        data(){
        	return{
        			date :'',        		
              orders:{}
        	}
        },
        
      computed:{
         quantity(){
           let sum=0;
           for(let i =0; i < this.orders.length; i++ ){
              sum += (parseFloat(this.orders[i].qty));
           }
           return sum;
         },

         subtotal(){
            let sum=0;
              for(let i =0; i < this.orders.length; i++){
              sum += (parseFloat(this.orders[i].pro_quantity) * parseFloat(this.orders[i].sub_total));
            }
            return sum;
         },
        total(){
            let sum=0;
              for(let i =0; i < this.orders.length; i++){
              sum += (parseFloat(this.orders[i].pro_quantity) * parseFloat(this.orders[i].total));
            }
            return sum;
         },
          pay(){
            let sum=0;
              for(let i =0; i < this.orders.length; i++){
              sum += (parseFloat(this.orders[i].pro_quantity) * parseFloat(this.orders[i].pay));
            }
            return sum;
         },
          due(){
            let sum=0;
              for(let i =0; i < this.orders.length; i++){
              sum += (parseFloat(this.orders[i].pro_quantity) * parseFloat(this.orders[i].due));
            }
            return sum;
         },
      },

        methods:{ 	
        	searchDate(){
            var data = {date:this.date}
        		axios.post('/api/search/order',data)
            .then(({data}) => (this.orders = data))
        		.catch(error => this.errors = error.response.data.errors)
        	}
        	
        }
    	
    }

</script>

<style>
	
#add_new{
	float: right;
}

</style>
