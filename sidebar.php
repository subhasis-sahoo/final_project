<?php
// sidebar.php - Reusable sidebar navigation component

// Navigation items - In a real application, these might come from a database
// Format: [label, icon, link]
$navItems = [
    ['Hostel', 'fa-building', 'hostel.php'],
    ['Activity', 'fa-chart-line', 'activity.php'],
    ['Academics', 'fa-graduation-cap', 'academics.php'],
    ['Planning', 'fa-calendar-alt', 'planning.php'],
    ['Activity', 'fa-tasks', 'daily-activity.php'],
    ['DMS', 'fa-folder', 'document-management.php'],
    ['Inbox', 'fa-envelope', 'inbox.php'],
    ['Library', 'fa-book', 'library.php'],
    ['Report', 'fa-file-alt', 'report.php'],
    ['Canteen', 'fa-utensils', 'canteen.php'],
    ['Repository', 'fa-archive', 'repository.php'],
    ['Student Handbook', 'fa-book-open', 'handbook.php'],
    ['Anti Ragging', 'fa-shield-alt', 'anti-ragging.php'],
    ['Activity', 'fa-clipboard-list', 'activity-tracker.php']
];
?>

<!-- Sidebar Navigation -->
<div class="sidebar-container">
    <div class="sidebar" id="sidebar">
        <!-- Siebar header with toggle button -->
        <div class="d-flex justify-content-between align-item-center sidebar-header">
            <span class="sidebar-title">Student Portal</span>
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
