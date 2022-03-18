<?php
//session_start();
//echo $session['email'];
 include '../../partials/__header.php';?>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include '../../partials/__navbar.php';?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include '../../partials/__sidebar.php';?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">My Profile</h4>
            
            </div>
          </div>
          <div class="row mt-3">

          <div class="col-xl-9 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                     
                     <div class="row">
                    <div class="col-6">
                    <h4 class="card-title">First Name</h4>
                  <div class="form-group">
                        <input style="border-radius:28px;background:white;" value="<?php  echo $_SESSION["firstname"]; ?>" type="text" class="form-control" id="exampleInputName1" placeholder="Email">
                    </div>
                    
                    </div>
                    <div class="col-6">
                    <h4 class="card-title">Last Name</h4>
                  <div class="form-group">
                        <input style="border-radius:28px;background:white;" value="<?php  echo $_SESSION["lastname"]; ?>" type="text" class="form-control" id="exampleInputName1" placeholder="Email">
                    </div>
                    
                    </div>
                     </div>
                     <div class="row">
                    <div class="col-12">
                    <h4 class="card-title">Email Address</h4>
                  <div class="form-group">
                        <input style="border-radius:28px;background:white;" value="<?php  echo $_SESSION["email"]; ?>" type="text" class="form-control" id="exampleInputName1" placeholder="Email">
                    </div>
                    
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                    <h4 class="card-title">Supervisor</h4>
                  <div class="form-group">
                        <input value="<?php  echo $_SESSION["supervisor"]; ?>" style="border-radius:28px;background:white;" type="text" class="form-control" id="exampleInputName1" placeholder="Email">
                    </div>
                    
                    </div>
                    <div class="col-6">
                    <h4 class="card-title">Designation</h4>
                  <div class="form-group">
                        <input value="<?php  echo $_SESSION["designation"]; ?>" style="border-radius:28px;background:white;" type="text" class="form-control" id="exampleInputName1" placeholder="Email">
                    </div>
                    
                    </div>
                     </div>
                     <div class="row">
                    <div class="col-4">
                    <h4 class="card-title">Old Password</h4>
                  <div class="form-group">
                        <input style="border-radius:28px;background:white;" type="text" class="form-control" id="exampleInputName1">
                    </div>
                    
                    </div>
                    <div class="col-4">
                    
                    <h4 class="card-title">New Password</h4>
                  <div class="form-group">
                        <input v-model="newpwd" style="border-radius:28px;background:white;" type="text" class="form-control" id="exampleInputName1" >
                    </div>
                    
                    </div>
                    <div class="col-4">
                    <h4 class="card-title">Update</h4>
                  <div class="form-group">
                  <input value="Submit" @click="Update()" style="background:#004178;color:gainsboro;" type="button" class="btn btn-lg  btn-block btn-rounded" id="exampleInputName1" placeholder="Password">
                    </div>
                    
                    </div>
                     </div>

                        
                    </div>
                  </div>
            </div>
            <div class="col-xl-3 flex-column d-flex grid-margin stretch-card">
              <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      
                      <center> <a class="navbar-brand brand-logo" href="index.html"><img src="../../assets/images/logo.png" style="width:190px;" alt="logo"/></a></center>
                    <br/>
                    <center> <a class="navbar-brand brand-logo" href="index.html"><img src="../../assets/images/passport/<?php  echo $_SESSION["passport"]; ?>" style="width:130px;" alt="logo"/></a></center>  
                    <br/>
                   <center>
                   <h4 class="font-weight-bold" style="color:#004178;text-transform:capitalize;"><?php  echo $_SESSION["fullname"]; ?></h4>
                    <h6 class="text-dark"><?php  echo $_SESSION["designation"]; ?></h6>
                   <img src="../../assets/images/signature/<?php  echo $_SESSION["signature"]; ?>" style="width:80px;" alt="logo"/>
               
                   </center>
                    </div>
                    </div>
                </div>
                
              </div>
            </div>
           
          </div>
       
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include '../../partials/__footer.php';?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.2/src/notiflix.css">
<script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.2/src/notiflix.js"></script>
  <script src="../../assets/vendors/base/vendor.bundle.base.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
var app = new Vue({
  el: '.main-panel',
  data() {
      return {
        leave_type:"ANNUAL LEAVE",
        leave_dates:"",
        no_of_days:"",
        description:"",
        res_arr: [],
        portfolio: [],
        newpwd:""
      };
    },
  methods: {
    Update(){
      if(this.newpwd == ""){
        Notiflix.Report.failure(
'Error',
'"New Password can not be empty"',
'Okay',
);
      }
      
      else{
        var bodyFormData = new FormData();
      bodyFormData.append('password',this.newpwd);
      axios({
  method: "post",
  url: "../../api/user/update_password",
  data: bodyFormData,
})
  .then(function (response) {
    Notiflix.Report.success(
'Success',
'"Updated Successfully"',
'Close',
);
    //handle success
    //alert(response);
    console.log(response.data);
  })
  .catch(function (response) {
    //handle error
    console.log(response);
  });
      }
    },
  
  },
  created(){
   // Notiflix.Notify.success('Sol lucet omnibus');
     // this.LoadLeaves();
    },
    
});
  </script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../../assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

