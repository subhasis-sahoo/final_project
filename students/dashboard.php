<?php
// Including header.php
include_once "../header.php";
include_once "./sidebar.php";

require_once "functions.php";

$sic = $_SESSION['sic'];

// Function to get studnet's faculty advisor name using their sic
$facultlyName = getFAName($sic)->fetch_assoc()['faculty_name'];
// print_r($facultlyName);


// Function to get studnet's dues using their sic
$studentDues = getStudentDue($sic)->fetch_assoc()['amount'];

// Function to get exam registration last date
$examRegistrationLastDate = trim(getExamRegistrationLastDate()->fetch_assoc()['COLUMN_DEFAULT'], "'");
$examRegistrationLastDate = date('j F, Y', strtotime($examRegistrationLastDate)); 

$applicationCount = 0;
$allApplications = getAllApplications($sic);
!$allApplications ? $applicationCount = 0 : $applicationCount = $allApplications->num_rows;

$studentAttendance = getStudentsDetails($sic)->fetch_assoc()['is_attendance_low'];

$studentAttendance == 'yes' ? $attendanceStatus = 'Below 80%' : $attendanceStatus = 'Above 80%';


// Actual functional cards tailered with data that comes from database
$realCards = [
    [
        'title' => 'Faculty Advisor', 
        'color' => 'coral', 
        'icon' => 'fa-user-tie',
        'content' => [
            'Name' => $facultlyName,
            'Contact Number' => '9861184312'
        ],
        'actions' => [
            ['text' => 'Interactions', 'icon' => 'fa-comments', 'link' => '#'],
            ['text' => 'Raise an Issue', 'icon' => 'fa-exclamation-circle', 'link' => '#'],
            ['text' => 'SOP', 'icon' => 'fa-file-alt', 'link' => '#']
        ]
    ],
    [
        'title' => 'Attendance', 
        'color' => 'purple', 
        'icon' => 'fa-clipboard-check',
        'content' => [
            'Attendance Status' => $attendanceStatus
        ],
        'actions' => [
            ['text' => 'More Info', 'icon' => 'fa-info-circle', 'link' => '#']
        ]
    ],
    [
        'title' => 'Dues', 
        'color' => 'seagreen', 
        'icon' => 'fa-money-bill-wave',
        'content' => [
            'Total Dues' => $studentDues
        ],
        'actions' => [
            ['text' => 'Pay Online', 'icon' => 'fa-money-bill-wave', 'link' => 'my_dues.php'],
            ['text' => 'Account Details', 'icon' => 'fa-credit-card', 'link' => 'account_details.php'],
            ['text' => 'Print Receipt', 'icon' => 'fa-print', 'link' => 'transactions_details.php']
        ]
    ],
    [
        'title' => 'Exam Registration', 
        'color' => 'green', 
        'icon' => 'fa-pen-to-square',
        'content' => [
            'Status' => 'Open',
            'Deadline' => $examRegistrationLastDate
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
            ['text' => 'Download', 'icon' => 'fa-download', 'link' => 'download_admit_card.php']
        ]
    ],
    [
        'title' => 'Application Box',
        'color' => 'orange',
        'icon' => 'fa-box-archive',
        'content' => [
            'Total Applications' => $applicationCount,
        ],
        'actions' => [
            ['text' => 'New Application', 'icon' => 'fa-plus', 'link' => 'new_application.php'],
            // ['text' => 'Track Status', 'icon' => 'fa-search', 'link' => 'track-application.php'],
            ['text' => 'Application History', 'icon' => 'fa-history', 'link' => 'application_history.php']
        ]
    ]
];

// Sample data for cards - In a real application, this would come from a database
$demoCards = [
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
            'Name' => 'Subhasis Sahoo',
            'Mobile No.' => '8249867525',
            'Email' => 'subhasissahoo949@gmail.com'
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