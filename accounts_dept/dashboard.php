<?php

include_once "../header.php";
include_once "sidebar.php";

// Actual functional cards tailered with data that comes from database
$realCards = [
    [
        'title' => 'Publish Notices',
        'color' => 'indianred',
        'icon' => 'fa-bullhorn',
        'content' => [
            'Total Notices' => '2'
        ],
        'actions' => [
            ['text' => 'Publish New Notice', 'icon' => 'fa-upload', 'link' => 'new_notice.php'],
            ['text' => 'All Notices', 'icon' => 'fa-history', 'link' => 'all_notices.php']
        ]
    ],
    [
        'title' => 'Students Dues Info.',
        'color' => 'seagreen',
        'icon' => 'fa-money-bill-wave',
        'content' => [
            'Total Students' => '15'
        ],
        'actions' => [
            ['text' => 'Account Details', 'icon' => 'fa-credit-card', 'link' => 'account_details.php']
        ]
    ],
    [
        'title' => 'Application Box',
        'color' => 'orange',
        'icon' => 'fa-box-archive',
        'content' => [
            'Total Applications' => '3',
        ],
        'actions' => [
            ['text' => 'Review Application', 'icon' => 'fa-magnifying-glass', 'link' => 'review_application.php']
        ]
    ]
];

// Sample data for cards - In a real application, this would come from a database
$demoCards = [
    [
        'title' => 'Fee Collection',
        'color' => 'mediumseagreen',
        'icon' => 'fa-cash-register',
        'content' => [
            'Today' => '₹ 52,000',
            'This Month' => '₹ 8.3 L'
        ],
        'actions' => [
            ['text' => 'View Details', 'icon' => 'fa-eye', 'link' => 'fee-collection.php']
        ]
    ],
    [
        'title' => 'Pending Dues',
        'color' => 'tomato',
        'icon' => 'fa-exclamation-triangle',
        'content' => [
            'Students with Dues' => '148',
            'Critical Dues' => '17'
        ],
        'actions' => [
            ['text' => 'Check Dues', 'icon' => 'fa-list', 'link' => 'due-verification.php']
        ]
    ],
    [
        'title' => 'Online Payments',
        'color' => 'dodgerblue',
        'icon' => 'fa-globe',
        'content' => [
            'Successful' => '421',
            'Failed' => '8'
        ],
        'actions' => [
            ['text' => 'Payment Gateway', 'icon' => 'fa-link', 'link' => 'online-payments.php']
        ]
    ],
    [
        'title' => 'Challan Requests',
        'color' => 'darkorange',
        'icon' => 'fa-file-invoice',
        'content' => [
            'Pending' => '12',
            'Generated Today' => '7'
        ],
        'actions' => [
            ['text' => 'Generate Challan', 'icon' => 'fa-file-alt', 'link' => 'challan.php']
        ]
    ],
    [
        'title' => 'Refund Applications',
        'color' => 'mediumvioletred',
        'icon' => 'fa-undo-alt',
        'content' => [
            'Pending' => '3',
            'Approved' => '11'
        ],
        'actions' => [
            ['text' => 'Process Refunds', 'icon' => 'fa-cogs', 'link' => 'refunds.php']
        ]
    ],
    [
        'title' => 'Ledger Updates',
        'color' => 'slateblue',
        'icon' => 'fa-book',
        'content' => [],
        'actions' => [
            ['text' => 'View Ledger', 'icon' => 'fa-eye', 'link' => 'ledger.php']
        ]
    ],
    [
        'title' => 'Student Queries',
        'color' => 'cadetblue',
        'icon' => 'fa-comments',
        'content' => [
            'New Queries' => '5'
        ],
        'actions' => [
            ['text' => 'Respond', 'icon' => 'fa-reply', 'link' => 'support.php']
        ]
    ],
    [
        'title' => 'Reports',
        'color' => 'indianred',
        'icon' => 'fa-chart-bar',
        'content' => [
            'This Month' => '5 Reports'
        ],
        'actions' => [
            ['text' => 'Download Reports', 'icon' => 'fa-download', 'link' => 'accounts-reports.php']
        ]
    ],
    [
        'title' => 'Utilities',
        'color' => 'teal',
        'icon' => 'fa-tools',
        'content' => [],
        'actions' => [
            ['text' => 'Bulk Upload', 'icon' => 'fa-upload', 'link' => 'bulk-upload.php'],
            ['text' => 'Offline Entry', 'icon' => 'fa-keyboard', 'link' => 'offline-entry.php'],
            ['text' => 'Data Backup', 'icon' => 'fa-database', 'link' => 'backup.php']
        ]
    ],
    [
        'title' => 'Announcements',
        'color' => 'goldenrod',
        'icon' => 'fa-bullhorn',
        'content' => [
            'Active Notices' => '4'
        ],
        'actions' => [
            ['text' => 'Publish Notice', 'icon' => 'fa-plus-circle', 'link' => 'notices.php']
        ]
    ]
];




// Function to render cards
function renderDashboardCards($card) {
    $iconBgColor = isset($card['color']) ? $card['color'] : 'primary';
    // $iconClass = isset($card['icon']) ? $card['icon'] : 'fa-info-circle';
    ?>
    <div class="col-md-6 col-lg-4 col-xl-4 mb-4 card p-0 dashboard-card">
        <div class="card-header" style="background-color: <?php echo $iconBgColor ?>;">
            <h5 class="text-white"><?php echo $card['title'] ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8 contents">
                    <?php 
                        foreach ($card['content'] as $label => $value) {
                            ?>
                            <div class="d-flex align-item-center gap-2 content">
                                <h6><?php echo $label ?>:</h6>
                                <span><?php echo $value ?></span>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="col-4 text-center">
                    <div class="card-icon-container" style="background-color: <?php echo $iconBgColor ?>;">
                        <i class="fas <?php echo $card['icon'] ?> fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-around">
                <?php
                    foreach ($card['actions'] as $item) {
                        ?>
                        <a href="<?php echo $item['link'] ?>" class="d-flex align-item-center gap-1 card-action-link">
                            <i class="fas <?php echo $item['icon'] ?> my-auto"></i>
                            <p class="m-0 p-0"><?php echo $item['text'] ?></p>
                        </a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>



<!-- Dashboard Grid -->
<div class="container-fluid mt-0 mx-0 px-4 dashboard-container main-container">
    <div class="mb-3 border-bottom">
        <h3 class="mb-3">Dashboard</h3>
    </div>
    <div class="row mx-0 d-felx flex-wrap justify-content-between">
        <?php
        // Render each real cards in the grid
        foreach ($realCards as $card) {
            renderDashboardCards($card);
        }

        // Render each demo cards in the grid
        foreach ($demoCards as $card) {
            renderDashboardCards($card);
        }
        ?>
    </div>
</div>

<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>