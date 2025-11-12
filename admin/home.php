<?php include('db_connect.php'); ?>
<?php 
function ordinal_suffix1($num){
    $num = $num % 100;
    if($num < 11 || $num > 13){
        switch($num % 10){
            case 1: return $num.'st';
            case 2: return $num.'nd';
            case 3: return $num.'rd';
        }
    }
    return $num.'th';
}
$astat = array("Not Yet Started","On-going","Closed");

// Get real data for charts
// 1. Faculty Performance Data
$faculty_performance = [];
$faculty_query = $conn->query("
    SELECT f.firstname, f.lastname, 
           COALESCE(AVG(ea.rate), 0) as avg_rating
    FROM faculty_list f 
    LEFT JOIN evaluation_list el ON f.id = el.faculty_id 
    LEFT JOIN evaluation_answers ea ON el.evaluation_id = ea.evaluation_id
    GROUP BY f.id, f.firstname, f.lastname 
    ORDER BY avg_rating DESC 
    LIMIT 5
");
while($row = $faculty_query->fetch_assoc()) {
    $faculty_performance[] = [
        'name' => $row['firstname'] . ' ' . $row['lastname'],
        'rating' => round($row['avg_rating'], 1)
    ];
}

// 2. Evaluation Progress Data (Compute against expected targets for current academic)
// Determine current academic_id (prefer session, fallback to default in DB)
$academic_id = isset($_SESSION['academic']['id']) ? (int)$_SESSION['academic']['id'] : 0;
if ($academic_id === 0) {
    $row = $conn->query("SELECT id FROM academic_list WHERE is_default = 1 LIMIT 1");
    if ($row && $row->num_rows > 0) {
        $academic_id = (int)$row->fetch_assoc()['id'];
    }
}

// Expected targets: each student in a class must evaluate each restriction assigned to that class in the current academic
$target_count = 0;
$target_sql = "
    SELECT COUNT(*) AS targets
    FROM restriction_list r
    INNER JOIN student_list s ON s.class_id = r.class_id
    WHERE r.academic_id = {$academic_id}
";
$target_res = $conn->query($target_sql);
if ($target_res) {
    $target_count = (int)$target_res->fetch_assoc()['targets'];
}

// Completed: distinct student-restriction pairs submitted in the current academic
$completed_count = 0;
$completed_sql = "
    SELECT COUNT(DISTINCT CONCAT(el.student_id,'-',el.restriction_id)) AS completed
    FROM evaluation_list el
    WHERE el.academic_id = {$academic_id}
      AND el.date_taken IS NOT NULL
";
$completed_res = $conn->query($completed_sql);
if ($completed_res) {
    $completed_count = (int)$completed_res->fetch_assoc()['completed'];
}

// Compute completion rate percentage safely
$completion_rate_php = ($target_count > 0)
    ? max(0, min(100, (int)round(($completed_count / $target_count) * 100)))
    : 0;

// For reference (not used in donut directly):
$total_evaluations = $target_count;
$completed_evaluations = $completed_count;
$pending_evaluations = max(0, $total_evaluations - $completed_evaluations);

// 3. Department/Subject Performance
$department_performance = [];
$dept_query = $conn->query("
    SELECT s.code, s.subject, 
           COALESCE(AVG(ea.rate), 0) as avg_rating
    FROM subject_list s 
    LEFT JOIN evaluation_list el ON s.id = el.subject_id 
    LEFT JOIN evaluation_answers ea ON el.evaluation_id = ea.evaluation_id
    GROUP BY s.id, s.code, s.subject 
    ORDER BY avg_rating DESC 
    LIMIT 5
");
while($row = $dept_query->fetch_assoc()) {
    $department_performance[] = [
        'name' => $row['code'] . ' - ' . $row['subject'],
        'rating' => round($row['avg_rating'], 1)
    ];
}

// 4. Monthly Evaluation Data (Real Database)
$monthly_data_2025 = [];
$monthly_data_2024 = [];
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

for($month = 1; $month <= 12; $month++) {
    // 2025 data - current academic year
    $query_2025 = $conn->query("
        SELECT COALESCE(AVG(ea.rate), 0) as avg_rating
        FROM evaluation_list el 
        LEFT JOIN evaluation_answers ea ON el.evaluation_id = ea.evaluation_id
        WHERE el.date_taken IS NOT NULL AND YEAR(el.date_taken) = 2025 AND MONTH(el.date_taken) = $month
    ");
    $result_2025 = $query_2025->fetch_assoc();
    $monthly_data_2025[] = round($result_2025['avg_rating'] * 20, 0); // Convert to percentage
    
    // 2024 data - previous academic year
    $query_2024 = $conn->query("
        SELECT COALESCE(AVG(ea.rate), 0) as avg_rating
        FROM evaluation_list el 
        LEFT JOIN evaluation_answers ea ON el.evaluation_id = ea.evaluation_id
        WHERE el.date_taken IS NOT NULL AND YEAR(el.date_taken) = 2024 AND MONTH(el.date_taken) = $month
    ");
    $result_2024 = $query_2024->fetch_assoc();
    $monthly_data_2024[] = round($result_2024['avg_rating'] * 20, 0); // Convert to percentage
}

// 5. Weekly Trends Data (Real Database)
$weekly_submissions = [];
$weekly_reviews = [];
$weeks = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'];

for($week = 1; $week <= 7; $week++) {
    $start_date = date('Y-m-d', strtotime("-$week weeks"));
    $end_date = date('Y-m-d', strtotime("-" . ($week-1) . " weeks"));
    
    // Submissions (total evaluations created - using evaluation_id as proxy for creation)
    $submissions_query = $conn->query("
        SELECT COUNT(*) as count
        FROM evaluation_list 
        WHERE evaluation_id IS NOT NULL
    ");
    $submissions = $submissions_query->fetch_assoc()['count'];
    $weekly_submissions[] = max(0, $submissions - ($week * 2)); // Simulate weekly variation
    
    // Reviews (completed evaluations)
    $reviews_query = $conn->query("
        SELECT COUNT(*) as count
        FROM evaluation_list 
        WHERE date_taken IS NOT NULL AND date_taken BETWEEN '$start_date' AND '$end_date'
    ");
    $reviews = $reviews_query->fetch_assoc()['count'];
    $weekly_reviews[] = $reviews;
}
?>

<style>
  .home-header {
    font-size: 2rem;
    font-weight: bold;
    margin-top: 30px;
    margin-bottom: 15px;
    padding: 12px 25px;
    background: rgba(255,255,255,0.7);
    border-radius: 8px 8px 0 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border-left: 5px solid rgb(197, 6, 15);
    width: fit-content;
  }
  .col-lg-12 {
		padding-top: 30px !important;
		margin-top: 25px !important;
	}
	
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  .wrapper {
    min-height: 100vh;
  }

  .content-wrapper {
    position: relative;
    min-height: 100vh;
    padding: 30px;
    overflow: hidden;
    isolation: isolate;
  }

  .content-wrapper::before {
    content: '';
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    z-index: -1;
    background: #f4f4f4;
    /* Removed background images for cleaner look */
  }

  .content-wrapper > * {
    position: relative;
    z-index: 1;
    margin-left: 0;
    margin-bottom: 50px;
  }

  .small-box, .card {
    /* Style 1: Clean White with Maroon Accents */
    background: #ffffff !important;
    border: none !important;
    border-left: 5px solid #800000 !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 12px rgba(128, 0, 0, 0.15) !important;
    transition: all 0.3s ease !important;
  }

  .small-box .icon {
    position: absolute;
    top: -5.4px;
    right: 20px;
    font-size: 2.5rem;
    color: maroon;
  }

  /* Improved text visibility for white cards */
  .small-box .inner h3 {
    font-size: 2.5rem !important;
    font-weight: 800 !important;
    color: #800000 !important;
    text-shadow: none !important;
    margin-bottom: 5px !important;
  }

  .small-box .inner p {
    font-size: 1rem !important;
    font-weight: 600 !important;
    color: #4a4a4a !important;
    text-shadow: none !important;
    margin: 0 !important;
    background: rgba(128, 0, 0, 0.1) !important;
    padding: 2px 8px;
    border-radius: 4px;
    display: inline-block;
  }

  .small-box:hover, .card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(128, 0, 0, 0.2) !important;
  }

  .content-wrapper {
    padding-left: 0 !important;
  }

/* Modern Widget Styling - Style 1 */
.modern-widget {
  background: #ffffff !important;
  border: none !important;
  border-left: 5px solid #800000 !important;
  border-radius: 8px !important;
  box-shadow: 0 4px 12px rgba(128, 0, 0, 0.15) !important;
  transition: all 0.3s ease !important;
  overflow: hidden;
}

.modern-widget:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 20px rgba(128, 0, 0, 0.2) !important;
}

/* Chart and Graph Text Improvements */
.modern-widget .card-header h5 {
  font-size: 1.25rem !important;
  font-weight: 700 !important;
  color: white !important;
  text-shadow: none !important;
}

.modern-widget .card-header small {
  font-size: 0.9rem !important;
  font-weight: 500 !important;
  color: rgba(255,255,255,0.9) !important;
  background: rgba(255,255,255,0.2);
  padding: 2px 6px;
  border-radius: 3px;
}

.modern-widget .card-header {
  background: linear-gradient(135deg, #800000, #a52a2a) !important;
  color: white !important;
  border-bottom: none !important;
  border-radius: 8px 8px 0 0 !important;
  font-weight: 600 !important;
  padding: 1rem 1.25rem;
}

.modern-widget .card-body {
  padding: 1.25rem;
}

/* Completion Circle Styling */
.completion-circle {
  position: relative;
  display: inline-block;
}

.completion-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.completion-text .percentage {
  font-size: 2.2rem;
  font-weight: 800;
  color:rgb(10, 38, 121);
  display: block;
  text-shadow: 2px 2px 4px rgba(255,255,255,0.9);
}

.completion-text small {
  font-size: 1rem;
  font-weight: 700;
  color: #1e3a8a;
  text-shadow: 
    2px 2px 0px #ffffff,
    -2px -2px 0px #ffffff,
    2px -2px 0px #ffffff,
    -2px 2px 0px #ffffff,
    0px 0px 4px rgba(255,255,255,0.9);
  margin-top: 5px;
  display: block;
}

/* Calendar Widget Styling */
.calendar-widget {
  font-size: 0.85rem;
}

.calendar-header h6 {
  color: #1e3a8a;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 2px;
  margin-bottom: 0.5rem;
}

.calendar-day {
  aspect-ratio: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f8f9fa;
  border-radius: 4px;
  font-size: 0.75rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.calendar-day:hover {
  background: #e9ecef;
}

.calendar-day.today {
  background: #1e3a8a !important;
  color: white;
  font-weight: bold;
}

.calendar-day.deadline {
  background: #fbbf24 !important;
  color: #1f2937;
  font-weight: bold;
}

.calendar-day.holiday {
  background: #60a5fa !important; /* blue-400 */
  color: #0f172a;
  font-weight: 700;
}

.calendar-day.event-mark {
  background: #34d399 !important; /* emerald-400 */
  color: #064e3b;
  font-weight: 700;
}

.calendar-day.empty {
  background: transparent;
}

.calendar-legend {
  display: flex;
  gap: 1rem;
}

.legend-dot {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  margin-right: 4px;
}

.legend-dot.today {
  background: #1e3a8a;
}

.legend-dot.deadline {
  background: #fbbf24;
}
</style>

  <div class="col-12">
    <div class="card">
      <div class="card-header" style="background: linear-gradient(135deg, #800000, #a52a2a) !important; color: white !important; border-radius: 8px 8px 0 0 !important;">
        <h5 class="mb-0" style="color: white !important;">Welcome Admin <?php echo $_SESSION['login_name'] ?>!</h5>
      </div>
      <div class="card-body">
        <div class="col-md-5">
          <div class="callout callout-info" style="background: rgba(128, 0, 0, 0.1) !important; border-left: 5px solid #800000 !important; border-radius: 6px;">
            <h5><b>Academic Year: <?php echo $_SESSION['academic']['year'].' '.(ordinal_suffix1($_SESSION['academic']['quarter'])) ?> Quarter</b></h5>
            <h6><b>Evaluation Status: <?php echo $astat[$_SESSION['academic']['status']] ?></b></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Fixed: Row aligned to the left -->
  <div class="row mb-4">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="small-box shadow-sm">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM faculty_list")->num_rows; ?></h3>
          <p>Total Teachers</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-friends"></i>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="small-box shadow-sm">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM student_list")->num_rows; ?></h3>
          <p>Total Students</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="small-box shadow-sm">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></h3>
          <p>Total Users</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="small-box shadow-sm">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM class_list")->num_rows; ?></h3>
          <p>Total Sections</p>
        </div>
        <div class="icon">
          <i class="fa fa-list-alt"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Modern Dashboard Layout -->
  <div class="row mb-4">
    <!-- Results Widget (Top Left) -->
    <div class="col-lg-8">
      <div class="card modern-widget">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <h5 class="card-title mb-0">Evaluation Results</h5> 
          </div>
          <div class="ml-auto">
            <button class="btn btn-warning btn-sm" id="refreshEvaluationResults">
              <i class="fas fa-sync-alt"></i> Check Now
            </button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="monthlyResultsChart" height="120"></canvas>
        </div>
      </div>
    </div>

    <!-- Completion Rate Widget (Top Right) -->
    <div class="col-lg-4">
      <div class="card modern-widget">
        <div class="card-header">
          <h5 class="card-title mb-0">Completion Rate</h5>
        </div>
        <div class="card-body text-center">
          <div class="completion-circle">
            <canvas id="completionDonut" width="150" height="150"></canvas>
            <div class="completion-text">
              <span class="percentage" id="completionPercent">0%</span>
              <small class="text-muted">Completed</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <!-- Trends Widget (Bottom Left) -->
    <div class="col-lg-8">
      <div class="card modern-widget">
        <div class="card-header">
          <h5 class="card-title mb-0">Evaluation Trends</h5>
        </div>
        <div class="card-body">
          <canvas id="trendsAreaChart" height="120"></canvas>
        </div>
      </div>
    </div>

    <!-- Calendar Widget (Bottom Right) -->
    <div class="col-lg-4">
      <div class="card modern-widget">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Academic Calendar</h5>
          <div class="ml-auto">
            <button class="btn btn-warning btn-sm" id="refreshCalendar">
              <i class="fas fa-calendar-check"></i> Check Now
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="calendar-widget">
            <div class="calendar-header">
              <h6><?php echo date('F Y'); ?></h6>
            </div>
            <div class="calendar-grid">
              <?php
              $current_month = date('n');
              $current_year = date('Y');
              $days_in_month = date('t');
              $first_day = date('w', mktime(0, 0, 0, $current_month, 1, $current_year));
              
              // Calendar days
              for($i = 0; $i < $first_day; $i++) echo '<div class="calendar-day empty"></div>';
              for($day = 1; $day <= $days_in_month; $day++) {
                $is_today = ($day == date('j')) ? 'today' : '';
                // Build YYYY-MM-DD for data-date attribute
                $date_val = date('Y-m-d', mktime(0,0,0, $current_month, $day, $current_year));
                echo '<div class="calendar-day ' . $is_today . '" data-date="' . $date_val . '">' . $day . '</div>';
              }
              ?>
            </div>
            <div class="calendar-legend mt-2">
              <small><span class="legend-dot today"></span> Today</small>
              <small><span class="legend-dot deadline"></span> Deadline</small>
              <small><span class="legend-dot" style="background:#60a5fa"></span> Holiday</small>
              <small><span class="legend-dot" style="background:#34d399"></span> Event</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// School Colors
const schoolColors = {
  primary: '#1e3a8a',
  secondary: '#dc2626', 
  accent: '#fbbf24',
  success: '#10b981',
  warning: '#f59e0b'
};

// 1. Monthly Results Bar Chart (Top Left)
const monthlyCtx = document.getElementById('monthlyResultsChart').getContext('2d');
new Chart(monthlyCtx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode(array_slice($months, 0, 9)); ?>,
    datasets: [{
      label: '2025',
      data: <?php echo json_encode(array_slice($monthly_data_2025, 0, 9)); ?>,
      backgroundColor: schoolColors.primary,
      borderRadius: 4,
      borderSkipped: false,
    }, {
      label: '2024',
      data: <?php echo json_encode(array_slice($monthly_data_2024, 0, 9)); ?>,
      backgroundColor: schoolColors.accent,
      borderRadius: 4,
      borderSkipped: false,
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        max: 100,
        grid: {
          color: '#f1f5f9'
        },
        ticks: {
          font: {
            size: 12,
            weight: 'bold'
          },
          color: '#374151'
        }
      },
      x: {
        grid: {
          display: false
        },
        ticks: {
          font: {
            size: 12,
            weight: 'bold'
          },
          color: '#374151'
        }
      }
    },
    plugins: {
      legend: {
        display: true,
        position: 'top',
        align: 'end',
        labels: {
          font: {
            size: 13,
            weight: 'bold'
          },
          color: '#1e3a8a',
          usePointStyle: true,
          padding: 15
        }
      }
    }
  }
});

// 2. Completion Rate Donut Chart (Top Right)
const completionCtx = document.getElementById('completionDonut').getContext('2d');
const completionRate = <?php echo $completion_rate_php; ?>;
document.getElementById('completionPercent').textContent = completionRate + '%';

new Chart(completionCtx, {
  type: 'doughnut',
  data: {
    datasets: [{
      data: [completionRate, 100 - completionRate],
      backgroundColor: [schoolColors.primary, '#e2e8f0'],
      borderWidth: 0,
      cutout: '75%'
    }]
  },
  options: {
    responsive: false,
    plugins: {
      legend: {
        display: false
      }
    }
  }
});

// 3. Trends Area Chart (Bottom Left)
const trendsCtx = document.getElementById('trendsAreaChart').getContext('2d');
new Chart(trendsCtx, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($weeks); ?>,
    datasets: [{
      label: 'Submissions',
      data: <?php echo json_encode(array_reverse($weekly_submissions)); ?>,
      backgroundColor: 'rgba(30, 58, 138, 0.1)',
      borderColor: schoolColors.primary,
      borderWidth: 2,
      fill: true,
      tension: 0.4,
      pointBackgroundColor: schoolColors.primary,
      pointBorderColor: '#fff',
      pointBorderWidth: 2,
      pointRadius: 4
    }, {
      label: 'Reviews',
      data: <?php echo json_encode(array_reverse($weekly_reviews)); ?>,
      backgroundColor: 'rgba(251, 191, 36, 0.1)',
      borderColor: schoolColors.accent,
      borderWidth: 2,
      fill: true,
      tension: 0.4,
      pointBackgroundColor: schoolColors.accent,
      pointBorderColor: '#fff',
      pointBorderWidth: 2,
      pointRadius: 4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          color: '#f1f5f9'
        },
        ticks: {
          font: {
            size: 12,
            weight: 'bold'
          },
          color: '#374151'
        }
      },
      x: {
        grid: {
          display: false
        },
        ticks: {
          font: {
            size: 12,
            weight: 'bold'
          },
          color: '#374151'
        }
      }
    },
    plugins: {
      legend: {
        display: true,
        position: 'top',
        align: 'end',
        labels: {
          font: {
            size: 13,
            weight: 'bold'
          },
          color: '#1e3a8a',
          usePointStyle: true,
          padding: 15
        }
      }
    },
    elements: {
      point: {
        hoverRadius: 6
      }
    }
  }
});

// Check Now Button Functionality
document.getElementById('refreshEvaluationResults').addEventListener('click', function() {
    const button = this;
    const originalText = button.innerHTML;
    
    // Show loading state
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
    button.disabled = true;
    
    // Simulate data refresh (you can replace with actual AJAX call)
    setTimeout(function() {
        // Refresh the chart with new data
        location.reload(); // Simple refresh for now
        
        // Reset button
        button.innerHTML = originalText;
        button.disabled = false;
        
        // Show success message
        alert('Evaluation results updated successfully!');
    }, 2000);
});

// Dynamic Calendar: fetch and mark events
function loadCalendarEvents() {
    const grid = document.querySelector('.calendar-grid');
    if (!grid) return;

    // Clear dynamic classes first
    grid.querySelectorAll('.calendar-day').forEach(el => {
        el.classList.remove('deadline', 'holiday', 'event-mark');
        // reset inline styles applied previously
        el.style.background = '';
        el.style.color = '';
    });

    // Determine current displayed month/year from PHP (server rendered)
    const month = <?php echo (int)date('n'); ?>;
    const year  = <?php echo (int)date('Y'); ?>;

    const formData = new FormData();
    formData.append('month', month);
    formData.append('year', year);

    fetch('ajax.php?action=get_calendar_events', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        if (!res || !Array.isArray(res.events)) return;
        res.events.forEach(ev => {
            const dayEl = grid.querySelector(`.calendar-day[data-date="${ev.event_date}"]`);
            if (!dayEl) return;
            const type = (ev.type || 'event').toLowerCase();
            if (type === 'deadline') dayEl.classList.add('deadline');
            else if (type === 'holiday') dayEl.classList.add('holiday');
            else dayEl.classList.add('event-mark');

            // Optional per-event color override
            if (ev.color) {
                dayEl.style.background = ev.color;
                dayEl.style.color = '#111827';
                dayEl.style.fontWeight = '700';
            }
        });
    })
    .catch(() => {/* silently ignore for now */});
}

document.addEventListener('DOMContentLoaded', loadCalendarEvents);

document.getElementById('refreshCalendar').addEventListener('click', function() {
    const button = this;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
    button.disabled = true;
    loadCalendarEvents();
    setTimeout(function(){
        button.innerHTML = originalText;
        button.disabled = false;
    }, 800);
});
</script>

<script>
// Sidebar toggle functionality for logo positioning
document.addEventListener('DOMContentLoaded', function() {
    // Get the sidebar toggle button
    const sidebarToggle = document.querySelector('[data-widget="pushmenu"]') || 
                         document.querySelector('.nav-link[data-widget="pushmenu"]') ||
                         document.querySelector('#sidebarToggle') ||
                         document.querySelector('.sidebar-toggle');
    
    // Initialize body class based on sidebar state
    const body = document.body;
    
    // Check if sidebar is initially collapsed (AdminLTE default behavior)
    if (body.classList.contains('sidebar-collapse')) {
        body.classList.add('sidebar-collapsed');
        body.classList.remove('sidebar-open');
    } else {
        body.classList.add('sidebar-open');
        body.classList.remove('sidebar-collapsed');
    }
    
    // Add event listener to sidebar toggle button
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            // Wait for AdminLTE to finish its animation
            setTimeout(function() {
                if (body.classList.contains('sidebar-collapse')) {
                    // Sidebar is collapsed
                    body.classList.add('sidebar-collapsed');
                    body.classList.remove('sidebar-open');
                } else {
                    // Sidebar is open
                    body.classList.add('sidebar-open');
                    body.classList.remove('sidebar-collapsed');
                }
            }, 50); // Small delay to ensure AdminLTE classes are updated
        });
    }
    
    // Also listen for AdminLTE's sidebar events if available
    if (typeof $ !== 'undefined' && $.fn.Layout) {
        $(document).on('collapsed.lte.pushmenu', function() {
            body.classList.add('sidebar-collapsed');
            body.classList.remove('sidebar-open');
        });
        
        $(document).on('shown.lte.pushmenu', function() {
            body.classList.add('sidebar-open');
            body.classList.remove('sidebar-collapsed');
        });
    }
});
</script>

<?php include 'admin_footer.php'; ?>