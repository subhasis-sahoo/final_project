<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";


$sic = $_SESSION['sic'];

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function

require_once "functions.php";

$studentName = getStudentsDetails($sic)->fetch_assoc()['full_name'];
// print_r($studentName);
?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">New Application</h3>
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
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'new_application.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="new_application.php">
                        <i class="fas fa-plus"></i> New Application
                    </a>
                </li>
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-term <?php $page == 'application_history.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examTerm" href="application_history.php">
                        <i class="fas fa-history"></i> Application History
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
            <!-- Application form for students -->
            <form id="newApplicationForm" class="row" action="new_application_data.php" method="POST" enctype="multipart/form-data">
                <div class="col-6 mb-4">
                    <label for="name" class="form-label mb-1">Student Name</label>
                    <input type="text" class="form-control fs-custom" id="name" name="name" value="<?php echo $studentName?>" readonly>
                </div>
                
                <div class="col-6 mb-4">
                    <label for="sic" class="form-label mb-1">Student SIC</label>
                    <input type="text" class="form-control fs-custom" id="sic" name="sic" value="<?php echo $sic?>" readonly>
                </div>
                
                <div class="col-6 mb-4">
                    <label for="to" class="form-label mb-1">Apply Date</label>
                    <input type="text" class="form-control fs-custom" id="apply_date" name="apply_date" value="<?php echo date('d M, Y')?>" readonly>
                </div>
                
                <div class="col-6 mb-4">
                    <label for="reason" class="form-label mb-1">Reason for Application</label>
                    <select class="form-select fs-custom" id="reasonForApplication" name="reason" autocomplete="off">
                        <option value="" selected disabled>Select reason</option>
                        <option value="Request for Exam Registration (Unpaid Dues Issue)">Request for Exam Registration (Unpaid Dues Issue)</option>
                        <option value="Request For Admit card (Low Attendance Issue)">Request For Admit card (Low Attendance Issue)</option>
                        <option value="Request For Admit card (Unpaid Dues Issue)">Request For Admit card (Unpaid Dues Issue)</option>
                        <option value="Request For Admit card (Both Reason 2 and 3)">Request For Admit card (Both Reason 2 and 3)</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="documents" class="form-label mb-1">Supporting Documents</label>
                    <input type="file" class="form-control form-control-lg fs-custom" id="documents" name="documents" accept=".pdf" autocomplete="off">
                    <div class="form-text">Please upload supporting documents in PDF format only.</div>
                </div>
                
                <div class="d-flex gap-3 d-md-flex justify-content-start">
                    <input type="submit" id="" class="btn btn-warning px-4 py-2">
                    <input type="reset" id="" class="btn btn-outline-secondary px-4 py-2">
                </div>
            </form>
            <!-- Loading indicator (initially hidden) -->
            <div id="loadingIndicator" class="position-absolute text-center start-50 top-50 my-4 d-none">
                <div class="loader"></div>
                <p class="mt-2">Loading...</p>
            </div>

            <!-- Warning message (initially hidden) -->
            <div id="warningMsg" class="alert alert-warning m-0 mt-3 d-none" role="alert">
                <i class="fas fa-exclamation-triangle"></i> No subjects found for the specified semester.
            </div>

            <!-- Background overlay -->
            <div id="newApplicationOverlay" class="overlay d-none"></div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time() ?>"></script>

<!-- Script to manage new_application form -->
<script src="./scripts/new_application.js?v=<?php echo time() ?>" ></script>