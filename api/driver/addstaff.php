<?php
//require __DIR__ . '/../../helpers/session-checker.php';
require __DIR__ . '/../../partials/header.php';
//

?>
<div class="container-scroller">
    <?php
    require __DIR__ . '/../../partials/adminnavbar.php';
    ?>
    <?php
    require __DIR__ . '/../../partials/adminsidebar.php';
    ?>
    <div class="main-panel all">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 mb-4 mb-xl-0">
                    <h4 class="font-weight-bold text-dark">Add Staff</h4>

                </div>
            </div>
            <div class="row mt-3">

            <div class="col-md-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                
                    <div class="form-group">
                      <label for="exampleInputUsername1">Forename</label>
                      <input v-model="forename" type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input v-model="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact Number</label>
                      <input v-model="phone" type="phone" class="form-control" id="exampleInputEmail1" placeholder="Contact">
                    </div>
                   
                
                </div>
              </div>
            </div>
            <div class="col-md-6 mx-auto grid-margin">
              <div class="card">
                <div class="card-body">
                  
                
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input v-model="password" type="phone" class="form-control" id="exampleInputEmail1" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Confirm Password</label>
                      <input v-model="confirmpassword" type="phone" class="form-control" id="exampleInputEmail1" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                                        <label>User Type</label>
                                        <select style="height:55px !important;" v-model="user" name="country" class="form-control form-control-md" id="exampleFormControlSelect2">
                                            <option>Select User Type</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Driver">Dispatch Driver</option>
                                           
                                        </select>
                                    </div>
                  
                    <button @click="AddUser()" type="button" class="btn btn-success mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                
                </div>
              </div>
            </div>


        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer style="visibility:hidden;" class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>









<script>
    var app = new Vue({
        el: '.all',
        data() {
            return {
                my_arr: [],
                phone: '',
                email: '',
                forename : '',
                user:'Select User Type',
                password:'',
                confirmpassword:''

               
            };
        },
        methods: {
            CreateAccount() {
                if (this.forename == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Forename can not be empty"',
                        'Okay',
                    );
                }  else if (this.email == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Email can not be empty"',
                        'Okay',
                    );
                } else if (this.phone == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Password can not be empty"',
                        'Okay',
                    );
                } 
                
                else if (this.password == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Password can not be empty"',
                        'Okay',
                    );
                }
                else if (this.user == "Select User Type") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"User Type can not be empty"',
                        'Okay',
                    );
                } else if (this.confirmpassword != this.password) {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Passwords do not match"',
                        'Okay',
                    );
                }  else {
                    
                     Notiflix.Loading.Standard();
                    if(this.user=="Admin"){
                        this.SendAdminToServer();
                    }
                    else{
                        this.SendDriverToServer();
                    }
                }
            },
            SendAdminToServer() {
                
                var bodyFormData = new FormData();
                bodyFormData.append('forename', this.forename);
               
                bodyFormData.append('email', this.email);
                bodyFormData.append('contactnumber', this.phone);
                bodyFormData.append('password', this.password);

 
                axios({
                        method: "post",
                        url: "../../api/admin/signup_api.php",
                        data: bodyFormData,
                    })
                    .then(function(response) {
                        console.log(response.data.code);
                        if (response.data.code == 1) {
                            Notiflix.Report.Success(
                                'Success',
                                '"Account Created Successfully"',
                                'Close',
                            );
                           Notiflix.Loading.Remove();
                        } else {
                            Notiflix.Report.Failure(
                                'Error',
                                response.data.message,
                                'Close',
                            );
                            Notiflix.Loading.Remove();
                        }

                        console.log(response.data);
                    })
                    .catch(function(response) {
                        //handle error
                        console.log(response);
                    });
            },
            SendDriverToServer() {
                
                var bodyFormData = new FormData();
                bodyFormData.append('forename', this.forename);
               
                bodyFormData.append('email', this.email);
                bodyFormData.append('contactnumber', this.phone);
                bodyFormData.append('password', this.password);

 
                axios({
                        method: "post",
                        url: "../../api/driver/signup_api.php",
                        data: bodyFormData,
                    })
                    .then(function(response) {
                        console.log(response.data.code);
                        if (response.data.code == 1) {
                            Notiflix.Report.Success(
                                'Success',
                                '"Account Created Successfully"',
                                'Close',
                            );
                           Notiflix.Loading.Remove();
                        } else {
                            Notiflix.Report.Failure(
                                'Error',
                                response.data.message,
                                'Close',
                            );
                            Notiflix.Loading.Remove();
                        }

                        console.log(response.data);
                    })
                    .catch(function(response) {
                        //handle error
                        console.log(response);
                    });
            },
            GetOrders() {
                axios.get('../../api/admin/show_transaction.php').then(response => {
                    if (response.data.code == 0) {

                    } else {

                        for (let index = 0; index < response.data.length; index++) {
                            const element = response.data[index];
                            this.my_arr.push(element);

                        }
                        console.log(this.my_arr);
                    }

                    console.log(response.data);
                })
            },
           
        },
        mounted() {

           // this.GetOrders();
            
        },

    });
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>
