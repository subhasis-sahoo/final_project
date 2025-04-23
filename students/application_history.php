<?php
// Include header file which contains the main structure
include_once '../header.php';

// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function

$applications = [];
for ($i = 1; $i <= 15; $i++) {
    $applications[] = [
        'id' => 'APP' . str_pad($i, 3, '0', STR_PAD_LEFT),
        'datetime' => '2025-04-18 10:' . str_pad($i, 2, '0', STR_PAD_LEFT) . ' AM',
        'reason' => 'Application reason #' . $i,
        'document' => 'uploads/doc_' . $i . '.pdf',
        'status' => [
            ['Stage' => 'Submitted', 'Status' => 'Completed'],
            ['Stage' => 'Dean Review', 'Status' => $i % 2 ? 'Approved' : 'Rejected'],
            ['Stage' => 'Exam Cell', 'Status' => 'Pending'],
        ]
    ];
}
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
        <div class="card-body px-4 border rounded-bottom-2 shadow-sm">
            <!-- Applications history -->
            <div class="d-flex flex-column mt-1">
                <!-- Application history page header -->
                <div class="row d-flex justify-content-between w-100 px-3 m-0 py-2 border-bottom rounded-top-2 table-header">
                    <h6 class="col-md-2 fw-bold my-1">Application ID</h6>
                    <h6 class="col-md-2 fw-bold my-1">Apply Date</h6>
                    <h6 class="col-md-3 fw-bold my-1">Reason For Application</h6>
                    <h6 class="col-md-3 fw-bold my-1">Document</h6>
                    <h6 class="col-md-1 text-center fw-bold my-1">Status</h6>
                </div>

                <!-- Application history page body -->
                <div class="m-0 p-0 table-body">
                    <!-- Table rows will be inserted by JavaScript -->
                    <div id="23MCASS01-row" class="row d-flex justify-content-between w-100 px-3 m-0 py-2 border-bottom body-data">

                        <p class="col-md-2 fs-custom my-auto">23MCASS01</p>
                        <p class="col-md-2 fs-custom my-auto">18 August, 2025</p>
                        <p class="col-md-3 fs-custom my-auto">Request to allow for exam registration</p>
                        <a href="#" target="_blank" class="col-md-3 d-flex align-items-center gap-1 text-decoration-none h-100 overflow-x-hidden my-auto fs-custom doc-link">
                            <i class="fas fa-file-alt my-auto"></i> 23mmci50_application.pdf
                        </a>
                        <button id="23MCASS01" class="col-md-1 btn border-0 text-white px-4 fs-custom my-auto sts-btn">View</button>
                    </div>

                    <div id="23MCASS02-row" class="row d-flex justify-content-between w-100 px-3 m-0 py-2 border-bottom body-data">

                        <p class="col-md-2 fs-custom my-auto">23MCASS02</p>
                        <p class="col-md-2 fs-custom my-auto">18 August, 2025</p>
                        <p class="col-md-3 fs-custom my-auto">Request to allow for exam registration</p>
                        <a href="#" target="_blank" class="col-md-3 d-flex align-items-center gap-1 text-decoration-none h-100 overflow-x-hidden my-auto fs-custom doc-link">
                            <i class="fas fa-file-alt my-auto"></i> 23mmci50_application.pdf
                        </a>
                        <button id="23MCASS02" class="col-md-1 btn border-0 text-white px-4 fs-custom my-auto sts-btn">View</button>
                    </div>
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
                                <th>Stage</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Faculty Advisor</td>
                                <td class="text-success">Completed</td>
                                <td>20-08-2025</td>
                                <td>Forwarded to DEAN</td>
                            </tr>
                            <tr>
                                <td>Acconts Section</td>
                                <td class="text-warning">Pending</td>
                                <td>20-08-2025</td>
                                <td class="text-secondary">-</td>
                            </tr>
                            <tr>
                                <td>DEAN</td>
                                <td class="text-success">Completed</td>
                                <td>20-08-2025</td>
                                <td class="">Don't do this next time</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Background overlay -->
                <div id="overlay" class="overlay d-none"></div>
            </div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="./scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<script src="./scripts/application_history.js?v=<?php echo time(); ?>"></script>