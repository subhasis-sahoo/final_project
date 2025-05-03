<?php

include_once "../header.php";
include_once "./sidebar.php";

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
        'title' => 'Eligibility Status',
        'color' => 'goldenrod',
        'icon' => 'fa-user-check',
        'content' => [
            'Low Attendance' => '5',
            'Unpaid Dues' => '7'
        ],
        'actions' => [
            ['text' => 'View Eligibility Status', 'icon' => 'fa-eye', 'link' => 'eligibility_status.php']
        ]
    ],
    [
        'title' => 'Exam Registration Management',
        'color' => 'mediumseagreen',
        'icon' => 'fa-clipboard-check',
        'content' => [
            'Total Students' => '124',
            'Eligible Students' => '118'
        ],
        'actions' => [
            ['text' => 'Complete Registration', 'icon' => 'fa-check-circle', 'link' => 'complete_registration.php'],
            ['text' => 'Schedule Deadline', 'icon' => 'fa-calendar-alt', 'link' => 'schedule_registration.php']
        ]
    ],
    [
        'title' => 'Admit Card Management',
        'color' => 'deepskyblue',
        'icon' => 'fa-id-badge',
        'content' => [
            'Total Students' => '124',
            'Eligible Students' => '118'
        ],
        'actions' => [
            ['text' => 'Manage Distribution', 'icon' => 'fa-cog', 'link' => 'manage_admit.php'],
            ['text' => 'Schedule Deadline', 'icon' => 'fa-calendar-alt', 'link' => 'schedule_distribution.php']
        ]
    ]
];

// Sample data for cards - In a real application, this would come from a database
$demoCards = [
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
    ],
    [
        'title' => 'Profile',
        'color' => 'mediumseagreen',
        'icon' => 'fa-id-card',
        'content' => [
            'Name' => 'Subham Sahoo',
            'Mobile No.' => '8249867525',
            'Email' => 'uec.12mmue24.silicon.ac.in'  
        ],
        'actions' => [
            ['text' => 'More Info', 'icon' => 'fa-info-circle', 'link' => 'profile-info.php']
        ]
    ],
    [
        'title' => 'Holidays',
        'color' => 'mediumturquoise',
        'icon' => 'fa-umbrella-beach',
        'content' => [
            'Leave Year' => '2024-25',
            'Total Holiday' => '26'
        ],
        'actions' => [
            ['text' => 'View List', 'icon' => 'fa-list', 'link' => 'holiday-list.php']
        ]
    ],
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