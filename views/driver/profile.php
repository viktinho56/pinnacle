<?php


require __DIR__ . '/../../helpers/session-checker.php';
require __DIR__ . '/../../partials/header.php';
require __DIR__ . '/../../partials/drivernavbar.php';

?>
<div id="myid" class="full-panel mt-6">
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
        <div class="row">
                <div class="col-sm-12 mb-4 mb-xl-0">
                   

                </div>
            </div>
            <div class="row mt-3">

            <div class="col-md-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bold text-dark">Update Profile</h4>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Forename</label>
                      <input v-model="forename" type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input v-model="email" disabled type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact Number</label>
                      <input v-model="phone" type="phone" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                  
                    <button @click="Check" type="button" class="btn btn-success mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
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
       phone: '<?php echo $_SESSION["phone"] ?>',
                email: '<?php echo $_SESSION["email"] ?>',
                forename : '<?php echo $_SESSION["forename"] ?>',

      };
    },
    methods: {
      Check(){
        Notiflix.Confirm.Show(
                        'Confirm',
                        'Are you sure you want to save changes?',
                        'Yes',
                        'No',
                        function okCb() {
                            this.SendToServer();
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
        SendToServer() {
             
             var bodyFormData = new FormData();
             
             bodyFormData.append('email', this.email);
             
             bodyFormData.append('contactnumber', this.phone);
             bodyFormData.append('forename', this.forename);

             axios({
                     method: "post",
                     url: "../../api/driver/update_api.php",
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
                             window.location.href = 'profile';
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
         },
        Send() {
        axios.get('../../api/order/view_assigned_orders.php?id=<?php echo $_SESSION["driverid"] ?>').then(response => {
          if (response.data.code == 0) {
            
           
          } else {
           
            this.order_arr = response.data;
          console.log(this.order_arr);
           
          }
          
        })
      },
      
    },
  
    mounted() {
        this.Send();
    },

  });
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>
