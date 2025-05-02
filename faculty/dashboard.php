<?php

include_once "../header.php";
include_once "sidebar.php";

// Actual functional cards tailered with data that comes from database

// Sample data for cards - In a real application, this would come from a database
$demoCards = [
    [
        'title' => 'My Students',
        'color' => 'dodgerblue',
        'icon' => 'fa-users',
        'content' => [
            'Total Students' => '24',
            'Pending Issues' => '3'
        ],
        'actions' => [
            ['text' => 'View List', 'icon' => 'fa-eye', 'link' => 'my-students.php']
        ]
    ],
    [
        'title' => 'Attendance Reports',
        'color' => 'teal',
        'icon' => 'fa-calendar-check',
        'content' => [
            'Short Attendance' => '2',
            'Last Updated' => '01 Apr 2025'
        ],
        'actions' => [
            ['text' => 'Download Report', 'icon' => 'fa-download', 'link' => 'attendance-reports.php']
        ]
    ],
    [
        'title' => 'Dues Clearance',
        'color' => 'tomato',
        'icon' => 'fa-rupee-sign',
        'content' => [
            'Pending Clearances' => '5'
        ],
        'actions' => [
            ['text' => 'View Details', 'icon' => 'fa-file-invoice', 'link' => 'dues-clearance.php']
        ]
    ],
    [
        'title' => 'Exam Registration',
        'color' => 'mediumslateblue',
        'icon' => 'fa-file-signature',
        'content' => [
            'Students Registered' => '20',
            'Issues Found' => '1'
        ],
        'actions' => [
            ['text' => 'Check Status', 'icon' => 'fa-clipboard-check', 'link' => 'exam-registration.php']
        ]
    ],
    [
        'title' => 'Result Review',
        'color' => 'seagreen',
        'icon' => 'fa-poll',
        'content' => [
            'Latest Result' => 'Released',
            'Pending Queries' => '2'
        ],
        'actions' => [
            ['text' => 'Review Results', 'icon' => 'fa-eye', 'link' => 'result-review.php']
        ]
    ],
    [
        'title' => 'Leave Applications',
        'color' => 'orange',
        'icon' => 'fa-envelope-open-text',
        'content' => [
            'Pending Requests' => '3'
        ],
        'actions' => [
            ['text' => 'Approve/Deny', 'icon' => 'fa-check-circle', 'link' => 'leave-applications.php']
        ]
    ],
    [
        'title' => 'Counselling Records',
        'color' => 'crimson',
        'icon' => 'fa-notes-medical',
        'content' => [
            'Sessions Held' => '4',
            'Upcoming' => '1'
        ],
        'actions' => [
            ['text' => 'Update Record', 'icon' => 'fa-edit', 'link' => 'counselling.php']
        ]
    ],
    [
        'title' => 'Student Progress',
        'color' => 'slateblue',
        'icon' => 'fa-chart-line',
        'content' => [
            'Progress Summary' => 'Available'
        ],
        'actions' => [
            ['text' => 'View Report', 'icon' => 'fa-chart-pie', 'link' => 'student-progress.php']
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
            ['text' => 'Check Feedback', 'icon' => 'fa-comment-alt', 'link' => 'course-feedback.php']
        ]
    ],
    [
        'title' => 'Notices & Updates',
        'color' => 'goldenrod',
        'icon' => 'fa-bullhorn',
        'content' => [
            'Unread Notices' => '2'
        ],
        'actions' => [
            ['text' => 'View Notices', 'icon' => 'fa-eye', 'link' => 'notices.php']
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