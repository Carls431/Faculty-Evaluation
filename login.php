<?php 
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
    header('location:index.php?page=home');
?>
<style>
body.login-page {
  background: url('assets/img/background.png') no-repeat center center fixed !important;
  background-size: cover !important;
}
.login-logo-img {
  width: 110px;
  margin: 30px auto 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  padding: 0;
  background: none;
  box-shadow: none;
}
.login-logo-img img {
  width: 90px;
  height: 90px;
  object-fit: contain;
  background: none;
  border-radius: 0;
  box-shadow: none;
  padding: 0;
  border: none;
  display: block;
}
.login-heading {
  color: #800000;
  text-shadow: 0 2px 8px rgba(0,0,0,0.08);
  background: none;
  padding: 10px 0 0 0;
  border-radius: 0;
  font-size: 1.3rem;
  font-weight: bold;
  margin: 12px auto 10px auto;
  width: fit-content;
  box-shadow: none;
  letter-spacing: 1px;
  text-align: center;
}
.login-box {
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
  border-radius: 18px;
  background: rgba(255,255,255,0.98);
  width: 420px;
  max-width: 90vw;
  margin: 60px auto 0 auto;
  padding-bottom: 30px;
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow: hidden;
}
.login-box::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 10px;
  background: linear-gradient(to right,rgb(197, 15, 15), #ff4500);
  border-top-left-radius: 18px;
  border-top-right-radius: 18px;
}

.login-card-body {
  border-radius: 0 0 18px 18px;
  padding: 20px 30px;
}
.input-group-text {
  background-color: #f8f9fa;
  border-right: none;
  border-color: #ced4da;
}
.form-control {
  border-left: none;
  border-color: #ced4da;
  padding-left: 10px;
}
.form-control:focus {
  box-shadow: none;
  border-color: #800000;
}
.btn-primary {
  background-color: #800000;
  border-color: #800000;
  transition: all 0.3s ease;
}
.btn-primary:hover {
  background-color: #ff4500;
  border-color: #ff4500;
}
.icheck-primary input:checked + label::before {
  background-color: #800000;
  border-color: #800000;
}
.alert-danger {
  background-color: #f8d7da;
  color: #721c24;
  border-color: #f5c6cb;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 15px;
  font-size: 0.9em;
}
.forgot-password-link {
  color: #800000;
  text-decoration: none;
  font-size: 0.9rem;
  transition: all 0.3s ease;
  display: inline-block;
  padding: 8px 15px;
  border-radius: 20px;
  background: rgba(128, 0, 0, 0.1);
}
.forgot-password-link:hover {
  color: #ff4500;
  text-decoration: none;
  background: rgba(255, 69, 0, 0.1);
  transform: translateY(-1px);
}
.forgot-password-link i {
  margin-right: 5px;
}


.login-box {
  z-index: 10;
  position: relative;
}

/* Mobile Responsive Design */
@media (max-width: 768px) {
  .login-box {
    width: 95%;
    margin: 20px auto 0 auto;
    padding-bottom: 20px;
  }
  
  .login-card-body {
    padding: 15px 20px;
  }
  
  .login-heading {
    font-size: 1.1rem;
    margin: 8px auto 8px auto;
  }
  
  .login-logo-img {
    width: 80px;
    margin: 20px auto 0 auto;
  }
  
  .login-logo-img img {
    width: 70px;
    height: 70px;
  }
  
  .input-group {
    margin-bottom: 15px;
  }
  
  .btn-lg {
    padding: 12px 16px;
    font-size: 1rem;
  }
  
  .forgot-password-link {
    font-size: 0.85rem;
    padding: 6px 12px;
  }
}

@media (max-width: 480px) {
  .login-box {
    width: 98%;
    margin: 10px auto 0 auto;
  }
  
  .login-card-body {
    padding: 12px 15px;
  }
  
  .login-heading {
    font-size: 1rem;
  }
  
  .login-logo-img {
    width: 70px;
    margin: 15px auto 0 auto;
  }
  
  .login-logo-img img {
    width: 60px;
    height: 60px;
  }
  
  .form-control {
    font-size: 16px; /* Prevents zoom on iOS */
  }
  
  .btn-lg {
    padding: 14px 16px;
  }
}

</style>
<html lang="en">
<?php $page = 'login'; include 'header.php' ?>

<body class="hold-transition login-page bg-black">
  
  
<div class="login-box">
  <div class="login-logo-img">
    <img src="assets/img/logo.png" alt="Logo" />
  </div>
  <div class="login-logo">
    <h2 class="login-heading"><b><?php echo $_SESSION['system']['name'] ?></b></h2>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" id="login-form">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="d-flex justify-content-between align-items-center">
              <img src="captcha.php" alt="CAPTCHA" id="captcha_image">
              <button type="button" class="btn btn-sm btn-outline-secondary" id="refresh_captcha" title="Refresh CAPTCHA">&#x21bb;</button>
          </div>
          <input type="text" id="captcha" name="captcha" class="form-control mt-2" placeholder="Enter the code" required>
        </div>
        
        <input type="hidden" name="login" value="1">
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-lg" style="width:100%; border-radius: 8px; margin-top: 15px;">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row mt-3">
          <div class="col-12 text-center">
            <a href="index.php?page=forgot_password" class="forgot-password-link">
              <i class="fas fa-key"></i> Forgot Password?
            </a>
          </div>
        </div>
      </form>
      
      <!-- 2FA Verification Form (initially hidden) -->
      <form id="2fa-form" style="display: none;">
        <div class="text-center mb-3">
          <h4><i class="fas fa-shield-alt"></i> Two-Factor Authentication</h4>
          <p>Enter the 6-digit code from your authenticator app</p>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="verification_code" id="verification_code" maxlength="6" placeholder="000000" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Verify Code</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else if(resp == 3){
          $('#login-form').prepend('<div class="alert alert-danger">Account is locked due to multiple failed login attempts. Just wait 15 minutes then login again.</div>')
          $('#refresh_captcha').click();
          end_load();
        }else if(resp == 4){
          $('#login-form').prepend('<div class="alert alert-danger">The CAPTCHA code is incorrect.</div>')
          $('#captcha').val('');
          $('#refresh_captcha').click();
          end_load();
        }else if(resp == 5){
          // 2FA required - show 2FA form
          show_2fa_form();
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          $('#refresh_captcha').click();
          end_load();
        }
      }
    })
  })
  
  $('#refresh_captcha').click(function(){
    // Append a timestamp to the src to prevent browser caching
    $('#captcha_image').attr('src', 'captcha.php?' + new Date().getTime());
  });
  
  function show_2fa_form(){
    end_load();
    $('#login-form').hide();
    $('#2fa-form').show();
  }
  
  $('#2fa-form').submit(function(e){
    e.preventDefault();
    start_load();
    $.ajax({
      url:'ajax.php?action=verify_2fa',
      method:'POST',
      data:$(this).serialize(),
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#2fa-form').prepend('<div class="alert alert-danger">Invalid 2FA code. Please try again.</div>');
          $('#verification_code').val('');
          end_load();
        }
      }
    });
  });
  
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
