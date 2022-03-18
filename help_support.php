<?php
require __DIR__. '/partials/header2.php';
require __DIR__. '/partials/navbar2.php';
?>

<div class="wrapper"  data-bs-target="#navbar-example2" data-bs-offset="0" tabindex="0">
    <section style="margin-top:80px;" id="offersection">
    <div class="row">
        <div class="col-lg-6  mx-auto col-md-6 col-sm-6">
            <div class="content">
                <label class="display-4 green-text center">HELP AND SUPPORT</label>
                <form class="pt-3" method="POST" id="sessionCreate" action="/userapi/create-session" class="forms-sample">
                    <div class="formError"></div>
                    <div class="form-group">
                    <input type="text" v-model="firstname" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="FirstName">
                  </div>
                  <div class="form-group">
                    <input type="text" v-model="lastname" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="LastName">
                  </div>
                  <div class="form-group">
                    <input type="email" v-model="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <textarea v-model="text" class="form-control form-control-lg" placeholder="Text" name="" id=""  rows="10"></textarea>    
                  </div>
                  <div class="mt-3">
                    <button type="button" @click="Login" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">SEND</a>
                  </div>
                
                 
                 
                </form>
            </div>
        </div>
    </div>
  
    </section>

    </div>
    <script>
    var app = new Vue({
        el: '.wrapper',
        data() {
            return {
                
                email: "",
              
                firstname: "",
                lastname:"",
                text:""

               
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
                } 
                else if (this.lastname == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Lastname can not be empty"',
                        'Okay',
                    );
                } 
                else if (this.firstname == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Firstname can not be empty"',
                        'Okay',
                    );
                } 
                else if (this.text == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Text can not be empty"',
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
                
                bodyFormData.append('firstname', this.firstname);
                bodyFormData.append('lastname', this.lastname);
                bodyFormData.append('text', this.text);
                

                axios({
                        method: "post",
                        url: "../../api/notification/sendContactEmail.php",
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
                                window.location.href = 'dashboard';
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
require __DIR__. '/partials/footer2.php';
?>