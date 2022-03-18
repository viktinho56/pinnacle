<?php
require __DIR__ . '/../../helpers/session-checker.php';
require __DIR__ . '/../../partials/header.php';
require __DIR__ . '/../../partials/businessnavbar.php';

?>
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
            <h5 class="text-center text-black">Your Wallet</h5>
          </center>
         
        </div>
      </div>
    </div>
          
          <div class="row mt-3">
            <div class="col-xl-3 flex-column d-flex grid-margin">
              <div class="row flex-grow">
                <div class="col-sm-12 grid-margin">
                    <div class="card">
                      <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          <h4 class="card-title">Wallet Balance</h4>
                          <h4 class="text-dark font-weight-bold mb-2" id="balance">&#163{{balance}}</h4>
                          <p>Available</p>
                          <button type="button" class="btn btn-success btn-rounded btn-fw">Auto Top</button>
                          <a href="#modal" role="button" data-toggle="modal" data-target="#exampleModal" type="button"  class="btn  btn-rounded btn-outline-success btn-fw">Manual Top</a>
                        </div>
                        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          <h4 class="card-title">Spending Limit</h4>
                          <div class="form-group">
                      <label for="exampleInputEmail1">Amount</label>
                      <input type="text"  id="limit" class="form-control" id="exampleInputEmail1" placeholder="Amount">
                    </div>  
                    <button type="button" @click="UpdateLimit()" class="btn btn-success btn-rounded btn-fw">Save</button>
                </div>
                    </div>
                </div>
                
              </div>
            </div>
            <div class="col-xl-9 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Transaction History</h4>
                      <div class="col-xl-12 grid-margin-lg-0 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Information</h4>
                    <div class="table-responsive mt-3">
                      <table id="myTable" class="table table-header-bg">
                        <thead>
                          <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Amount
                            </th>
                            <th style="display: none;">
                                Option
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="item in trans_arr">
                            <td>
                               {{item.created}}
                            </td>
                            <td>
                            {{item.trantype}}
                            </td>
                            <td>
                           Payment
                            </td>
                            <td>
                              <div class="row">
                              &#163{{item.amount}}
                              </div>
                            </td>
                            <td>
                            <button style="display: none;" type="button"  class="btn btn-success btn-rounded btn-fw">View</button>
           
                            </td>
                          </tr>
                        
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
                        
                    </div>
                  </div>
            </div>
          </div>
         
        
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">
          <center>Enter Amount</center>
        </h5>

       
           
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <input type="text" v-model="amount" class="form-control" id="exampleInputUsername1" placeholder="Enter Amount">
       <br/>
        <button  @click="ShowCard" type="button"  class="btn btn-success  btn-fw">Pay</button>                      
        </center>
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
        order_arr: [],
        trans_arr: [],
        id: '<?php echo $_SESSION['businessid']; ?>',
        balance: '',
        limit: '',
        amount:''
       
      };
    },
    methods: {
      ShowCard() {
      if(this.amount < 0){
        Notiflix.Report.Failure(
                'Error',
                'Amount can not be zero',
                'Close',
              );
      } 
      else{
        Notiflix.Loading.Hourglass('Processing');
        var bodyFormData = new FormData();
        bodyFormData.append('email', '<?php  echo $_SESSION['email']; ?>');
        bodyFormData.append('amount', this.amount);
        bodyFormData.append('title', 'Card Top Up Transaction');
        bodyFormData.append('fullname', '<?php echo $_SESSION['nameofcompany']; ?>');
        bodyFormData.append('pay', 'pay');
        //bodyFormData.append('order_id', this.id);
       
        axios({
            method: "post",
            url: "topupcard-payment.php",
            data: bodyFormData,
          })
          .then(function(response) {
            console.log(response.data.code);
            Notiflix.Loading.Remove();
            if (response.data.code == 1) {
              window.location.href = response.data.link;

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
      },
        ManualTopUp(){
          //this.ShowCard();
          //  window.location.href = 'topup';
},
      CheckOut(){

      },
      UpdateLimit() {
        Notiflix.Confirm.Show(
          'Confirm',
          'Are you sure you want to save this action?',
          'Yes',
          'No',
          function okCb() {
            var bodyFormData = new FormData();
            bodyFormData.append('businessid', app.id);
            bodyFormData.append('limit', document.getElementById('limit').value);
            axios({
                method: "post",
                url: "../../api/wallet/update_limit_api.php",
                data: bodyFormData,
              })
              .then(function(response) {
                console.log(response.data.code);
                if (response.data.code == 1) {
                  Notiflix.Report.Success(
                    'Success',
                    '"Limit Updated Successfully"',
                    'Close',
                  );
                  setTimeout(function() {
                    window.location.href = 'wallet';
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
        axios.get('../../api/wallet/view_wallet_api.php?businessid=' + this.id).then(response => {
          if (response.data.code == 0) {
            
           
          } else {
           
           document.getElementById('balance').innerHTML = response.data[0].currentbalance;
            this.balance = response.data[0].currentbalance;
            this.limit = response.data[0].limit;
            document.getElementById('limit').value = response.data[0].limit;
            this.order_arr = response.data;
            console.log(this.balance);
            console.log(this.limit);
           
          }
          
        //  $('#myTable').DataTable();

        })
      },
      GetTran() {
        axios.get('../../api/transaction/view_transaction_by_id_api.php?businessid=' + this.id).then(response => {
          if (response.data.code == 0) {
           
            Notiflix.Loading.Remove();
          } else {
           
            this.trans_arr = response.data;
            this.balance = response.data[0].currentbalance;
            this.limit = response.data[0].limit;
            Notiflix.Loading.Remove();
           
          }
          console.log(response.data);
         // $('#myTable').DataTable();

        }).finally(() => {
            $('#myTable').DataTable();
                });
      }
    },
    mounted() {
      Notiflix.Loading.Hourglass('Processing');
      this.Send();
      this.GetTran();
    },

  });
  
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  <script>
      $(document).ready( function () {
          
       // $('#myTable').DataTable();
} );
  </script>



