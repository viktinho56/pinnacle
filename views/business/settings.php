
<?php
require __DIR__ . '/../../helpers/session-checker.php';
require __DIR__ . '/../../partials/header.php';
require __DIR__ . '/../../partials/businessnavbar.php';

?>
<style>

.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}
html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}
.account-settings-multiselect ~ .select2-container {
    width: 100% !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.material-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.dark-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}
.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24,28,33,0.03) !important;
}
</style>
<div class="full-panel mt-6">
  <div class="content-wrapper">
  <div class="row">
      <div class="col-sm-9 mx-auto grid-margin mb-4 mb-xl-0">
        <div class="row">
          <div class="col-3">

            <img class="shadow-sm" src="<?php echo $_SESSION['avatar']; ?>" style="vertical-align: middle;object-fit: cover;border-radius: 50%;" width="50px" height="50px" />

          </div>
          <div class="col-9">
            <h4 class="font-weight-bold  text-left text-dark">Welcome <span id="username"><?php echo $_SESSION['nameofcompany']; ?></span> to your Dashboard </h4>
            <p class="font-weight-normal mb-2 text-muted"></p>
          </div>
        </div>
        <div class="col-12">
          <center>
            <h5 class="text-center text-black">Settings</h5>
          </center>
         
        </div>
      </div>
    </div>
   
<div class="container light-style flex-grow-1 container-p-y">

<div class="card overflow-hidden">
  <div class="row no-gutters row-bordered row-border-light">
    <div class="col-md-3 pt-0" style="border: 1px solid gainsboro;">
      <div class="list-group list-group-flush account-settings-links">
        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Cards</a>
        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Currency</a>
        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Bank Accounts</a>
     
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="account-general">

          
        </div>
        <div class="tab-pane fade" id="account-change-password">
         
        </div>
        <div class="tab-pane fade" id="account-info">
         
  
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="text-right mt-3">
  <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
  <button type="button" class="btn btn-default">Cancel</button>
</div>

</div>

              </div>

              </div>
              <script>
  var app = new Vue({
    el: '.full-panel',
    data() {
      return {
        order_arr: [],
        id: '<?php echo $_SESSION['email']; ?>',
       
      };
    },
    methods: {
      CheckOut(){

      },
      DeleteOrder() {
        Notiflix.Confirm.Show(
          'Confirm',
          'Are you sure you want to delete this order?',
          'Yes',
          'No',
          function okCb() {
            var bodyFormData = new FormData();
            bodyFormData.append('id', app.id);
            axios({
                method: "post",
                url: "../../api/order/delete_order_by_id_api.php",
                data: bodyFormData,
              })
              .then(function(response) {
                console.log(response.data.code);
                if (response.data.code == 1) {
                  Notiflix.Report.Success(
                    'Success',
                    '"Order Deleted Successfully"',
                    'Close',
                  );
                  setTimeout(function() {
                    window.location.href = 'dashboard';
                  }, 1000);
                } else {
                  Notiflix.Report.Failure(
                    'Error',
                    '"An Error Has Occured"',
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
          function cancelCb() {
            //this.classList.add('hide');
          }, {
            width: '320px',
            borderRadius: '8px',
            // etc...
          },
        );
      },
      EditOrder() {
        Notiflix.Confirm.Show(
          'Confirm',
          'Are you sure you want to edit this order?',
          'Yes',
          'No',
          function okCb() {
            window.location.href = 'edit-order?order_id='+app.id;
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
        axios.get('../../api/order/view_order_by_email_api.php?email=' + this.id).then(response => {
          if (response.data.code == 0) {
            
           
          } else {
           
            this.order_arr = response.data;
          console.log(this.order_arr);
           
          }
          
          //$('#myTable').DataTable();

        })
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

<style href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></style>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

