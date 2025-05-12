<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

$sic = $_SESSION['sic'];

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function

require_once "functions.php";

$allApplications = getAllApplications($sic);
// !$allApplications ? print_r(!$allApplications) : print_r($allApplications);
?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Application History</h3>
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
            <!-- Applications history -->
            <div class="d-flex flex-column">
                <!-- Checking the student have any applications or not -->
                <?php
                if (!$allApplications) {
                ?>
                    <div class="d-flex flex-column justify-content-center align-items-center mx-auto my-3">
                        <i class="fa-solid fa-file mb-2 fs-1"></i>
                        <p class="fw-semibold text-capitalize text-dark mb-0">No Applications Found</p>
                        <p class="text-dark mb-0">There are currently no applications to you submited.</p>
                    </div>
                <?php
                } else {
                ?>
                    <!-- Application history page header -->
                    <div class="row d-flex justify-content-between w-100 px-3 m-0 py-2 border-bottom rounded-top-2 table-header">
                        <h6 class="col-md-2 fw-bold my-1">Application ID</h6>
                        <h6 class="col-md-2 fw-bold my-1">Apply Date</h6>
                        <h6 class="col-md-4 fw-bold my-1">Reason For Application</h6>
                        <h6 class="col-md-3 fw-bold my-1">Document</h6>
                        <h6 class="col-md-1 text-center fw-bold my-1">Status</h6>
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
                            <div id="<?php echo $data['application_id'] ?>Row" class="row d-flex justify-content-between w-100 px-3 m-0 py-2 border-bottom body-data">
                                <p class="col-md-2 fs-custom my-auto"><?php echo $data['application_id'] ?></p>
                                <p class="col-md-2 fs-custom my-auto"><?php echo $data['apply_date'] ?></p>
                                <p class="col-md-4 fs-custom my-auto"><?php echo $data['application_reason'] ?></p>
                                <a href="<?php echo $data['supporting_documents'] ?>" target="_blank" class="col-md-3 d-flex align-items-center gap-1 text-decoration-none h-100 my-auto fs-custom ps-2 pe-3 doc-link">
                                    <i class="fas fa-file-alt my-auto"></i> 
                                    <div class=""><?php echo $formattedFileName ?></div>
                                </a>
                                <button id="<?php echo $data['application_id'] ?>" class="col-md-1 btn border-0 text-white px-4 fs-custom my-auto sts-btn">View</button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- Application status pop-up -->
                    <div class="position-absolute start-50 translate-middle d-none status-card">
                        <div class="d-flex align-items-end gap-1 bg-white p-0 pb-2 card-header">
                            <h5 class="mb-0">Application Status</h5>
                            <span id="appId" class="mb-0 fw-medium app-id">[23MCASS01]</span>
                            <div class="close-icon">×</div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th class="me-1">Stage</th>
                                    <th class="me-1">Status</th>
                                    <th class="me-1">Date</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody id="statusCardBody">

                            </tbody>
                        </table>
                    </div>

                    <!-- Background overlay -->
                    <div id="overlay" class="overlay d-none"></div>
                <?php
                }

                ?>
            </div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<script src="./scripts/application_history.js?v=<?php echo time(); ?>"></script>