<?php
// sidebar.php - Reusable sidebar navigation component

// Navigation items - In a real application, these might come from a database
// Format: [label, icon, link]
$navItems = [
    ['Dashboard', 'fa-tachometer-alt', 'dashboard.php'],
    ['My Students', 'fa-users', 'my-students.php'],
    ['Attendance Reports', 'fa-calendar-check', 'attendance-reports.php'],
    ['Defaulter List', 'fa-user-times', 'defaulters.php'],
    ['Dues Clearance', 'fa-rupee-sign', 'dues-clearance.php'],
    ['Exam Registration', 'fa-file-signature', 'exam-registration.php'],
    ['Result Review', 'fa-poll', 'result-review.php'],
    ['Course Feedback', 'fa-comments', 'course-feedback.php'],
    ['Student Progress', 'fa-chart-line', 'student-progress.php'],
    ['Leave Applications', 'fa-envelope-open-text', 'leave-applications.php'],
    ['Counselling Records', 'fa-notes-medical', 'counselling.php'],
    ['Notices & Updates', 'fa-bullhorn', 'notices.php'],
    ['Guidelines', 'fa-book', 'guidelines.php'],
    ['Utilities', 'fa-tools', 'utilities.php']
];
?>

<!-- Sidebar Navigation -->
<div class="sidebar-container">
    <div class="sidebar" id="sidebar">
        <!-- Siebar header with toggle button -->
        <div class="d-flex justify-content-between align-item-center sidebar-header">
            <span class="sidebar-title">Exam Cell Portal</span>
            <button class="btn sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <ul class="nav flex-column sidebar-nav">
            <?php
                foreach ($navItems as $item) {
                    ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas <?php echo $item[1]; ?> nav-icon"></i>
                            <span class="nav-text"><?php echo $item[0]; ?></span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </a>
                    </li>
                    <?php
                }
            ?>
        </ul>
    </div>
</div>

<!-- <script src="./scripts/sidebar.js"></script> -->
<script src="../utilities/scripts/sidebar.js?v=<?php echo time(); ?>"></script>
