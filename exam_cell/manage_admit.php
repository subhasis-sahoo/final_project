<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function

require_once "functions.php";

$allAdmitCardData = getAllAdmitCardData();
// print_r($allAdmitCardData->fetch_assoc());
?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Manage Distribution</h3>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="dashboard.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Page Body -->
    <div class="card border-0 mb-3">
        <!-- Navigation style card header -->
        <div class="card-header overflow-hidden border-0 bg-white p-0">
            <ul class="d-flex gap-0 nav nav-tabs border-0">
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'manage_admit.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="manage_admit.php">
                        <i class="fa-solid fa-check-circle"></i> Manage Distribution
                    </a>
                </li>
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'schedule_distribution.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="schedule_distribution.php">
                        <i class="fas fa-calendar-alt"></i> Schedule Deadline
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
            <!-- Applications history -->
            <div class="d-flex flex-column">
                <!-- Checking the student have any applications or not -->
                <?php
                if (!$allAdmitCardData) {
                ?>
                    <div class="d-flex flex-column justify-content-center align-items-center mx-auto my-3">
                        <i class="fa-solid fa-file mb-2 fs-1"></i>
                        <p class="fw-semibold text-capitalize text-dark mb-0">No Admit Card Data Found</p>
                        <p class="text-dark mb-0">There are currently no pending admit cards for distribution.</p>
                    </div>
                <?php
                } else {
                ?>
                    <!-- Application history page header -->
                    <div class="d-flex gap-3 w-100 px-3 m-0 py-2 border-bottom rounded-top-2 table-header">
                        <h6 class="fw-bold my-1" style="width: 5%;">SL No.</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 15%;">Student Name</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 13%;">Student SIC</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 17%;">Accounts Approval</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 19%;">Attendance Approval</h6>
                        <h6 class="fw-bold my-1" style="width: 17%;">Student Admit Card</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 15%;">Eligibility Status</h6>
                    </div>

                    <!-- Application history page body -->
                    <div class="m-0 p-0 table-body">
                        <!-- Table rows will be inserted by JavaScript -->
                        <?php
                        $index = 0;
                        while ($data = $allAdmitCardData->fetch_assoc()) {
                            $index += 1;
                            $registraionID = $data['registration_id'];
                            $studentsDetails = getStudentNameAndSIC($registraionID)->fetch_assoc();
                            // print_r($studentsDetails);
                            $studentName = $studentsDetails['student_name'];
                            $studentSIC = $studentsDetails['student_sic'];
                        ?>
                            <div id="<?php echo $data['admit_card_id'] ?>Row" class="d-flex gap-3 w-100 px-3 m-0 py-2 border-bottom body-data">
                                <p class="fs-custom my-auto" style="width: 5%;"><?php echo $index ?></p>
                                <p class="text-center fs-custom my-auto" style="width: 15%;"><?php echo $studentName ?></p>
                                <p class="text-center fs-custom my-auto" style="width: 13%;"><?php echo $studentSIC ?></p>
                                <p class="text-center fs-custom my-auto" style="width: 17%;"><?php echo $data['accounts_section_approval'] ?></p>
                                <p class="text-center fs-custom my-auto" style="width: 19%;"><?php echo $data['dean_approval'] ?></p>
                                <a href="student_admit_card.php?student_sic=<?php echo $studentSIC ?>" target="_blank" class="d-flex align-items-center gap-1 text-decoration-none h-100 my-auto fs-custom ps-2 pe-3 doc-link" style="width: 17%;">
                                    <i class="fas fa-file-alt my-auto"></i>
                                    <div class="">View Admit Card</div>
                                </a>
                                <button id="<?php echo $data['admit_card_id'] ?>" class="btn btn-success border-0 text-white px-4 fs-custom text-center my-auto sts-btn <?php $data['accounts_section_approval'] == 'completed' && $data['dean_approval'] == 'completed' ? print "" : print "disabled" ?>" style="width: 15%;">
                                    <?php $data['accounts_section_approval'] == 'completed' && $data['dean_approval'] == 'completed' ? print "Eligible" : print "Not Eligible" ?>
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<script src="./scripts/manage_admit_cards.js?v=<?php echo time(); ?>"></script>