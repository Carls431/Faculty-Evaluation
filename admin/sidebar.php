<style>
.main-sidebar {
  background: #1E293B !important;
  box-shadow: 2px 0 10px rgba(0,0,0,0.1);
}

.main-sidebar .brand-link {
  background: #1E293B !important;
  border-bottom: 3px solid #fbbf24;
  padding: 20px 15px;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.main-sidebar .brand-link:hover {
  background: #334155 !important;
  transform: translateY(-1px);
}

.brand-image {
  width: 60px;
  height: 60px;
  border-radius: 100%;
  object-fit: cover;
  transition: all 0.3s ease;
  margin-bottom: 10px;
}

.brand-image-mini {
  width: 40px;
  height: 40px;
  border-radius: 100%;
  object-fit: cover;
  transition: all 0.3s ease;
}

.brand-initials {
  font-weight: bold;
  font-size: 14px;
  color: #fbbf24;
  text-shadow: 0 1px 2px rgba(0,0,0,0.3);
  margin-bottom: 8px;
  text-align: center;
  letter-spacing: 1px;
  transition: all 0.3s ease;
}

.brand-initials:hover {
  color: #fde047;
  transform: scale(1.05);
}

/* Show text when sidebar is expanded */
.sidebar-mini-md .main-sidebar:not(.sidebar-collapse) .brand-text {
  display: block;
}

/* Hide text when sidebar is collapsed */
.sidebar-mini-md .main-sidebar.sidebar-collapse .brand-text {
  display: none;
}

/* FE initials always visible */
.brand-initials {
  display: block;
}



.brand-link:hover .brand-image {
  transform: scale(1.05);
  box-shadow: 0 6px 20px rgba(0,0,0,0.4) !important;
}

.brand-text {
  color: #F8FAFC !important;
  font-weight: 600 !important;
  font-size: 1.1rem !important;
  text-shadow: 0 2px 4px rgba(0,0,0,0.3);
  margin-left: 0;
  line-height: 1.2;
  text-align: center;
}

.brand-subtitle {
  color: rgba(255,255,255,0.8) !important;
  font-size: 0.75rem !important;
  font-weight: 400 !important;
  display: block;
  margin-top: -2px;
  text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

/* Fix for sidebar text readability on hover/active */
.nav-pills .nav-link p,
.nav-pills .nav-link .nav-icon {
  color: #F8FAFC !important;
}

.nav-pills .nav-link:not(.active):hover p,
.nav-pills .nav-link:not(.active):hover .nav-icon {
  color: #F8FAFC !important;
}

.nav-pills .nav-link.active p,
.nav-pills .nav-link.active .nav-icon {
  color: #F8FAFC !important;
}

/* Enhanced navigation styling */
.nav-sidebar .nav-item > .nav-link {
  border-radius: 8px;
  margin: 2px 8px;
  transition: all 0.3s ease;
  display: flex !important;
  align-items: center;
}

/* Ensure first nav item (Dashboard) is visible */
.nav-sidebar .nav-item:first-child {
  display: block !important;
  margin-top: 30px;
}

.nav-sidebar .nav-item:first-child > .nav-link {
  display: flex !important;
  background: rgba(255,255,255,0.05) !important;
  border: 1px solid rgba(255,255,255,0.1);
}

/* Add spacing after brand section */
.sidebar {
  padding-top: 10px;
}

.nav-sidebar .nav-item > .nav-link:hover {
  background: #334155 !important;
  color: #F8FAFC !important;
  transform: translateX(5px);
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.nav-sidebar .nav-item > .nav-link:hover .nav-icon {
  color: #F8FAFC !important;
}

.nav-sidebar .nav-item > .nav-link:hover p {
  color: #F8FAFC !important;
}

.nav-sidebar .nav-item > .nav-link.active {
  background: #475569 !important;
  box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}
</style>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        <div class="brand-initials">MOIST-FE</div>
        <div class="brand-text">
          <strong>Faculty Evaluation</strong>
          <span class="brand-subtitle">Administrator Portal</span>
        </div>
    </a>
      
    </div>
    <div class="sidebar">
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
          <a href="./index.php?page=subject_list" class="nav-link nav-subject_list tree-item">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Subjects (JHS & SHS)
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="./index.php?page=class_list" class="nav-link nav-class_list">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Sections
              </p>
            </a>
          </li> 
          <li class="nav-item dropdown">
            <a href="./index.php?page=academic_list" class="nav-link nav-academic_list">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Academic Year
              </p>
            </a>
          </li> 
          <li class="nav-item dropdown">
            <a href="./index.php?page=questionnaire" class="nav-link nav-questionnaire">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Questionnaires
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=criteria_list" class="nav-link nav-criteria_list">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Evaluation Criteria
              </p>
            </a>
          </li> 
          <li class="nav-item dropdown">
            <a href="./index.php?page=faculty_list" class="nav-link nav-faculty_list">
              <i class="nav-icon fa fa-user-friends"></i>
              <p>
                Teachers
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=faculty_assignments" class="nav-link nav-faculty_assignments">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Faculty Assignments
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=student_list" class="nav-link nav-student_list">
              <i class="nav-icon fa ion-ios-people-outline"></i>
              <p>
                Students
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=report" class="nav-link nav-report">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Evaluation Report
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=evaluation_dashboard" class="nav-link nav-evaluation_dashboard">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Progress Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=history_logs" class="nav-link nav-history_logs">
              <i class="nav-icon fas fa-history"></i>
              <p>
                History Logs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=user_list" class="nav-link nav-user_list">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>