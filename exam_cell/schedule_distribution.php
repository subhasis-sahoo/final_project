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
        <h3 class="mb-3">Schedule Deadline</h3>
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
            <!-- Application form for schedule Admit Card Distribution -->
            <form class="row" id="scheduleDistributionForm" action="schedule_distribution_data.php" method="POST" enctype="multipart/form-data">
                <div class="col-6 mb-4">
                    <label for="reason" class="form-label mb-1">Admit Card Distribution Year</label>
                    <input type="text" class="form-control fs-custom" id="year" name="year" value=<?php echo date("Y") ?> readonly>
                </div>

                <div class="col-6 mb-4">
                    <label for="to" class="form-label mb-1">Admit Card Distribution Month</label>
                    <select class="form-select fs-custom" id="month" name="month" required>
                        <option value="" selected disabled>Select Month</option>
                        <option value="December">December</option>
                        <option value="Janurary">Janurary</option>
                        <option value="March">March</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                    </select>
                </div>

                <div class="col-6 mb-4">
                    <label for="name" class="form-label mb-1">Start Day</label>
                    <input type="text" class="form-control fs-custom" id="startDay" name="start_day" required>
                </div>

                <div class="col-6 mb-4">
                    <label for="sic" class="form-label mb-1">End Day</label>
                    <input type="text" class="form-control fs-custom" id="endDay" name="end_day" required>
                </div>

                <div class="d-flex gap-3 d-md-flex justify-content-start">
                    <input type="submit" value="Schedule" id="" class="btn btn-warning px-4 py-2">
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
            <div id="scheduleDistributionOverlay" class="overlay d-none"></div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<!-- Script to manage schedule_registration.php -->
<script src="./scripts/schedule_distribution.js?v=<?php echo time(); ?>"></script>