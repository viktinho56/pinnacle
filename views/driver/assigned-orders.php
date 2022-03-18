<?php


require __DIR__ . '/../../helpers/session-checker.php';
require __DIR__ . '/../../partials/header.php';
require __DIR__ . '/../../partials/drivernavbar.php';

?>
<div class="full-panel mt-6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-9 mx-auto grid-margin mb-4 mb-xl-0">
        <div class="row">
          <div class="col-3">
        
           
          </div>
          <div class="col-9">
            <h4 class="font-weight-bold  text-left text-dark">Welcome <span id="username"><?php echo $_SESSION['forename']; ?></span> to your Dashboard</h4>
            <p class="font-weight-normal mb-2 text-muted"></p>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xl-9 d-flex mx-auto grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-dark">
                      Order Date
                    </th>
                    <th class="text-dark">
                     Tracking No
                    </th>
                    <th class="text-dark">
                    Shipment Service
                    </th>
                    <th class="text-dark">
                    Status
                    </th>
                   
                    <th class="text-dark">
                    Option
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in order_arr">
                    <td class="py-1">
                      {{item.created}}
                    </td>
                    <td>
                     
                    {{item.trackingnumber}}
          
            </td>
                    <td>
                    {{item.delivery_method}}
                    </td>
                    
            <td>
              {{item.order_status}}
            </td>
            <td>
            <button data-toggle="modal" data-target="#exampleModal" @click="UpdateOrder(item.order_id)" type="button" class="btn btn-sm btn-success mr-2">Update Order</button>
            </td>
           
            </tr>
            </tbody>
            </table>
          </div>
        </div>
        <div>
       
        </div>
      </div>

    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
                    <label for="exampleFormControlSelect1">Large select</label>
                    <select v-model="ostatus" class="form-control form-control-lg" id="exampleFormControlSelect1">
                    <option>Select Status</option> 
                    <option value="0">Awaiting Assignment</option>
                      <option value="1">Awaiting Pickup</option>
                      <option value="2">In Transit</option>
                      <option value="3">Delivered</option>
                     
                    </select>
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button @click="SaveChanges()" type="button" class="btn btn-info">Save changes</button>
      </div>
    </div>
  </div>
</div>


    </div>
</div>
<script>
  var app = new Vue({
    el: '.full-panel',
    data() {
      return {
        id: '<?php echo $_SESSION["driverid"] ?>',
       order_arr: [],
       order_id:"",
       ostatus:"Select Status"

      };
    },
    methods: {
        UpdateOrder(x){
            this.order_id = x;
        },
        SaveChanges(){
            Notiflix.Confirm.Show(
          'Confirm',
          'Are you sure you want to Update the status of this order?',
          'Yes',
          'No',
          function okCb() {
            app.SendToServer();
        },
          function cancelCb() {
            //this.classList.add('hide');
          }, {
            width: '320px',
            borderRadius: '8px',
            // etc...
          },
        );
        },
        Send() {
        axios.get('../../api/order/view_assigned_orders.php?id=<?php echo $_SESSION["driverid"] ?>').then(response => {
          if (response.data.code == 0) {
            
           
          } else {
           
            this.order_arr = response.data;
          console.log(this.order_arr);
           
          }
          
        }).finally(() => {
            $('#myTable').DataTable();
                });
      },
      SendToServer() {
             
             if(app.ostatus != "Select Status"){
                var bodyFormData = new FormData();
             
             bodyFormData.append('orderid', this.order_id);
             
             bodyFormData.append('status', this.ostatus);
             

             axios({
                     method: "post",
                     url: "../../api/order/update_status.php",
                     data: bodyFormData,
                 })
                 .then(function(response) {
                     console.log(response.data.code);
                     if (response.data.code == 1) {
                         Notiflix.Report.Success(
                             'Success',
                             '"Updated Successfully"',
                             'Close',
                         );
                         setTimeout(function() {
                             window.location.href = 'assigned-orders';
                         }, 2000); //run this after 3 seconds

                     } else {
                         Notiflix.Report.Failure(
                             'Error',
                             response.data.message,
                             'Close',
                         );
                     }

                     console.log(response.data);
                 })
                 .catch(function(response) {
                     //handle error
                     console.log(response);
                 });
        
             }
             else{

             }
    }
    },
  
    mounted() {
        this.Send();
    },

  });
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  