<?php

include_once "../header.php";
include_once "sidebar.php";

// Actual functional cards tailered with data that comes from database

// Sample data for cards - In a real application, this would come from a database
$demoCards = [
    [
        'title' => 'Exam Applications',
        'color' => 'mediumseagreen',
        'icon' => 'fa-clipboard-check',
        'content' => [
            'Total Received' => '124',
            'Approved' => '118',
            'Pending' => '6'
        ],
        'actions' => [
            ['text' => 'View Applications', 'icon' => 'fa-eye', 'link' => 'exam-applications.php']
        ]
    ],
    [
        'title' => 'Admit Card Management',
        'color' => 'deepskyblue',
        'icon' => 'fa-id-badge',
        'content' => [
            'Status' => 'Available',
            'Next Exam Date' => 'April 10, 2025'
        ],
        'actions' => [
            ['text' => 'Manage Cards', 'icon' => 'fa-cog', 'link' => 'manage-admit.php']
        ]
    ],
    [
        'title' => 'Exam Schedule',
        'color' => 'royalblue',
        'icon' => 'fa-calendar-alt',
        'content' => [
            'Autonomous Exams' => '3',
            'Class Tests' => '5'
        ],
        'actions' => [
            ['text' => 'Update Schedule', 'icon' => 'fa-edit', 'link' => 'update-schedule.php']
        ]
    ],
    [
        'title' => 'Result Processing',
        'color' => 'tomato',
        'icon' => 'fa-chart-line',
        'content' => [
            'In Progress' => '2',
            'Published' => '6'
        ],
        'actions' => [
            ['text' => 'Manage Results', 'icon' => 'fa-cogs', 'link' => 'manage-results.php']
        ]
    ],
    [
        'title' => 'Dues Verification',
        'color' => 'mediumvioletred',
        'icon' => 'fa-money-check-alt',
        'content' => [
            'Students with Dues' => '42'
        ],
        'actions' => [
            ['text' => 'View Dues List', 'icon' => 'fa-list', 'link' => 'verify-dues.php']
        ]
    ],
    [
        'title' => 'Eligibility Status',
        'color' => 'goldenrod',
        'icon' => 'fa-user-check',
        'content' => [
            'Low Attendance' => '17',
            'Blocked Students' => '4'
        ],
        'actions' => [
            ['text' => 'Manage Eligibility', 'icon' => 'fa-tasks', 'link' => 'manage-eligibility.php']
        ]
    ],
    [
        'title' => 'Application History',
        'color' => 'lightseagreen',
        'icon' => 'fa-history',
        'content' => [],
        'actions' => [
            ['text' => 'View History', 'icon' => 'fa-archive', 'link' => 'application-history.php']
        ]
    ],
    [
        'title' => 'Publish Notices',
        'color' => 'indianred',
        'icon' => 'fa-bullhorn',
        'content' => [
            'New Notices' => '2'
        ],
        'actions' => [
            ['text' => 'Publish', 'icon' => 'fa-upload', 'link' => 'publish-notice.php']
        ]
    ],
    [
        'title' => 'Student Queries',
        'color' => 'slateblue',
        'icon' => 'fa-question-circle',
        'content' => [
            'Open Tickets' => '5'
        ],
        'actions' => [
            ['text' => 'Respond Now', 'icon' => 'fa-reply', 'link' => 'student-queries.php']
        ]
    ],
    [
        'title' => 'Reports',
        'color' => 'cadetblue',
        'icon' => 'fa-file-alt',
        'content' => [
            'Monthly Reports' => 'Available'
        ],
        'actions' => [
            ['text' => 'Download Reports', 'icon' => 'fa-download', 'link' => 'exam-reports.php']
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
        // foreach ($realCards as $card) {
        //     renderDashboardCards($card);
        // }

        // Render each demo cards in the grid
        foreach ($demoCards as $card) {
            renderDashboardCards($card);
        }
        ?>
    </div>
</div>

<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>