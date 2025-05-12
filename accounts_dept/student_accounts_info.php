<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

require_once "functions.php";


// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function

// $student_sic = '';
// if(isset($_GET['student_sic'])) {
//     $student_sic = $_GET['student_sic'];
// }

?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Student Account Details</h3>
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
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'student_accounts_info.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="student_accounts_info.php">
                        <i class="fas fa-credit-card my-auto"></i> Account Details
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
            <!-- Students Accounts Details Search Bar -->
            <form id="searchBarForm" class="form-group mb-3" action="" method="post">
                <label for="sicSearched" class="fw-semibold mb-1"><i class="fas fa-search"></i> Enter Student SIC</label>
                <div class="input-group d-flex gap-2">
                    <input type="text" class="form-control rounded-3 border border-secondary outline-none fs-custom text-uppercase" id="sicSearched" name="sic" value="<?php isset($_GET['student_sic']) ? print $_GET['student_sic'] : "" ?>" autocomplete="off">
                    <div class="input-group-append">
                        <input type="submit" value="Search" class="btn btn-outline-secondary px-4" id="searchButton">
                    </div>
                </div>
            </form>

            <!-- Loading indicator (initially hidden) -->
            <div id="loadingIndicator" class="text-center my-4 d-none">
                <div class="loader"></div>
                <p class="mt-2">Loading Accounts Details...</p>
            </div>

            <!-- Warning message (initially hidden) -->
            <div id="warningMsg" class="alert alert-warning mb-0 d-none" role="alert">
                <i class="fas fa-exclamation-triangle"></i> No subjects found for the specified semester.
            </div>

            <div class="d-flex flex-column pt-4 d-none" id="accountsDetailsTable">
                <!-- Dues Details page header -->
                <div class="row d-flex justify-content-between w-100 m-0 p-0 table-header">
                    <div class="col-md-1 fw-bold p-2 pb-3 border border-secondary border-end-0 m-0">Sl No.</div>
                    <div class="col-md-7 fw-bold p-2 pb-3 border border-secondary border-end-0 m-0">Amount Head</div>
                    <div class="col-md-2 fw-bold p-2 pb-3 border border-secondary border-end-0 m-0">Opening Balance</div>
                    <div class="col-md-2 fw-bold p-2 pb-3 border border-secondary m-0">Closeing Balance</div>
                </div>

                <!-- Dues Details page body -->
                <div class="m-0 p-0 table-body" id="accountsDetailsTableBody">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>


<script src="./scripts/student_accounts_info.js?v=<?php echo time(); ?>"></script>