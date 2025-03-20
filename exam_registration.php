<?php
// Include header file which contains the main structure
include_once 'index.php';

?>

<!-- Main Content -->
<div class="col-md-9 col-lg-10 ml-sm-auto px-4 exam-registration-container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Exam Registration</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="dashboard.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Page Body -->
    <div class="card mb-3">
        <!-- Card Header -->
        <div class="card-header bg-primary text-white">
            <i class="fas fa-pen-to-square"></i> Exam Registration Form
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <!-- Semester Search Bar -->
            <div class="form-group mb-3">
                <label for="semesterSearch" class="fw-semibold mb-1"><i class="fas fa-search"></i> Search Your Semester</label>
                <div class="input-group d-flex gap-2">
                    <input type="text" class="form-control rounded-3 border border-secondary outline-none" id="semesterSearch" placeholder="Enter semester (e.g. 4)">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary px-4" type="button" id="searchButton">Search</button>
                    </div>
                </div>
            </div>

            <!-- Loading indicator (initially hidden) -->
            <div id="loadingIndicator" class="text-center my-4 d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Loading subjects...</p>
            </div>

            <!-- No subjects found message (initially hidden) -->
            <div id="noSubjectsFound" class="alert alert-warning d-none" role="alert">
                <i class="fas fa-exclamation-triangle"></i> No subjects found for the specified semester.
            </div>

            <form id="registrationForm" class="d-none mb-3" action="test.php" method="post">
                <!-- Subject selection table for exam registration -->
                <div class="table-responsive form-group">
                    <table class="table table-hover table-bordered border-secondary rounded-3">
                        <thead class="thead-light bg-warning text-dark">
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Subjects</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Registration Date</th>
                                <th class="text-center">Registration Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="declaration" required>
                        <label class="custom-control-label" for="declaration">
                            I hereby declare that all the information provided is correct and I agree to the <a href="#" class="text-decoration-none fw-medium">terms and conditions</a>
                        </label>
                    </div>
                </div>

                <div class="form-group mt-3 d-flex gap-2">
                    <input type="submit" value="Register" id="registerButton" class="btn btn-success px-3" disabled></input>
                    <a href="dashboard.php" class="btn btn-secondary px-3">Cancel</a>
                </div>
            </form>

            <!-- Message for students for their dues -->
            <div id="message" class="fs-6 mb-0 text-danger text-center fw-medium">*** Because of out standing dues you need to request HOD of Account section to allow your exam registration with an application!!! ***</div>
        </div>
    </div>
</div>

<script src="./scripts/exam_registration.js?v=<?php echo time(); ?>"></script>