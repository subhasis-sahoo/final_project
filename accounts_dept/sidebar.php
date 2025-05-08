<?php
// sidebar.php - Reusable sidebar navigation component for Accountant Section
// Navigation items - In a real application, these might come from a database
// Format: [label, icon, link]
$navItems = [
    ['Student Fees', 'fa-money-bill-wave', 'student-fees.php'],
    ['Fee Collection', 'fa-cash-register', 'fee-collection.php'],
    ['Pending Dues', 'fa-exclamation-circle', 'pending-dues.php'],
    ['Expense Management', 'fa-file-invoice-dollar', 'expenses.php'],
    ['Salary Management', 'fa-wallet', 'salary.php'],
    ['Budget Planning', 'fa-chart-pie', 'budget.php'],
    ['Financial Reports', 'fa-chart-bar', 'financial-reports.php'],
    ['Audit Reports', 'fa-audit', 'audit-reports.php'],
    ['Tax Management', 'fa-percentage', 'tax-management.php'],
    ['Scholarships', 'fa-award', 'scholarships.php'],
    ['Bank Transactions', 'fa-university', 'bank-transactions.php'],
    ['Invoice Generator', 'fa-file-invoice', 'invoice-generator.php'],
    ['Settings', 'fa-cog', 'settings.php']
];
?>

<!-- Sidebar Navigation -->
<div class="sidebar-container">
    <div class="sidebar" id="sidebar">
        <!-- Sidebar header with toggle button -->
        <div class="d-flex justify-content-between align-item-center sidebar-header">
            <span class="sidebar-title">Accountant Portal</span>
            <button class="btn sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <ul class="nav flex-column sidebar-nav">
            <?php
            foreach ($navItems as $item) {
            ?>
                <li class="nav-item">
                    <a href="<?php echo $item[2]; ?>" class="nav-link">
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

<script src="../utilities/scripts/sidebar.js?v=<?php echo time() ?>" ></script>