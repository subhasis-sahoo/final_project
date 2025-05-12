<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

$sic = $_SESSION['sic'];
$role = $_SESSION['role'];

// print_r($role);

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function

require_once "functions.php";

$allApplications = getAllApplicationsAccordingToRole($role);
// !$allApplications ? print_r(!$allApplications) : print_r($allApplications);
?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Review Applications</h3>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="dashboard.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Page Body -->
    <div class="card border-0 mb-3 position-relative">
        <!-- Navigation style card header -->
        <div class="card-header overflow-hidden border-0 bg-white p-0">
            <ul class="d-flex gap-0 nav nav-tabs border-0">
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'review_applications.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="review_applications.php">
                        <i class="fas fa-magnifying-glass"></i> Review Applications
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
                if (!$allApplications) {
                ?>
                    <div class="d-flex flex-column justify-content-center align-items-center mx-auto my-3">
                        <i class="fa-solid fa-file mb-2 fs-1"></i>
                        <p class="fw-semibold text-capitalize text-dark mb-0">No Applications Found</p>
                        <p class="text-dark mb-0">There are currently no pending applications for you.</p>
                    </div>
                <?php
                } else {
                ?>
                    <!-- Application history page header -->
                    <div class="d-flex gap-3 w-100 px-3 m-0 py-2 border-bottom rounded-top-2 table-header">
                        <h6 class="text-center fw-bold my-1" style="width: 12%;">Application ID</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 12%;">Student Name</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 10%;">Student SIC</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 10%;">Apply Date</h6>
                        <h6 class="fw-bold my-1" style="width: 22%;">Supporting Documents</h6>
                        <h6 class="text-center fw-bold my-1 mx-2" style="width: 11%;">Dues Details</h6>
                        <h6 class="text-center fw-bold my-1" style="width: 20%;">Actions</h6>
                    </div>

                    <!-- Application history page body -->
                    <div class="m-0 p-0 table-body">
                        <!-- Table rows will be inserted by JavaScript -->
                        <?php
                        while ($data = $allApplications->fetch_assoc()) {
                            $fileName = $data['supporting_documents'];
                            $lastHyphenPos = strrpos($fileName, '--');
                            $formattedFileName = substr($fileName, $lastHyphenPos + 2);
                        ?>
                            <div id="<?php echo $data['application_id'] ?>Row" class="d-flex gap-3 w-100 px-3 m-0 py-2 border-bottom body-data">
                                <p class="text-center fs-custom my-auto" style="width: 12%;"><?php echo $data['application_id'] ?></p>
                                <p class="text-center fs-custom my-auto" style="width: 12%;"><?php echo $data['student_name'] ?></p>
                                <p class="text-center fs-custom my-auto" style="width: 10%;"><?php echo $data['student_sic'] ?></p>
                                <p class="text-center fs-custom my-auto" style="width: 10%;"><?php echo $data['apply_date'] ?></p>
                                <a href="<?php echo $data['supporting_documents'] ?>" target="_blank" class="d-flex align-items-center gap-1 text-decoration-none h-100 my-auto fs-custom ps-2 pe-3 doc-link" style="width: 22%;">
                                    <i class="fas fa-file-alt my-auto"></i> 
                                    <div class=""><?php echo $formattedFileName ?></div>
                                </a>
                                <a href="#" class="btn btn-warning text-decoration-none mx-2 my-auto fs-custom" style="width: 11%;">View</a>
                                <div class="d-flex gap-2 justify-content-around px-1" style="width: 20%;">
                                    <button id="<?php echo $data['application_id'] ?>" class="btn btn-success border-0 text-white px-4 fs-custom my-auto approve-btn">Approve</button>
                                    <button id="<?php echo $data['application_id'] ?>" class="btn btn-danger border-0 text-white px-4 fs-custom my-auto reject-btn">Reject</button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }

                ?>
                <!-- Application status pop-up -->
                    <div class="position-absolute start-50 translate-middle d-none status-card">
                        <div class="d-flex align-items-end gap-1 bg-white p-0 pb-2 card-header">
                            <h5 class="mb-0">Confirm Action</h5>
                            <span id="appId" class="mb-0 fw-medium app-id">[23MCASS01]</span>
                            <div class="close-icon">×</div>
                        </div>
                        <form id="commentCardForm" action="" method="post">
                            <div class="d-flex flex-column mb-1">
                                <label for="comment" class="form-label mb-1 mt-2 fw-medium">Add Comment</label>
                                <textarea name="comment" id="comment" class="form-control w-100 rounded-2" placeholder="Write a message for the student ..." style="font-size: .85rem;"></textarea>
                            </div>

                            <div class="form-text mb-3 fw-medium">Add a comment for the student before you taking any action.</div>

                            <div class="text-end">
                                <input type="submit" value="Confirm" id="cardBtn" class="btn btn-primary px-0 border-0" style="width: 6rem;">
                            </div>
                        </form>
                    </div>

                    <!-- Background overlay -->
                    <div id="overlay" class="overlay d-none"></div>
            </div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<script src="./scripts/review_applications.js?v=<?php echo time(); ?>"></script>