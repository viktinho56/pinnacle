<?php
require __DIR__ . '/../../partials/header.php';
require  __DIR__ . '/../../partials/loginnavbar.php';
?>
<div class="full-panel">
    <div class="content-wrapper">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" id="sessionCreate" action="/userapi/create-session" class="forms-sample">
                    <div class="formError"></div>
                    <div class="form-group">
                    <input type="email" v-model="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" v-model="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="button" @click="Login" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">SIGN IN</a>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check  form-check-success">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input">
                        Keep me signed in
                      </label>
                    </div>
                    <a href="reset-password" class="auth-link text-black">Forgot password?</a>
                  </div>
                 
                  <div class="text-center mt-4 font-weight-light">
                    Don't have an account? <a href="create-account" class="text-success">Create</a>
                  </div>
                </form>
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
                
                email: "",
              
                password: "",
               
            };
        },
        methods: {
            Login() {
                if (this.email == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Email can not be empty"',
                        'Okay',
                    );
                } else if (this.password == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Password can not be empty"',
                        'Okay',
                    );
                } 
                else{
                 
                  this.SendToServer();
                }
            },
            SendToServer() {
             
                var bodyFormData = new FormData();
                
                bodyFormData.append('email', this.email);
                
                bodyFormData.append('password', this.password);
                

                axios({
                        method: "post",
                        url: "../../api/driver/login_api.php",
                        data: bodyFormData,
                    })
                    .then(function(response) {
                        console.log(response.data.code);
                        if (response.data.code == 1) {
                            Notiflix.Report.Success(
                                'Success',
                                '"Logged in Successfully"',
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
        },
        mounted() {
           

        },

    });
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>