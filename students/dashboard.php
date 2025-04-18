<?php
// Including header.php
include_once "../header.php";


// Sample data for cards - In a real application, this would come from a database
$dashboardCards = [
    [
        'title' => 'Exam Registration', 
        'color' => 'green', 
        'icon' => 'fa-pen-to-square',
        'content' => [
            'Status' => 'Open',
            'Deadline' => 'March 25, 2025'
        ],
        'actions' => [
            ['text' => 'Register Now', 'icon' => 'fa-check-circle', 'link' => 'exam_registration_form.php'],
            ['text' => 'Terms & Conditions', 'icon' => 'fa-info-circle', 'link' => 'exam_registration_terms.php']
        ]
    ],
    [
        'title' => 'Admit Card Download',
        'color' => 'skyblue',
        'icon' => 'fa-id-card',
        'content' => [
            'Status' => 'Available',
            'Exam Date' => 'April 10, 2025'
        ],
        'actions' => [
            ['text' => 'Download', 'icon' => 'fa-download', 'link' => 'download-admit-card.php']
        ]
    ],
    [
        'title' => 'Application Box',
        'color' => 'orange',
        'icon' => 'fa-box-archive',
        'content' => [
            'Total Applications' => '3',
            'Pending' => '1',
            'Approved' => '2'
        ],
        'actions' => [
            ['text' => 'New Application', 'icon' => 'fa-plus', 'link' => 'new_application.php'],
            ['text' => 'Track Status', 'icon' => 'fa-search', 'link' => 'track-application.php'],
            ['text' => 'History', 'icon' => 'fa-history', 'link' => 'application_history.php']
        ]
    ],
    [
        'title' => 'Academics',
        'color' => 'dodgerblue',
        'icon' => 'fa-graduation-cap',
        'content' => [
            'Regd no.' => '-',
            'Program' => 'MCA, Semester - 4',
            'Branch' => 'MCA, Section - A'
        ],
        'actions' => [
            ['text' => 'More Info', 'icon' => 'fa-info-circle', 'link' => 'academics-info.php']
        ]
    ],
    [
        'title' => 'Exam Schedule',
        'color' => 'royalblue',
        'icon' => 'fa-calendar-check',
        'content' => [
            'Today' => '0',
            'Tomorrow' => '0'
        ],
        'actions' => [
            ['text' => 'Autonomous Exam', 'icon' => 'fa-file-alt', 'link' => 'autonomous-exam.php'],
            ['text' => 'Class Test Exam', 'icon' => 'fa-file-alt', 'link' => 'class-test.php']
        ]
    ],
    [
        'title' => 'Result',
        'color' => 'tomato',
        'icon' => 'fa-chart-bar',
        'content' => [],
        'actions' => [
            ['text' => 'More Info', 'icon' => 'fa-info-circle', 'link' => 'result.php']
        ]
    ],
    [
        'title' => 'Library',
        'color' => 'goldenrod',
        'icon' => 'fa-book',
        'content' => [
            'Books with me' => '0',
            'To be returned today' => '0',
            'To be returned this week' => '0'
        ],
        'actions' => [
            ['text' => 'More Info', 'icon' => 'fa-info-circle', 'link' => 'library-info.php']
        ]
    ],
    [
        'title' => 'Hostel',
        'color' => 'darkmagenta',
        'icon' => 'fa-building',
        'content' => [
            'Status' => 'Not Registered'
        ],
        'actions' => [
            ['text' => 'Apply Leave', 'icon' => 'fa-sign-out-alt', 'link' => 'hostel-leave.php']
        ]
    ],
    [
        'title' => 'Profile',
        'color' => 'mediumseagreen',
        'icon' => 'fa-id-card',
        'content' => [
            'Name' => 'SUBHASIS SAHOO',
            'Mobile No.' => '8249867525',
            'Email Id' => 'subhasissahoo949@gmail.com'
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
    [
        'title' => 'Course Feedback',
        'color' => 'mediumorchid',
        'icon' => 'fa-comment-dots',
        'content' => [
            'START-END' => '-'
        ],
        'actions' => [
            ['text' => 'Course Feedback', 'icon' => 'fa-comments', 'link' => 'course-feedback.php']
        ]
    ],
    [
        'title' => 'Feedback',
        'color' => 'mediumpurple',
        'icon' => 'fa-comments',
        'content' => [],
        'actions' => [
            ['text' => 'Feedback', 'icon' => 'fa-comment', 'link' => 'feedback.php'],
            ['text' => 'FAQs/Guides', 'icon' => 'fa-question-circle', 'link' => 'faqs.php']
        ]
    ],
    [
        'title' => 'Official Mail',
        'color' => 'dodgerblue',
        'icon' => 'fa-envelope',
        'content' => [
            'Email Id' => 'mca.23mmci50@silicon.ac.in',
            'Password' => 'fxzl6325'
        ],
        'actions' => [
            ['text' => 'More Info', 'icon' => 'fa-info-circle', 'link' => 'official-mail.php']
        ]
    ]
];


function renderDashboardCards($card) {
    $iconBgColor = isset($card['color']) ? $card['color'] : 'primary';
    $iconClass = isset($card['icon']) ? $card['icon'] : 'fa-info-circle';
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
        <h2 class="mb-3">Dashboard</h2>
    </div>
    <div class="row mx-0 d-felx flex-wrap justify-content-between">
        <div class="col-md-6 col-lg-4 col-xl-4 mb-4 card p-0 dashboard-card">
            <div class="card-header" style="background-color: coral;">
                <h5 class="text-white">Faculty Advisor</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 contents">
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Name:</h6>
                            <span>DR Mukti Routray</span>
                        </div>
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Contact Number:</h6>
                            <span>9861184312</span>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="card-icon-container" style="background-color: coral;">
                            <i class="fas fa-user-tie fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-around">
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-comments my-auto"></i>
                        <p class="m-0 p-0">Interactions</p>
                    </a>
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-exclamation-circle my-auto"></i>
                        <p class="m-0 p-0">Raise an Issue</p>
                    </a>
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-file-alt my-auto"></i>
                        <p class="m-0 p-0">SOP</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 mb-4 card p-0 dashboard-card">
            <div class="card-header" style="background-color: purple;">
                <h5 class="text-white">Attendance</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 contents">
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Subjects:</h6>
                            <span>0</span>
                        </div>
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>0 to 79%:</h6>
                            <span>-</span>
                        </div>
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>80% to 100%:</h6>
                            <span>9</span>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="card-icon-container" style="background-color: purple;">
                            <i class="fas fa-clipboard-check fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-around">
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-info-circle my-auto"></i>
                        <p class="m-0 p-0">More Info</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 mb-4 card p-0 dashboard-card">
            <div class="card-header" style="background-color: seagreen;">
                <h5 class="text-white">Dues</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 contents">
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Total Dues:</h6>
                            <span>3450</span>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="card-icon-container" style="background-color: seagreen;">
                            <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-around">
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-credit-card my-auto"></i>
                        <p class="m-0 p-0">Pay Online</p>
                    </a>
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-print my-auto"></i>
                        <p class="m-0 p-0">Print Receipt</p>
                    </a>
                </div>
            </div>
        </div>

        <?php
        // Render each card in the grid
        foreach ($dashboardCards as $card) {
            renderDashboardCards($card);
        }
        ?>
    </div>
</div>


<script src="./scripts/dashboard.js?v=<?php echo time(); ?>"></script>