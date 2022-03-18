 <!-- partial -->
 <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" style="background:white;" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="../../public/images/profile.svg">
          </div>
          <div style="color:black;" class="user-name">
             <?php echo $_SESSION['forename'] ?>
          </div>
         
        </div>
        <ul style="margin-top: -10px;" class="nav">
          <li style="display:none;" class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users">
              <i class="menu-icon icon-head"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addstaff">
              <i class="menu-icon icon-plus"></i>
              <span class="menu-title">Add Staff</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="assignorder">
              <i class="menu-icon icon-alt"></i>
              <span class="menu-title">Assign Orders</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="orders">
              <i class="icon-bar-graph-2 menu-icon"></i>
              <span class="menu-title">Orders</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transaction">
              <i class="menu-icon icon-content-left"></i>
              <span class="menu-title">Transactions</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile">
              <i class="menu-icon icon-head"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
        
        
         
        </ul>
      </nav>
      <!-- partial -->