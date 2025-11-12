<style>
  /* Modern & Professional Theme */
  
  /* Main Background */
  .content-wrapper, body {
    background: #f4f6f9 !important; /* Light gray background, remove image */
  }

  /* Topbar & Sidebar */
  .main-header.navbar {
  background: #1E293B !important; /* Match sidebar color */
}

  /* Active Sidebar Item */
  .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
    background-color: #34495e !important; /* Slightly lighter charcoal for contrast */
  }

  /* Text & Icon Colors */
  .main-header .nav-link, .main-header .navbar-text, .nav-sidebar .nav-link p, .nav-sidebar .nav-link i {
    color: #ffffff !important;
  }

  /* User Image */
  .user-img {
      border-radius: 50%;
      height: 25px;
      width: 25px;
      object-fit: cover;
      border: none !important; /* Remove border */
  }
  /* Dashboard Card & Widget Styling */
.card, .small-box {
  background-color: #ffffff !important; /* Solid white background */
  box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2) !important; /* Subtle shadow */
  border: none !important;
}

/* Dashboard Icon Styling */
.small-box .icon > i {
  color: rgba(44, 62, 80) !important; /* A subtle, neutral gray for the background icon */
}

/* Specific icon colors inside widgets */
.info-box-icon {
    background-color: #2c3e50 !important; /* Match the topbar color */
    color: #ffffff !important;
}

/* Hide HR elements on dashboard */
.content-wrapper hr {
    display: none !important;
}
</style>

<!-- Topbar / Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <?php if($_SESSION['login_type'] != 3): ?>
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <?php endif; ?>
    <li class="nav-item d-flex align-items-center ml-2">
      <span class="navbar-text" style="font-size: 1.1rem; font-weight: bold; color: #fbbf24 !important; margin: 0; line-height: 1; margin-top: -10px; margin-left: -5px;">
        <?php echo $_SESSION['system']['name'] ?>
      </span>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
        <span>
          <div class="d-flex badge-pill">
            <?php 
            $show_avatar = false;
            $avatar_src = '';
            
            // Debug: Show session info
            echo "<!-- Session Avatar: " . (isset($_SESSION['login_avatar']) ? $_SESSION['login_avatar'] : 'NOT SET') . " -->";
            
            if(isset($_SESSION['login_avatar']) && !empty($_SESSION['login_avatar'])) {
              $avatar_path = 'assets/uploads/' . $_SESSION['login_avatar'];
              echo "<!-- Checking path: " . $avatar_path . " -->";
              echo "<!-- File exists: " . (file_exists($avatar_path) ? 'YES' : 'NO') . " -->";
              
              if(file_exists($avatar_path)) {
                $avatar_src = $avatar_path;
                $show_avatar = true;
                echo "<!-- Will show avatar image -->";
              } else {
                echo "<!-- Will show placeholder -->";
              }
            } else {
              echo "<!-- No avatar in session -->";
            }
            ?>
            
            <?php if($show_avatar): ?>
              <img src="<?php echo $avatar_src ?>" class="user-img mr-1"> 
            <?php else: ?>
              <div class="user-img mr-1 d-flex justify-content-center align-items-center bg-primary text-white" style="font-size: 12px; font-weight: bold;">
                <?php 
                if(isset($_SESSION['login_firstname']) && isset($_SESSION['login_lastname'])) {
                  echo strtoupper(substr($_SESSION['login_firstname'], 0, 1) . substr($_SESSION['login_lastname'], 0, 1));
                } else {
                  echo '<i class="fas fa-user" style="font-size: 10px;"></i>';
                }
                ?>
              </div>
            <?php endif; ?>
            
            <span><b><?php echo ucwords($_SESSION['login_firstname']) ?></b></span>
            <span class="fa fa-angle-down ml-2"></span>
          </div>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <?php if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 3): ?>
          <a class="dropdown-item" href="index.php?page=profile"><i class="fa fa-user-circle"></i> My Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="student_logout.php"><i class="fa fa-power-off"></i> Logout</a>
        <?php else: ?>
          <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
        <?php endif; ?>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<script>
  $('#manage_account').click(function(){
    uni_modal('Manage Account','admin/manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
  })
</script>