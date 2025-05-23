<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

require_once "functions.php";

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function

$allExamRegistrationDetails = getAllExamRegistrationDetails();
// print_r($allExamRegistrationDetails);
?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Complete Registration</h3>
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
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'complete_registration.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="complete_registration.php">
                        <i class="fa-solid fa-check-circle"></i> Complete Registration
                    </a>
                </li>
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'schedule_registration.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="schedule_registration.php">
                        <i class="fas fa-calendar-alt"></i> Schedule Deadline
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
            <div class="d-flex flex-column">
                <!-- Exam Registration Table Header -->
                <div class="row d-flex justify-content-between w-100 px-3 m-0 py-2 border-bottom rounded-top-2 table-header">
                    <h6 class="col-md-1 fw-bold my-1">SL No.</h6>
                    <h6 class="col-md-2 fw-bold my-1">Student Name</h6>
                    <h6 class="col-md-2 fw-bold my-1">Student SIC</h6>
                    <h6 class="col-md-2 fw-bold my-1">Apply Date</h6>
                    <h6 class="col-md-3 fw-bold my-1">Registration Card</h6>
                    <h6 class="col-md-2 text-center fw-bold my-1">Registration Status</h6>
                </div>

                <!-- Application history page body -->
                <div class="m-0 p-0 table-body">
                    <!-- Table rows will be inserted by JavaScript -->
                    <?php
                    $index = 0;
                    while ($data = $allExamRegistrationDetails->fetch_assoc()) {
                        $student_name = getStudentName($data['student_sic'])->fetch_assoc()['full_name'];
                        $index += 1;
                    ?>
                        <div id="<?php echo $data['student_sic'] ?>Row" class="row d-flex justify-content-between w-100 px-3 m-0 py-2 border-bottom body-data">
                            <p class="col-md-1 fs-custom my-auto"><?php echo $index?></p>
                            <p class="col-md-2 fs-custom my-auto"><?php echo $student_name ?></p>
                            <p class="col-md-2 fs-custom my-auto"><?php echo $data['student_sic'] ?></p>
                            <p class="col-md-2 fs-custom my-auto"><?php echo $data['apply_date'] ?></p>
                            <a href="registration_card.php?sic=<?php echo $data['student_sic'] ?>" class="col-md-3 d-flex align-items-center gap-1 text-decoration-none h-100 overflow-x-hidden my-auto fs-custom doc-link">
                                <i class="fas fa-file-alt my-auto"></i> show registration card
                            </a>
                            <button id="<?php echo $data['student_sic'] ?>" class="col-md-2 btn btn-success border-0 text-white px-4 fs-custom my-auto sts-btn" >Pending</button>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time() ?>"></script>

<!-- Script to complete exam registration of students -->
<script src="./scripts/complete_registration.js?v=<?php echo time() ?>" ></script>