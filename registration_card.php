<?php
// Section to add php script
include_once "index.php";

// Sample registered subjects
$registeredSubjects = [
    [
        'SL' => 1,
        'Subjects' => 'Data Structures',
        'Amount' => '0',
        'Registration Date' => "19-06-2025"
    ],
    [
        'SL' => 2,
        'Subjects' => 'Database Management',
        'Amount' => '0',
        'Registration Date' => "19-06-2025"
    ],
    [
        'SL' => 3,
        'Subjects' => 'Computer Networks',
        'Amount' => '0',
        'Registration Date' => "19-06-2025"
    ],
    [
        'SL' => 4,
        'Subjects' => 'Database Management',
        'Amount' => '0',
        'Registration Date' => "19-06-2025"
    ],
    [
        'SL' => 5,
        'Subjects' => 'Computer Networks',
        'Amount' => '0',
        'Registration Date' => "19-06-2025"
    ],
]
?>

<div class="container-fluid mt-3 mx-0 px-4 registration-card-container">
    <div class="card registration-card">
        <!-- Header Section -->
        <div class="card-header position-relative text-white text-center py-2 university-header">
            <!-- University Logo -->
            <div class="position-absolute start-0 ms-3">
                <a class="navbar-brand" href="https://silicon.ac.in" target="_blank">
                    <img src="./assets/silicon_logo.png" alt="Silicon University Logo" class="card-university-logo" height="30px">
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
            <div class="row justify-content-around align-items-center m-0 mb-3 py-2">
                <!-- Student details -->
                <div class="col-8 px-0">
                    <div class="student-details">
                        <h6>Name of the Student: </h6>
                        <span id="name">Subhasis Sahoo</span>
                    </div>
                    <div class="student-details">
                        <h6>SIC Number: </h6>
                        <span id="sic">23MMCI50</span>
                    </div>
                    <div class="student-details">
                        <h6>Phone Number: </h6>
                        <span id="mobile">8249867525</span>
                    </div>
                    <div class="student-details">
                        <h6>Silicon Email Id: </h6>
                        <span id="branch">mca.23mmci50@silicon.ac.in</span>
                    </div>
                    <div class="student-details">
                        <h6>Semeter: </h6>
                        <span id="branch">3rd</span>
                    </div>
                    <div class="student-details">
                        <h6>Program: </h6>
                        <span id="program">MCA</span>
                    </div>
                    <div class="student-details">
                        <h6>Branch: </h6>
                        <span id="branch">Master's of Computer Apllication</span>
                    </div>
                </div>

                <!-- Student photograph -->
                <div class="col-4 px-0 text-center">
                    <div class="photo-container mx-auto">
                        <div class="photo-placeholder">
                            <p class="mb-0">Student Photo</p>
                            <small>(3.5 × 4.5 cm)</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message for students for their dues -->
            <div id="warningBox" class="text-danger">
                <i class="fas fa-exclamation-triangle"></i> <span class="fw-bold" id="warning-msg" style="font-size: .85rem;">Note: Your registration process is not completed as of pending dues. Contact HOD (Administration)!!!</span>
            </div>

            <!-- Subject selection table for exam registration -->
            <div class="table-responsive form-group mx-0 my-2">
                <table class="table table-hover table-bordered border-secondary rounded-3">
                    <thead class="thead-light bg-warning text-dark">
                        <tr>
                            <th class="text-center p-1">SL</th>
                            <th class="text-center p-1">Subjects</th>
                            <th class="text-center p-1">Amount</th>
                            <th class="text-center p-1">Registration Date</th>
                            <th class="text-center p-1">Registration Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        foreach ($registeredSubjects as $subject) {
                        ?>
                            <tr>
                                <td class="fw-medium p-1"><?php echo $subject['SL'] ?></td>
                                <td class="fw-medium p-1"><?php echo $subject['Subjects'] ?></td>
                                <td class="fw-medium p-1 text-center"><?php echo $subject['Amount'] ?></td>
                                <td class="p-1 text-center"><?php echo $subject['Registration Date'] ?></td>
                                <td class="fw-medium p-2 text-center" style="font-size: .8rem;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" checked class="custom-control-input subject-checkbox w-100 h-100">
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Terms and Conditions for exam registration -->
            <!-- <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-info-circle"></i> Important Information
                </div>
                <div class="card-body">
                    <ul>
                        <li>Registration is mandatory for all students appearing in the examination.</li>
                        <li>Payment must be completed before the registration deadline (March 25, 2025).</li>
                        <li>Late registration will incur additional fees of Rs. 500.</li>
                        <li>Once registered, you can download your admit card after payment verification.</li>
                        <li>For any queries, please contact the examination department.</li>
                    </ul>
                </div>
            </div> -->

            <!-- Footer Section -->
            <div class="d-flex flex-column mt-auto">
                <div class="footer-item d-flex justify-content-between mb-5">
                    <div>Date: ................................................</div>
                    <div>Signature of the Student</div>
                </div>
                <div class="footer-item d-flex justify-content-between mt-5">
                    <div>Signature of the HOD (Adminstration)</div>
                    <div>Signature of the Faculty Advisor</div>
                </div>
            </div>

        </div>
    </div>

    <!-- Download Button -->
    <div class="text-center mt-4 mb-5 d-print-none">
        <button class="btn btn-primary download-btn" onclick="window.print()">
            <i class="bi bi-download me-2"></i>Download / Print Registration Card
        </button>
    </div>
</div>