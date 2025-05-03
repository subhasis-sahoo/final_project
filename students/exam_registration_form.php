<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

$sic = $_SESSION['sic'];
require_once "functions.php";

$is_registered = isStudnetRegistered($sic);

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); // Accessing clicked php file by substring function
?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Exam Registration</h3>
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
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-term <?php $page == 'exam_registration_terms.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>"  id="examTerm" href="exam_registration_terms.php">
                        <i class="fas fa-info-circle"></i> Terms & conditions
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
            <!-- Semester Search Bar -->
            <form id="searchBarForm" class="form-group mb-3" action="subject_data.php" method="post">
                <label for="semesterSearch" class="fw-semibold mb-1"><i class="fas fa-search"></i> Search Your Semester</label>
                <div class="input-group d-flex gap-2">
                    <input type="text" class="form-control rounded-3 border border-secondary outline-none" id="semesterSearch" name="semester" placeholder="Enter semester (e.g. 4)" autocomplete="off">
                    <div class="input-group-append">
                        <input type="submit" value="Search" class="btn btn-outline-secondary px-4 <?php $is_registered == 1 ? print "disabled" : print "" ?>" id="searchButton">
                    </div>
                </div>
            </form>

            <!-- Loading indicator (initially hidden) -->
            <div id="loadingIndicator" class="text-center my-4 d-none">
                <!-- <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div> -->
                <div class="loader"></div>
                <p class="mt-2">Loading subjects...</p>
            </div>

            <!-- Message for students for their dues -->
            <div id="warningBox" class="text-danger d-none">
                <i class="fas fa-exclamation-triangle"></i>
                <span class="fw-bold" id="warningMsg" style="font-size: .85rem;">Note: Because of out standing dues you need to request HOD of Account section to allow your exam registration with an application!!!</span>
            </div>

            <!-- No subjects found message (initially hidden) -->
            <div id="noSubjectsFound" class="alert alert-warning d-none" role="alert">
                <i class="fas fa-exclamation-triangle"></i> No subjects found for the specified semester.
            </div>

            <!-- Button to view registration form if student is already registered -->
            <div id="viewNowBtn" class="<?php $is_registered == 1 ? print "" : print "d-none" ?> ">
                <a href="./registration_card.php" class="btn btn-success" >View Now</a>
            </div>

            <!-- Table with all subjects list of the repextive semesters -->
            <form id="registrationForm" class="d-none my-1" action="" method="post">
                <!-- Subject selection table for exam registration -->
                <div class="table-responsive form-group">
                    <table class="table table-hover table-bordered border-secondary rounded-3 mb-2">
                        <thead class="thead-light bg-warning text-dark">
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Subjects</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Registration Last Date</th>
                                <th class="text-center">Registration Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">     
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="declaration" required>
                        <label class="custom-control-label fw-medium" for="declaration" style="font-size: .9rem;">
                            I hereby declare that all the information provided is correct and I agree to the <a href="exam_registration_terms.php" class="text-decoration-none fw-medium">terms and conditions</a>
                        </label>
                    </div>
                </div>

                <div class="form-group mt-3 d-flex gap-2">
                    <input type="submit" value="Register" id="registerButton" class="btn btn-success px-3" disabled></input>
                    <a href="index.php" class="btn btn-secondary px-3">Cancel</a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<!-- Script for the exam registration form page -->
<script src="./scripts/exam_registration_form.js?v=<?php echo time(); ?>"></script>