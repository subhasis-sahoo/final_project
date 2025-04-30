<?php
// Include header file which contains the main structure
include_once '../header.php';
include_once "./sidebar.php";

$sic = $_SESSION['sic'];
require_once "functions.php";

$accountsDetails = json_decode(getStudentAccountsDetails($sic)->fetch_assoc()['account_details']);
$totalPayableAmount = $accountsDetails->total_payable_amount;
$payableAmountDetails = $accountsDetails->payable_amount_details;
$reciviableAmountDetails = $accountsDetails->reciviable_mount_details;


// $_SERVER['SCRIPT_NAME'] gives the whole url
// strrpos($_SERVER['SCRIPT_NAME'], "/") Finding first occourane of '/' from the reverse of the url.
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function
?>

<!-- Main Content -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Account Details</h3>
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
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'my_dues.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="my_dues.php">
                        <i class="fa-solid fa-money-bill-wave"></i> My Dues
                    </a>
                </li>
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'account_details.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="account_details.php">
                        <i class="fas fa-credit-card my-auto"></i> Account Details
                    </a>
                </li>
                <li class="nav-item bg-light border border-light-1 border-bottom-0 rounded-top-2">
                    <a class="nav-link border-0 rounded-top-2 nav-items exam-term <?php $page == 'transactions_details.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examTerm" href="transactions_details.php">
                        <i class="fas fa-print my-auto"></i> All Transactions
                    </a>
                </li>
            </ul>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
            <!-- Unpaid dues table inserted using javascript -->
            <div class="d-flex flex-column">
                <!-- Dues Details page header -->
                <div class="row d-flex justify-content-between w-100 m-0 p-0 table-header">
                    <div class="col-md-1 fw-bold p-2 pb-3 border border-secondary border-end-0 m-0">Sl No.</div>
                    <div class="col-md-7 fw-bold p-2 pb-3 border border-secondary border-end-0 m-0">Amount Head</div>
                    <div class="col-md-2 fw-bold p-2 pb-3 border border-secondary border-end-0 m-0">Opening Balacing</div>
                    <div class="col-md-2 fw-bold p-2 pb-3 border border-secondary m-0">Closeing Balacing</div>
                </div>

                <!-- Dues Details page body -->
                <div class="m-0 p-0 table-body">
                    <?php
                    $slNo = 0;
                    foreach ($payableAmountDetails as $key => $value) {
                        $slNo += 1;
                    ?>
                        <div class="row d-flex justify-content-between w-100 m-0 p-0">
                            <div class="col-md-1 p-2 border border-secondary border-end-0 border-top-0 m-0">
                                <?php echo $slNo ?>
                            </div>
                            <div class="col-md-7 p-2 border border-secondary border-end-0 border-top-0 m-0 text-capitalize">
                                <?php echo $key . "(Dr)" ?>
                            </div>
                            <div class="col-md-2 p-2 border border-secondary border-end-0 border-top-0 m-0 text-end">
                                <?php echo number_format($value, 2, '.', '') ?>
                            </div>
                            <div class="col-md-2 p-2 border border-secondary border-top-0 m-0 text-end">
                                <?php echo number_format($value, 2, '.', '') ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    $slNo1 = $slNo;
                    foreach ($reciviableAmountDetails as $key => $value) {
                        $slNo1 += 1;
                    ?>
                        <div class="row d-flex justify-content-between w-100 m-0 p-0">
                            <div class="col-md-1 p-2 border border-secondary border-end-0 border-top-0 m-0">
                                <?php echo $slNo1 ?>
                            </div>
                            <div class="col-md-7 p-2 border border-secondary border-end-0 border-top-0 m-0 text-capitalize">
                                <?php echo $key . "(Cr)" ?>
                            </div>
                            <div class="col-md-2 p-2 border border-secondary border-end-0 border-top-0 m-0 text-end">
                                <?php echo number_format($value, 2, '.', '') ?>
                            </div>
                            <div class="col-md-2 p-2 border border-secondary border-top-0 m-0 text-end">
                                <?php echo number_format($value, 2, '.', '') ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="./scripts/dashboard.js?v=<?php echo time(); ?>"></script>