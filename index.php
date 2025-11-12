<?php 
  // Check system access first (CLI authentication required)
  require_once 'check_access.php';
  
  session_start();
  include 'db_connect.php';

  // Load system settings once
  if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  }
  ob_start();

  $page = isset($_GET['page']) ? $_GET['page'] : 'login';

  // Define public pages that do not require a login
  $public_pages = array('login', 'forgot_password', 'reset_password', 'verify_otp', 'new_password');

  if (in_array($page, $public_pages)) {
      // If the page is public, load it directly
      if(file_exists($page.'.php')){
        include $page.'.php';
      } else {
        include '404.html';
      }
  } else {
      // If the page is not public, a login is required
      if(!isset($_SESSION['login_id'])){
          header('location: index.php?page=login');
          exit();
      }

      // Determine the correct view folder based on user type
      if($_SESSION['login_type'] == 1){
        $view_folder = 'admin/';
      } else if($_SESSION['login_type'] == 2){
        $view_folder = 'faculty/';
      } else {
        $view_folder = 'student/';
      }

      // Load the full application layout for logged-in users
      include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
  
    <style>
  html, body {
    height: 100%;
  }

  .wrapper {
    min-height: 100%;
    display: flex;
    flex-direction: column;
  }

  .content-wrapper {
    flex: 1;
    padding-bottom: 20px; /* optional spacing from footer */
  }
  
  /* Remove sidebar margin for students */
  body:not(.sidebar-mini) .content-wrapper {
    margin-left: 0 !important;
  }
  
  body:not(.sidebar-mini) .main-header {
    margin-left: 0 !important;
  }
</style>
<body class="hold-transition <?php echo ($_SESSION['login_type'] == 3) ? '' : 'sidebar-mini'; ?> layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php 
    include 'topbar.php';
    // Only include sidebar for admin and faculty
    if($_SESSION['login_type'] != 3){
      include $view_folder.'sidebar.php';
    }
  ?>
  <div class="content-wrapper" <?php echo ($_SESSION['login_type'] == 3) ? 'style="margin-left: 0 !important;"' : ''; ?>>
     <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
      <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    <section class="content">
      <div class="container-fluid">
        <?php 
          if(!file_exists($view_folder.$page.".php")){
              include '404.html';
          }else{
            include $view_folder.$page.'.php';
          }
        ?>
      </div>
    </section>
        <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
          </div>
          <div class="modal-body">
            <div id="delete_content"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
          </div>
        </div>
      </div>
  </div>
  <?php 
    // Include AI Chat Assistant for students only
    if($_SESSION['login_type'] == 3){
      include 'student/ai_chat_assistant.php';
    }
    
    // Include admin footer for admin users
    if($_SESSION['login_type'] == 1){
      include 'admin/admin_footer.php';
    }
    include 'footer.php' 
  ?>
</div>
</body>
</html>
<?php 
  }
  ob_end_flush();
?>
