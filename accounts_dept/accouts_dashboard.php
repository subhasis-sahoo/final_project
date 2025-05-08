<?php

//stage handeled by session 
require "../functions.php";

$stage = "accounts section";
$no_of_application = total_applications($stage);


// Including header.php
include_once "index.php";


$dashboardCards = [
    [
        'title' => 'Personal Information',
        'color' => 'mediumseagreen',
        'icon' => 'fa-user',
        'content' => [
            'Status' => 'Verified',
            'Last Updated' => 'March 10, 2025'
        ],
        'actions' => [
            ['text' => 'Edit Details', 'icon' => 'fa-user-edit', 'link' => 'edit_personal_info.php'],
            ['text' => 'View Profile', 'icon' => 'fa-info-circle', 'link' => 'view-profile.php']
        ]
    ],
    [
        'title' => 'Security Settings',
        'color' => 'crimson',
        'icon' => 'fa-shield-alt',
        'content' => [
            'Status' => 'Secure',
            'Last Password Change' => 'February 15, 2025'
        ],
        'actions' => [
            ['text' => 'Change Password', 'icon' => 'fa-key', 'link' => 'change-password.php']
        ]
    ],
    [
        'title' => 'Payment Methods',
        'color' => 'orange',
        'icon' => 'fa-credit-card',
        'content' => [
            'Total Methods' => '2',
            'Primary' => 'Debit Card',
            'Secondary' => 'UPI'
        ],
        'actions' => [
            ['text' => 'Add', 'icon' => 'fa-plus', 'link' => 'add-payment.php'],
            ['text' => 'View ', 'icon' => 'fa-search', 'link' => 'view-payments.php'],
            ['text' => 'History', 'icon' => 'fa-history', 'link' => 'payment-history.php']
        ]
    ],
    [
        'title' => 'Document Repository',
        'color' => 'dodgerblue',
        'icon' => 'fa-folder',
        'content' => [
            'Total Documents' => '7',
            'Program' => 'MCA, Semester - 4',
            'Storage Used' => '15 MB'
        ],
        'actions' => [
            ['text' => 'View Documents', 'icon' => 'fa-info-circle', 'link' => 'document-repository.php']
        ]
    ],
    [
        'title' => 'Notification Preferences',
        'color' => 'royalblue',
        'icon' => 'fa-bell',
        'content' => [
            'Email' => 'Enabled',
            'SMS' => 'Enabled'
        ],
        'actions' => [
            ['text' => 'Email Settings', 'icon' => 'fa-envelope', 'link' => 'email-settings.php'],
            ['text' => 'SMS Settings', 'icon' => 'fa-mobile-alt', 'link' => 'sms-settings.php']
        ]
    ],
    [
        'title' => 'Privacy Settings',
        'color' => 'tomato',
        'icon' => 'fa-user-shield',
        'content' => [],
        'actions' => [
            ['text' => 'Manage Privacy', 'icon' => 'fa-info-circle', 'link' => 'privacy-settings.php']
        ]
    ],
    [
        'title' => 'Digital ID',
        'color' => 'goldenrod',
        'icon' => 'fa-id-card',
        'content' => [
            'ID Status' => 'Active',
            'Expiry Date' => 'May 31, 2026',
            'Last Updated' => 'August 15, 2024'
        ],
        'actions' => [
            ['text' => 'View ID', 'icon' => 'fa-info-circle', 'link' => 'view-digital-id.php']
        ]
    ],
    [
        'title' => 'Two-Factor Authentication',
        'color' => 'darkmagenta',
        'icon' => 'fa-lock',
        'content' => [
            'Status' => 'Not Enabled'
        ],
        'actions' => [
            ['text' => 'Setup 2FA', 'icon' => 'fa-shield-alt', 'link' => 'setup-2fa.php']
        ]
    ],
    [
        'title' => 'Contact Information',
        'color' => 'mediumseagreen',
        'icon' => 'fa-address-book',
        'content' => [
            'Name' => 'SUBHASIS SAHOO',
            'Mobile No.' => '8249867525',
            'Email Id' => 'subhasissahoo949@gmail.com'
        ],
        'actions' => [
            ['text' => 'Update Contacts', 'icon' => 'fa-info-circle', 'link' => 'update-contacts.php']
        ]
    ],
    [
        'title' => 'Login History',
        'color' => 'mediumturquoise',
        'icon' => 'fa-history',
        'content' => [
            'Last Login' => 'April 4, 2025',
            'Total Devices' => '2'
        ],
        'actions' => [
            ['text' => 'View History', 'icon' => 'fa-list', 'link' => 'login-history.php']
        ]
    ],
    [
        'title' => 'Support & Help',
        'color' => 'mediumorchid',
        'icon' => 'fa-question-circle',
        'content' => [
            'Active Tickets' => '0'
        ],
        'actions' => [
            ['text' => 'Contact Support', 'icon' => 'fa-headset', 'link' => 'contact-support.php']
        ]
    ],
    [
        'title' => 'Account Preferences',
        'color' => 'mediumpurple',
        'icon' => 'fa-cog',
        'content' => [],
        'actions' => [
            ['text' => 'Language', 'icon' => 'fa-language', 'link' => 'language-settings.php'],
            ['text' => 'Accessibility', 'icon' => 'fa-universal-access', 'link' => 'accessibility.php']
        ]
    ],
    [
        'title' => 'Email Accounts',
        'color' => 'dodgerblue',
        'icon' => 'fa-envelope',
        'content' => [
            'Primary Email' => 'mca.23mmci50@silicon.ac.in',
            'Recovery Email' => 'subha***@gmail.com'
        ],
        'actions' => [
            ['text' => 'Manage Emails', 'icon' => 'fa-info-circle', 'link' => 'manage-emails.php']
        ]
    ]
];


function renderDashboardCards($card)
{
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
<div class="container-fluid mt-3 mx-0 px-4 dashboard-container ">
    <div class="mb-3 border-bottom">
        <h2 class="mb-3">Dashboard</h2>
    </div>
    <div class="row mx-0 d-felx flex-wrap justify-content-between">
        <div class="col-md-6 col-lg-4 col-xl-4 mb-4 card p-0 dashboard-card">
            <div class="card-header" style="background-color: coral;">
                <h5 class="text-white">Students Dues</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 contents">
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Collected dues :</h6>
                            <span>9861184312</span>
                        </div>
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Pending Dues :</h6>
                            <span>100000000</span>
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
                        <!-- <i class="fas fa-comments my-auto"></i> -->
                        <i class=" fas fa-solid fa-money-check my-auto"></i>
                        <p class="m-0 p-0">Cheack</p>
                    </a>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 mb-4 card p-0 dashboard-card">
            <div class="card-header" style="background-color: #2E5090;">
                <h5 class="text-white">College Accounting Office</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 contents">
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Budget: $4.2M</h6>
                        </div>
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Staff Members: 8</h6>
                        </div>
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Fiscal Year: 2025</h6>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="card-icon-container" style="background-color: #2E5090;">
                            <i class="fas fa-calculator fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-around">
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-file-invoice-dollar my-auto"></i>
                        <p class="m-0 p-0">Financial Reports</p>
                    </a>
                    <a href="#" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-chart-pie my-auto"></i>
                        <p class="m-0 p-0">Budget Analysis</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 mb-4 card p-0 dashboard-card">
            <div class="card-header" style="background-color: seagreen;">
                <h5 class="text-white">Applications</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 contents">
                        <div class="d-flex align-item-center gap-2 content">
                            <h6>Total :</h6>
                            <span><?php echo $no_of_application; ?></span>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="card-icon-container" style="background-color: seagreen;">
                            <!-- <i class="fas fa-money-bill-wave fa-2x text-white"></i> -->
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-around">
                    <a href="get_applications.php" class="d-flex align-item-center gap-1 card-action-link">
                        <i class="fas fa-credit-card my-auto"></i>
                        <p class="m-0 p-0">view</p>
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


<!-- <script src="../scripts/dashbaord.js?v=<?php echo time(); ?>"></script> -->

<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>