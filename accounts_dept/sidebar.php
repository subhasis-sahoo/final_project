<?php
// sidebar.php - Reusable sidebar navigation component

// Navigation items - In a real application, these might come from a database
// Format: [label, icon, link]
$navItems = [
    ['Dashboard', 'fa-tachometer-alt', 'dashboard.php'],
    ['Fee Collection', 'fa-cash-register', 'fee-collection.php'],
    ['Due Verification', 'fa-exclamation-circle', 'due-verification.php'],
    ['Payment History', 'fa-history', 'payment-history.php'],
    ['Challan Generation', 'fa-file-invoice-dollar', 'challan.php'],
    ['Online Payments', 'fa-globe', 'online-payments.php'],
    ['Refund Requests', 'fa-undo', 'refunds.php'],
    ['Student Ledger', 'fa-book', 'ledger.php'],
    ['Reports', 'fa-file-alt', 'accounts-reports.php'],
    ['Notices & Updates', 'fa-bullhorn', 'notices.php'],
    ['Email Students', 'fa-envelope', 'email-students.php'],
    ['Offline Collection Entry', 'fa-keyboard', 'offline-entry.php'],
    ['Support Tickets', 'fa-life-ring', 'support.php'],
    ['Backup & Restore', 'fa-database', 'backup.php']
];

?>

<!-- Sidebar Navigation -->
<div class="sidebar-container">
    <div class="sidebar" id="sidebar">
        <!-- Siebar header with toggle button -->
        <div class="d-flex justify-content-between align-item-center sidebar-header">
            <span class="sidebar-title">Acount Dept. Portal</span>
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
