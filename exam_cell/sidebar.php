<?php
// sidebar.php - Reusable sidebar navigation component

// Navigation items - In a real application, these might come from a database
// Format: [label, icon, link]
$navItems = [
    ['Dashboard', 'fa-tachometer-alt', 'dashboard.php'],
    ['Exam Registration', 'fa-edit', 'exam-registration.php'],
    ['Admit Card', 'fa-id-card', 'admit-card.php'],
    ['Exam Schedule', 'fa-calendar-alt', 'exam-schedule.php'],
    ['Results', 'fa-poll', 'results.php'],
    ['Student Applications', 'fa-folder-open', 'applications.php'],
    ['Attendance & Dues', 'fa-user-check', 'attendance-dues.php'],
    ['Notifications', 'fa-bell', 'notifications.php'],
    ['Student Queries', 'fa-question-circle', 'student-queries.php'],
    ['Exam Reports', 'fa-chart-bar', 'exam-reports.php'],
    ['Revaluation Requests', 'fa-sync-alt', 'revaluation.php'],
    ['Exam Guidelines', 'fa-book', 'exam-guidelines.php'],
    ['Circulars', 'fa-bullhorn', 'circulars.php'],
    ['Support', 'fa-life-ring', 'support.php']
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
