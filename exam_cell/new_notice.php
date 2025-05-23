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
        <h3 class="mb-3">Pubish Notice</h3>
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
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'new_notice.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="new_notice.php">
                        <i class="fa-solid fa-upload"></i> Pubish Notice
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
            <!-- Application form for schedule Admit Card Distribution -->
            <form class="row" id="searchBarForm" action="send_message.php" method="POST" enctype="multipart/form-data">
                <div class="col-6 mb-4">
                    <label for="apply_date" class="form-label mb-1">Apply Date</label>
                    <input type="text" class="form-control fs-custom" id="apply_date" name="apply_date" value="<?php echo date('d M, Y') ?>" readonly>
                </div>

                <div class="col-6 mb-4">
                    <label for="selectReceiver" class="form-label mb-1">Select Receiver</label>
                    <select class="form-select fs-custom" id="selectReceiver" name="receiver" required>
                        <option value="" selected disabled>Select Receiver</option>
                        <option value="Students">Students</option>
                        <option value="Accounts Section">Accounts Section</option>
                        <option value="Dean Of Academics">Dean Of Academics</option>
                        <option value="Faculty">Faculty</option>
                        <!-- <option value="June">June</option> -->
                    </select>
                    <!-- <p class="d-none text-danger" id="invalidReceiver"></p> -->
                </div>

                <div class="d-flex flex-column mb-1">
                    <label for="message" class="form-label mb-1 mt-2 fw-medium">Add Message</label>
                    <textarea name="message" id="message" class="form-control w-100 rounded-2" rows="5" placeholder="Write a message for the student ..." style="font-size: .85rem;" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="documents" class="form-label mb-1">Supporting Documents</label>
                    <input type="file" class="form-control form-control-lg fs-custom" id="documents" name="documents" accept=".pdf" autocomplete="off">
                    <div class="form-text">Please upload supporting documents in PDF format only.</div>
                </div>

                <div class="d-flex gap-3 d-md-flex justify-content-start">
                    <input type="submit" value="publish" id="" class="btn btn-warning px-4 py-2">
                    <input type="reset" id="" class="btn btn-outline-secondary px-4 py-2">
                </div>
            </form>
            <!-- Loading indicator (initially hidden) -->
            <div id="loadingIndicator" class="position-absolute text-center start-50 top-50 my-4 d-none">
                <div class="loader"></div>
                <p class="mt-2">Loading...</p>
            </div>

            <!-- Warning message (initially hidden) -->
            <div id="warningMsg" class="alert alert-success m-0 mt-3 d-none" role="alert">
                <i class="fas fa-exclamation-triangle"></i> message send successfully
            </div>

            <!-- Background overlay -->
            <div id="scheduleDistributionOverlay" class="overlay d-none"></div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<!-- Script to manage schedule_registration.php -->
<script src="./scripts/message_form.js?v=<?php echo time(); ?>"></script>