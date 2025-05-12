<?php
include_once "../header.php";
include_once "./sidebar.php";


require_once "functions.php";

if (!isset($_GET['student_sic'])) {
?>
    <script>
        alert("Invalid student SIC");
        window.location = "manage_admit.php";
    </script>
<?php
}

$sic = $_GET['student_sic'];
// Get student's details
$studentDetailes = getStudentsDetails($sic)->fetch_assoc();


// Studnet semester details array to display in UI
$semester = [1 => "1st", 2 => "2nd", 3 => "3rd", 4 => "4th"];

?>

<div class="container-fluid mt-3 mx-0 px-4 main-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h3 class="mb-3">Admit Card</h3>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="manage_admit.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Previous Page
            </a>
        </div>
    </div>

    <!-- page body -->
    <div class="card rounded-0 registration-card" id="registrationForm">
        <!-- Header Section -->
        <div class="card-header rounded-0 position-relative text-white  py-2 university-header">
            <!-- University Logo -->
            <div class="position-absolute start-0 ms-3">
                <a class="navbar-brand" href="https://silicon.ac.in" target="_blank">
                    <img src="../public/assets/silicon_logo.png" alt="Silicon University Logo" class="card-university-logo" height="30px">
                </a>
            </div>

            <!-- University Name -->
            <div class="mb-0 mx-auto">
                <h6 class="mb-2 text-center">Silicon Institute of Technology, Bhubaneswar <br> a unit of Silicon University</h6>
                <p class="m-0 p-0 text-center" style="font-size: .85rem; letter-spacing: .07cm;">Semester examination registration form (Regular)</p>
            </div>
        </div>

        <!-- Body Section -->
        <div class="card-body d-flex flex-column p-4">
            <!-- Student Details with photograph -->
            <div class="row justify-content-between align-items-center mx-1 mb-1 py-2">
                <!-- Student details -->
                <div class="col-9 px-0">
                    <div class="student-details" style="font-size: 0.8rem;">
                        <h6 class="fw-semibold">Name of the Student: </h6>
                        <span id="studentName" class="fw-medium text-secondary text-capitalize"><?php echo $studentDetailes['full_name'] ?></span>
                    </div>
                    <div class="student-details" style="font-size: 0.8rem;">
                        <h6 class="fw-semibold">Student's SIC: </h6>
                        <span id="studentSic" class="fw-medium text-secondary text-uppercase"><?php echo $studentDetailes['sic'] ?></span>
                    </div>
                    <!-- <div class="student-details">
                        <h6>Phone Number: </h6>
                        <span id="mobile">8249867525</span>
                    </div> -->
                    <div class="student-details" style="font-size: 0.8rem;">
                        <h6 class="fw-semibold">Silicon Email Id: </h6>
                        <span id="branch" class="fw-medium text-secondary text-lowercase"><?php echo $studentDetailes['email'] ?></span>
                    </div>
                    <div class="student-details">
                        <h6 class="fw-semibold">Semeter: </h6>
                        <span id="branch" class="fw-medium text-secondary text-lowercase"><?php echo $semester[$studentDetailes['semester']] ?></span>
                    </div>
                    <div class="student-details" style="font-size: 0.8rem;">
                        <h6 class="fw-semibold">Program: </h6>
                        <span id="program" class="fw-medium text-secondary text-uppercase"><?php echo $studentDetailes['program'] ?></span>
                    </div>
                    <div class="student-details" style="font-size: 0.8rem;">
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

            <!-- Subject selection table for exam registration -->
            <div class="table-responsive form-group mx-1 my-2">
                <table class="table table-hover table-bordered border-secondary rounded-3">
                    <thead class="thead-light bg-warning text-dark">
                        <tr>
                            <th class=" p-1" style="font-size: .8rem;">Sl</th>
                            <th class=" p-1" style="font-size: .8rem;">Subject Code</th>
                            <th class=" p-1" style="font-size: .8rem;">Subject Name</th>
                            <th class=" p-1" style="font-size: .8rem;">Date</th>
                            <th class=" p-1" style="font-size: .8rem;">Timings</th>
                            <th class=" p-1" style="font-size: .8rem;">Hall (Row x Col)</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td class="fw-medium p-2" style="font-size: .75rem;">1</td>
                            <td class="fw-medium p-2" style="font-size: .75rem;">MCCS-T-PC-021</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">DESIGN & ANALYSIS OF ALGORITHMS</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">03-Jan-2025</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">02:00 - 05:00</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">3811(X3)</td>
                        </tr>
                        <tr>
                            <td class="fw-medium p-2" style="font-size: .75rem;">2</td>
                            <td class="fw-medium p-2" style="font-size: .75rem;">MCCS-T-PC-012</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">CLOUD COMPUTING</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">06-Jan-2025</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">02:00 - 05:00</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">3821(1X3)</td>
                        </tr>
                        <tr>
                            <td class="fw-medium p-2" style="font-size: .75rem;">3</td>
                            <td class="fw-medium p-2" style="font-size: .75rem;">MCCS-T-PE-017</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">ARTIFICIAL INTELLIGENCE</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">09-Jan-2025</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">02:00 - 05:00</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">3521(1X5)</td>
                        </tr>
                        <tr>
                            <td class="fw-medium p-2" style="font-size: .75rem;">4</td>
                            <td class="fw-medium p-2" style="font-size: .75rem;">MCCS-T-MC-008</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">UNIVERSAL HUMAN VALUES & PROFESSIONAL ETHICS</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">11-Jan-2025</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">02:00 - 05:00</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">0521(1X2)</td>
                        </tr>
                        <tr>
                            <td class="fw-medium p-2" style="font-size: .75rem;">5</td>
                            <td class="fw-medium p-2" style="font-size: .75rem;">MCCS-T-PC-028</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">SOFTWARE PROJECT MANAGEMENT</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">14-Jan-2025</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">02:00 - 05:00</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">0521(1X2)</td>
                        </tr>
                        <tr>
                            <td class="fw-medium p-2" style="font-size: .75rem;">6</td>
                            <td class="fw-medium p-2" style="font-size: .75rem;">MCCS-T-PC-027</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">Web Application Development</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">16-Jan-2025</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">02:00 - 05:00</td>
                            <td class="fw-medium p-2 " style="font-size: .75rem;">0531(1X5)</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Admit card footer Section -->
            <div class="footer-item d-flex justify-content-between mb-2 fw-medium mt-auto" style="font-size: 0.8rem;">
                <div class="position-relative d-flex justify-content-center gap-3 pt-2" id="requestedBy">
                    <div>Signature of the Student</div>
                    <span class="position-absolute text-secondary" style="margin-top: -20px;"><?php echo $studentDetailes['full_name'] ?></span>
                </div>
                <div class="position-relative d-flex justify-content-center pt-2" id="requestedBy">
                    <div>Controller of Examinations</div>
                    <span class="position-absolute text-secondary" style="margin-top: -20px;">

                    </span>
                </div>
            </div>

            <!-- Admit cards instructions -->
            <div class="mt-3">
                <!-- Terms and Conditions for exam registration -->
                <h6>Instructions for the Students Appearing Examinations</h6>
                <ol style="font-size: .75rem;">
                    <li>For smooth and fair conduction of examinations, the examination halls shall be under electronic surveillance system.</li>
                    <li>Candidates must bring Identity Card and Admit card during each day of examination. Candidates without admit card issued for the subject are not allowed to appear in the examinations. In case of loss of admit card, a duplicate admit card can be issued by the CoE after collecting an administrative fee.</li>
                    <li>
                        For the Mid-Term examination, students must enter 15 minutes before the commencement but are not allowed to enter after the start of the examination unless there is some genuine reason, with proper permission from CoE. <br>
                        Candidates must enter into the hall 15 minutes before the commencement of End-Term examination, but not allowed after 10 minutes of commencement.
                    </li>
                    <li>Possession of mobile phones and any other electronic gadgets in the examination hall is strictly prohibited, failing which it shall lead to malpractice (MP) cases.</li>
                    <li>Candidates must seat at the designated seat allotted through ERP. Changing the allocated seat is not permitted. In case the candidate is sick with any communicable disease, he/she shall be seated in a sick room.</li>
                    <li>
                        The Bar-coded answer booklets always contain information such as name, SIC/Regd. No, name of the Candidate, Subject Name, Subject Code, Semester and Date of Examination, etc. The candidates must verify their particulars on the cover page of the Answer Books before signing in the appropriate box.
                    </li>
                    <li>No discussion or query related to questions is allowed inside the examination hall. Students must carry their own calculator, scale & pencil, etc. during examination. Borrowing from other students is not allowed. Any other requirements such as log tables, graph paper, etc., shall be provided by the examination section only.</li>
                    <li>
                        Candidates must leave the completed and signed answer books in closed condition or handover the same to an invigilator before leaving the examination hall. If a student has left the hall with the answer script, it shall be treated as MP case.
                    </li>
                    <li>Any violation of the norms/regulations or adopting unfair means inside the examination halls/premises shall lead to strict disciplinary action.</li>
                    <li>The Examination Schedule may be revised due to any unavoidable circumstances.</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Download Button -->
    <div class=" mt-5 d-print-none text-center">
        <button class="btn btn-primary mb-4" id="downloadBtn">Download Now</button>
    </div>
</div>

<!-- Script to manage sidebar toggle -->
<script src="../utilities/scripts/dashboard.js?v=<?php echo time(); ?>"></script>

<!-- Script for registration card page -->
<script src="./scripts/registration_card.js?v=<?php echo time(); ?>"></script>