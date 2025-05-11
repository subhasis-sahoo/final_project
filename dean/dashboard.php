<?php

include_once "../header.php";
include_once "sidebar.php";

$sic = $_SESSION['sic'];

$roles = [
    "DEAN" => "dean",
    "Accounts" => "accounts section",
    "Examination Cell" => "exam cell",
    "Faculty Advisor" => "faculty advisor"
];

require_once "functions.php";

$staffRole = getStaffRole($sic)->fetch_assoc()['role'];
// print_r($staffRole);
$formatedStaffRole = $roles[$staffRole];
// print_r($formatedStaffRole);


// Create a staffrole sessison
$_SESSION['role'] = $formatedStaffRole;

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
            ['text' => 'Review Application', 'icon' => 'fa-magnifying-glass', 'link' => 'review_applications.php']
        ]
    ]
];

// Sample data for cards - In a real application, this would come from a database
$demoCards = [
    [
        'title' => 'Faculty Overview',
        'color' => 'steelblue',
        'icon' => 'fa-chalkboard-teacher',
        'content' => [
            'Active Faculty' => '89',
            'On Leave Today' => '3'
        ],
        'actions' => [
            ['text' => 'Faculty List', 'icon' => 'fa-list', 'link' => 'faculty-overview.php']
        ]
    ],
    [
        'title' => 'Student Issues',
        'color' => 'tomato',
        'icon' => 'fa-user-check',
        'content' => [
            'New Complaints' => '7',
            'Pending Resolution' => '12'
        ],
        'actions' => [
            ['text' => 'Review Issues', 'icon' => 'fa-eye', 'link' => 'student-issues.php']
        ]
    ],
    [
        'title' => 'Exam Performance',
        'color' => 'mediumslateblue',
        'icon' => 'fa-file-alt',
        'content' => [
            'Average Score' => '74.3%',
            'Topper' => '97%'
        ],
        'actions' => [
            ['text' => 'Exam Reports', 'icon' => 'fa-chart-bar', 'link' => 'exam-reports.php']
        ]
    ],
    [
        'title' => 'Defaulter List',
        'color' => 'crimson',
        'icon' => 'fa-user-times',
        'content' => [
            'Short Attendance' => '19',
            'Fee Dues' => '23'
        ],
        'actions' => [
            ['text' => 'View List', 'icon' => 'fa-list-alt', 'link' => 'defaulters.php']
        ]
    ],
    [
        'title' => 'Attendance Summary',
        'color' => 'mediumturquoise',
        'icon' => 'fa-calendar-check',
        'content' => [
            'Overall Avg' => '82%',
            'Critical Cases' => '5'
        ],
        'actions' => [
            ['text' => 'Check Summary', 'icon' => 'fa-chart-pie', 'link' => 'attendance-summary.php']
        ]
    ],
    [
        'title' => 'Leave Applications',
        'color' => 'orange',
        'icon' => 'fa-envelope-open-text',
        'content' => [
            'Pending Faculty Leaves' => '4',
            'Student Leave Requests' => '9'
        ],
        'actions' => [
            ['text' => 'Manage Leaves', 'icon' => 'fa-calendar-minus', 'link' => 'leave-applications.php']
        ]
    ],
    [
        'title' => 'Course Feedback',
        'color' => 'mediumorchid',
        'icon' => 'fa-comments',
        'content' => [
            'Feedback Window' => 'Open'
        ],
        'actions' => [
            ['text' => 'View Feedback', 'icon' => 'fa-comment-dots', 'link' => 'course-feedback.php']
        ]
    ],
    [
        'title' => 'Notices & Circulars',
        'color' => 'goldenrod',
        'icon' => 'fa-bullhorn',
        'content' => [
            'New Notices' => '2'
        ],
        'actions' => [
            ['text' => 'Publish Notice', 'icon' => 'fa-plus-circle', 'link' => 'notices.php']
        ]
    ],
    [
        'title' => 'Reports & Analytics',
        'color' => 'seagreen',
        'icon' => 'fa-chart-line',
        'content' => [
            'This Month' => '8 Reports'
        ],
        'actions' => [
            ['text' => 'View Reports', 'icon' => 'fa-eye', 'link' => 'reports.php']
        ]
    ],
    [
        'title' => 'Utilities',
        'color' => 'gray',
        'icon' => 'fa-tools',
        'content' => [],
        'actions' => [
            ['text' => 'Download Data', 'icon' => 'fa-download', 'link' => 'utilities.php'],
            ['text' => 'Search Student', 'icon' => 'fa-search', 'link' => 'student-search.php'],
            ['text' => 'Reset Access', 'icon' => 'fa-unlock-alt', 'link' => 'reset-access.php']
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
<div class="container-fluid mt-3 mx-0 px-4 dashboard-container main-container">
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