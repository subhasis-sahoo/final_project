<?php
include_once "../header.php";
include_once "./sidebar.php";


require_once "functions.php";

if(!isset($_GET['sic'])) {
    ?>
    <script>
        alert("Invalid student SIC");
        window.location = "complete_registration.php";
    </script>
    <?php
}

$sic = $_GET['sic'];
// Get student's details
$studentDetailes = getStudentsDetails($sic)->fetch_assoc();

// Studnet semester details array to display in UI
$semester = [1 => "1st", 2 => "2nd", 3 => "3rd", 4 => "4th"];

// Get student's registred subject list
$registeredData = json_decode(getExamRegistrationDetails($sic)->fetch_assoc()['registration_data']);
// echo $registeredData->subject_list[0]->subject_name;

// Getting apply date
$apply_date = getExamRegistrationDetails($sic)->fetch_assoc()['apply_date'];
// print_r($apply_date);
$timestamp = strtotime($apply_date); // Convert string to timestamp
$formatted_apply_date = date('d/m/Y', $timestamp);

$accountsSectionApproval = getExamRegistrationDetails($sic)->fetch_assoc()['accounts_section_approval'];
?>

<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Registration Card</h3>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="complete_registration.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Previous Page
            </a>
        </div>
    </div>

    <!-- page body -->
    <div class="card rounded-0 registration-card" id="registrationForm">
        <!-- Header Section -->
        <div class="card-header rounded-0 position-relative text-white text-center py-2 university-header">
            <!-- University Logo -->
            <div class="position-absolute start-0 ms-3">
                <a class="navbar-brand" href="https://silicon.ac.in" target="_blank">
                    <img src="../public/assets/silicon_logo.png" alt="Silicon University Logo" class="card-university-logo" height="30px">
                </a>
            </div>

            <!-- University Name -->
            <div class="mb-0 mx-auto">
                <h6 class="mb-2">Silicon Institute of Technology, Bhubaneswar <br> a unit of Silicon University</h6>
                <p class="m-0 p-0" style="font-size: .85rem; letter-spacing: .07cm;">Semester examination registration form (Regular)</p>
            </div>
        </div>

        <!-- Body Section -->
        <div class="card-body d-flex flex-column p-4">
            <!-- Student Details with photograph -->
            <div class="row justify-content-between align-items-center mx-1 mb-3 py-2">
                <!-- Student details -->
                <div class="col-9 px-0">
                    <div class="student-details" style="font-size: 0.9rem;">
                        <h6 class="fw-semibold">Name of the Student: </h6>
                        <span id="studentName" class="fw-medium text-secondary text-capitalize"><?php echo $studentDetailes['full_name'] ?></span>
                    </div>
                    <div class="student-details" style="font-size: 0.9rem;">
                        <h6 class="fw-semibold">Student's SIC: </h6>
                        <span id="studentSic" class="fw-medium text-secondary text-uppercase"><?php echo $studentDetailes['sic'] ?></span>
                    </div>
                    <!-- <div class="student-details">
                        <h6>Phone Number: </h6>
                        <span id="mobile">8249867525</span>
                    </div> -->
                    <div class="student-details" style="font-size: 0.9rem;">
                        <h6 class="fw-semibold">Silicon Email Id: </h6>
                        <span id="branch" class="fw-medium text-secondary text-lowercase"><?php echo $studentDetailes['email'] ?></span>
                    </div>
                    <div class="student-details">
                        <h6 class="fw-semibold">Semeter: </h6>
                        <span id="branch" class="fw-medium text-secondary text-lowercase"><?php echo $semester[$studentDetailes['semester']] ?></span>
                    </div>
                    <div class="student-details" style="font-size: 0.9rem;">
                        <h6 class="fw-semibold">Program: </h6>
                        <span id="program" class="fw-medium text-secondary text-uppercase"><?php echo $studentDetailes['program'] ?></span>
                    </div>
                    <div class="student-details" style="font-size: 0.9rem;">
                        <h6 class="fw-semibold">Branch: </h6>
                        <span id="branch" class="fw-medium text-secondary text-capitalize">Master's of Computer Apllication</span>
                    </div>
                </div>

                <!-- Student photograph -->
                <div class="col-3 px-0 d-flex justify-content-end">
                    <!-- Needs to replace static image of student to image store in DB -->
                    <img src="../<?php echo $studentDetailes['profile_photo_path'] ?>" alt="student_image" width="130">
                </div>
            </div>

            <!-- Message for students for their dues -->
            <div id="warningBox" class="text-danger mx-1">
                <i class="fas fa-exclamation-triangle"></i> <span class="fw-bold" id="warning-msg" style="font-size: .85rem;"><?php $registeredData->student_due == 0 ? print "Note: Your dues are cleared so you can do your exam registration" : print "Note: Your registration process is not completed as of pending dues. Contact HOD (Administration)!!!" ?></span>
            </div>

            <!-- Subject selection table for exam registration -->
            <div class="table-responsive form-group mx-1 my-2">
                <table class="table table-hover table-bordered border-secondary rounded-3">
                    <thead class="thead-light bg-warning text-dark">
                        <tr>
                            <th class="text-center p-1" style="font-size: .9rem;">SL</th>
                            <th class="text-center p-1" style="font-size: .9rem;">Subjects</th>
                            <th class="text-center p-1" style="font-size: .9rem;">Amount</th>
                            <th class="text-center p-1" style="font-size: .9rem;">Registration Last Date</th>
                            <th class="text-center p-1" style="font-size: .9rem;">Registration Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        foreach ($registeredData->subject_list as $sl => $subject) {
                        ?>
                            <tr>
                                <td class="fw-medium p-2" style="font-size: .83rem;"><?php echo $sl+1 ?></td>
                                <td class="fw-medium p-2" style="font-size: .83rem;"><?php echo $subject->subject_name . "(" . $subject->subject_code . ")" ?></td>
                                <td class="fw-medium p-2 text-center" style="font-size: .83rem;"><?php echo $subject->amount ?></td>
                                <td class="fw-medium p-2 text-center" style="font-size: .83rem;"><?php echo $subject->registration_last_date ?></td>
                                <td class="fw-medium p-2 text-center" style="font-size: .83rem;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" <?php $subject->is_checked == 1 ? print "checked" : print "" ?> class="custom-control-input subject-checkbox w-100 h-100" disabled>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="footer-item d-flex justify-content-between mb-2 fw-medium mt-auto" style="font-size: 0.9rem;">
                <div class="position-relative d-flex justify-content-center pt-2" id="date">
                    <div>Date: ..................................</div>
                    <span class="position-absolute text-secondary" style="margin-top: -5px;"><?php echo $formatted_apply_date ?></span>
                </div>
                <div class="position-relative d-flex justify-content-center gap-3 pt-2" id="requestedBy">
                    <div>Name of the Student</div>
                    <span class="position-absolute text-secondary" style="margin-top: -20px;"><?php echo $studentDetailes['full_name'] ?></span>
                </div>
                <div class="position-relative d-flex justify-content-center pt-2" id="requestedBy">
                    <div>HOD (Adminstration)</div>
                    <span class="position-absolute text-secondary <?php $accountsSectionApproval == 'pending' ? print "d-none" : print "" ?>" style="margin-top: -20px;">
                        <img src="../public/assets/digital-sign.svg" alt="digital-sign" width="40">
                    </span>
                </div>
            </div>

        </div>
    </div>

    <!-- Download Button -->
    <div class="text-center mt-5 d-print-none">
        <button class="btn btn-primary mb-4" id="downloadBtn">Download Now</button>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<!-- Script for registration card page -->
<script src="./scripts/registration_card.js?v=<?php echo time(); ?>"></script>