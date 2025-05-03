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
        <h3 class="mb-3">Terms & Conditions</h3>
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
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'exam_registration_form.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="exam_registration_form.php">
                        <i class="fas fa-pen-to-square"></i> Exam Registration Form
                    </a>
                </li>
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-term <?php $page == 'exam_registration_terms.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examTerm" href="exam_registration_terms.php">
                        <i class="fas fa-info-circle"></i> Terms & conditions
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body px-4 border rounded-bottom-2 shadow-sm">
            <!-- Terms and Conditions for exam registration -->
            <ul>
                <li>Registration is mandatory for all students appearing in the examination.</li>
                <li>Payment must be completed before the registration deadline (March 25, 2025).</li>
                <li>Late registration will incur additional fees of Rs. 500.</li>
                <li>Once registered, you can download your admit card after payment verification.</li>
                <li>For any queries, please contact the examination department.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>