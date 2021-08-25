<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.php">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Letters</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user-tie"></i>
          <span>Manage Reg. Teachers</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">You can:</h6>
            <a class="collapse-item" href="verify.php"><i class="fas fa-user-check"></i>
          <span> Verify Teachers</span></a>
          <a class="collapse-item" href="update_reg_teacher.php"><i class="fas fa-user-edit"></i>
          <span> Update Teachers</span></a>
          <!-- <a class="collapse-item" href="enrollFaculty.php"><i class="fas fa-user-edit"></i>
          <span> Add New Teachers</span></a> -->
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoT" aria-expanded="true" aria-controls="collapseTwoT">
          <i class="fas fa-user-tie"></i>
          <span>Manage Teachers</span>
        </a>
        <div id="collapseTwoT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">You can:</h6>
            <a class="collapse-item" href="update_book_teacher.php"><i class="fas fa-user-edit"></i>
            <span> Update Teachers</span></a>
            <a class="collapse-item" href="add_book_teacher.php"><i class="fas fa-user-edit"></i>
            <span> Add New Teachers</span></a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
          <i class="fas fa-user-tie"></i>
          <span>Manage Staff</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">You can:</h6>
            <a class="collapse-item" href="createStaff.php"><i class="fas fa-user-check"></i>
          <span> Create Staff Account</span></a>
          <a class="collapse-item" href="updateStaffAccount.php"><i class="fas fa-user-edit"></i>
          <span> Update Staff Account</span></a>
          <a class="collapse-item" href="updateStaffPassword.php"><i class="fas fa-user-edit"></i>
          <span> Update Staff Password</span></a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
          <i class="fas fa-user-tie"></i>
          <span>Manage Deparment</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">You can:</h6>
            <a class="collapse-item" href="create_department.php"><i class="fas fa-user-check"></i>
          <span> Create Department</span></a>
          <a class="collapse-item" href="update_department.php"><i class="fas fa-user-edit"></i>
          <span> Update Department</span></a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoL" aria-expanded="true" aria-controls="collapseTwoL">
        <i class="fas fa-fw fa-envelope"></i>
          <span>Letter Templates</span>
        </a>
        <div id="collapseTwoL" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">You can:</h6>
            <a class="collapse-item" href="/spl/staffLogin/letters/template.php"><i class="fas fa-user-check"></i>
            <span> Letter For Templete</span></a>
          </div>
        </div>
      </li>

      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>