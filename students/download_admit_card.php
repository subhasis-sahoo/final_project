<?php

include_once "../header.php";
include_once "./sidebar.php";

require_once "functions.php";

$sic = $_SESSION['sic'];
// $sic = "25MMCI19";
// echo $sic;
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); // Accessing clicked php file by substring function


$is_approve = cheack_admitcard_eligibility($sic)->fetch_assoc()['is_approve']; ?>
<!-- // print_r($is_approve);

// if (strcmp($is_approve, "completed") === 0) {
// echo "preview";
// } else {
// echo "can not"; -->
<div class="container-fluid mt-3 mx-0 px-4 main-container">
  <!-- Page Header -->
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
    <h3 class="mb-3">Admit Card</h3>
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
          <a class="nav-link border-0 rounded-top-2 nav-items exam-form <?php $page == 'download_admit_card.php' ? print "bg-primary text-white" : print "bg-light text-secondary" ?>" id="examForm" href="download_admit_card.php">
            <i class="fas fa-pen-to-square"></i> Download Admit Card
          </a>
        </li>
      </ul>
    </div>

    <!-- Card Body -->
    <div class="card-body p-4 border rounded-bottom-2 shadow-sm">
      <!-- Semester Search Bar -->
      <form id="searchBarForm" class="form-group mb-3" action="admit_card.php" method="post">
        <label for="semesterSearch" class="fw-semibold mb-1"><i class="fas fa-search"></i>Student Sic</label>
        <div class="input-group d-flex gap-2">
          <input type="text" class="form-control rounded-3 border border-secondary outline-none" id="semesterSearch" name="sic" placeholder="" value="<?php echo $sic ?>" readonly>
          <div class="input-group-append">
            <input type="submit" value="Download" class="btn btn-outline-secondary px-4" id="searchButton">
          </div>
        </div>
      </form>

      <!-- Loading indicator (initially hidden) -->
      <div id="loadingIndicator" class="text-center my-4 d-none">
        <!-- <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div> -->
        <div class="loader"></div>
        <p class="mt-2">Loading admit card...</p>
      </div>

      <!-- Message for students for their dues -->
      <div id="warningBox" class="alert alert-success border-0 bg-white d-none">
        <i class="fas fa-exclamation-triangle" id="icon"></i>
        <span class="" id="warningMsg" style="font-size: .85rem;"></span><br>
        <a href="student_admit_card.php?sic=<?php echo $sic ?>" style="text-decoration:none;color:aliceblue;" class="d-none btn  btn-success btn-outline-secondary px-4 mt-2" id="downloadButton">download</a>

      </div>

      <!-- No subjects found message (initially hidden) -->


    </div>
  </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<!-- Script for the exam registration form page -->
<script src="./scripts/admit_card_form.js?v=<?php echo time(); ?>"></script>