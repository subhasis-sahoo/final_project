<?php

require_once "../functions.php";

//stage assigned according to the login using session
$stage = "accounts section";
// $stage = "examination cell";
// $stage = "dean";
// $stage = "faculty advisor";
$updated_by = "";
$back_to = "";


if (strcmp($stage, "accounts section") === 0) {
  $updated_by = "update_status_by_account.php";
  $back_to = "accounts_dashboard.php";
} else if (strcmp($stage, "dean") === 0) {
  $updated_by = "update_status_by_dean.php";
  $back_to = "dean_dashboard.php";
} else if (strcmp($stage, "faculty advisor") === 0) {
  $updated_by = "update_status_by_fa.php";
  $back_to = "fa_dashboard.php";
}




// Fetch applications 
$applications = get_application_of_students($stage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applications</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 1200px;
      margin: 30px auto;
    }

    .card {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    .card-header {
      background-color: #2E7D32;
      color: white;
      padding: 15px 20px;
    }

    .table th {
      background-color: #f8f9fa;
    }

    .badge-pending {
      background-color: #FFC107;
    }

    .badge-approved {
      background-color: #28A745;
    }

    .badge-rejected {
      background-color: #DC3545;
    }

    .document-link {
      color: #0D6EFD;
      text-decoration: underline;
    }

    .no-applications {
      padding: 50px 0;
      text-align: center;
      color: #6c757d;
    }

    #allow:hover {
      background-color: red;
      color: green;
    }

    #reject:hover {
      background-color: green;
      color: red;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Student Applications</h3>
        <div>
          <!-- <button class="btn btn-sm btn-light" onclick="window.print()"> -->
          <!-- <i class="bi bi-printer"></i> Print -->
          </button>
          <button class="btn btn-sm btn-light ms-2" onclick="back()">
            <i class="bi bi-file-earmark-excel"></i> Back
          </button>
        </div>
      </div>
      <div class="card-body">
        <?php if ($applications && $applications->num_rows > 0): ?>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>SIC</th>
                  <th>Student Name</th>
                  <th>Request Type</th>
                  <th>Date</th>
                  <th>Document</th>
                  <th>Actions</th>
                  <?php
                  if (strcmp($stage, "accounts section") === 0) { ?>
                    <th>Check Due</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 1;
                while ($row = $applications->fetch_assoc()) {
                  $document = $row['supporting_documents'];
                  // echo $document;

                ?>
                  <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo htmlspecialchars($row['student_sic']); ?></td>
                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['application_type']); ?></td>
                    <td><?php echo date('d M Y', strtotime($row['apply_date'])); ?></td>
                    <td><a class='btn btn-primary' href='../applicationpdf/<?php echo $document ?>' target='_blank'>View</a></td>

                    <td>
                      <a href="<?php echo $updated_by; ?>?value=allow && aid=<?php echo $row['application_id']; ?>" class="btn btn-success mx-3" id="allow">Allow</a>
                      <a href="<?php echo $updated_by; ?>?value=reject && aid=<?php echo $row['application_id']; ?>" class="btn btn-danger mx-3" id="reject">Reject</a>
                    </td>

                    <?php
                    if (strcmp($stage, "accounts section") === 0) { ?>
                      <td> <a href="" class="btn btn-info mx-3" id="allow">cheack due</a></td>
                    <?php } else {
                    ?>
                      <td> <a href="" class="btn btn-info mx-3" id="allow">cheack due</a></td>
                    <?php }

                    ?>


                  </tr>
                <?php }; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <div class="no-applications">
            <h4>No applications found</h4>
            <p>There are currently no pending applications for the accountant.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script>
    function exportToExcel() {
      // You can implement Excel export functionality here
      // Or redirect to a dedicated export script
      window.location.href = 'export_applications.php?role=accountant';
    }

    function back() {
      window.location.href = " <?php echo $back_to; ?>";
    }
  </script>
</body>

</html>