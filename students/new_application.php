<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function
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
            <form class="row" action="" method="POST" enctype="multipart/form-data">
                <div class="col-6 mb-4">
                    <label for="name" class="form-label mb-1">Student Name</label>
                    <input type="text" class="form-control fs-custom" id="name" name="name" required>
                </div>
                
                <div class="col-6 mb-4">
                    <label for="sic" class="form-label mb-1">Student SIC</label>
                    <input type="text" class="form-control fs-custom" id="sic" name="sic" required>
                </div>
                
                <div class="col-6 mb-4">
                    <label for="to" class="form-label mb-1">Recipient Role</label>
                    <select class="form-select fs-custom" id="to" name="to" required>
                        <option value="" selected disabled>Select recipient</option>
                        <option value="department_head">Department Head</option>
                        <option value="exam_coordinator">Exam Coordinator</option>
                        <option value="registrar">Registrar</option>
                        <option value="dean">Dean</option>
                    </select>
                </div>
                
                <div class="col-6 mb-4">
                    <label for="reason" class="form-label mb-1">Reason for Application</label>
                    <select class="form-select fs-custom" id="reason" name="reason" required>
                        <option value="" selected disabled>Select reason</option>
                        <option value="makeup_exam">Makeup Exam</option>
                        <option value="special_consideration">Special Consideration</option>
                        <option value="rescheduling">Exam Rescheduling</option>
                        <option value="accommodation">Special Accommodation</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="documents" class="form-label mb-1">Supporting Documents</label>
                    <input type="file" class="form-control form-control-lg fs-custom" id="documents" name="documents" accept=".pdf" required>
                    <div class="form-text">Please upload supporting documents in PDF format only.</div>
                </div>
                
                <div class="d-flex gap-3 d-md-flex justify-content-start">
                    <input type="submit" id="" class="btn btn-warning px-4 py-2">
                    <input type="reset" id="" class="btn btn-outline-secondary px-4 py-2">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>