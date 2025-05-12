<?php
include_once "../header.php";
include_once "./sidebar.php";
require_once "functions.php";
// session_start();

// In a real application, you would get the student department from session
// For demonstration purposes, we're setting a default department
// In production, you would use: $student_department = $_SESSION['department'];
// $student_department = isset($_SESSION['department']) ? $_SESSION['department'] : "MCA2";

// Get all messages for this department
$messages = fetch_messages();
?>

<div class="main-container">
    <!-- Main Content -->
    <div class="p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4">Notifications</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="dashboard.php" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-sm btn-danger" id="deleteSelected">
                        <i class="bi bi-trash"></i> Delete Selected
                    </button>
                    <!-- <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="#">All Messages</a></li>
                                    <li><a class="dropdown-item" href="#">Unread</a></li>
                                    <li><a class="dropdown-item" href="#">Read</a></li>
                                    <li><a class="dropdown-item" href="#">With Attachments</a></li>
                                </ul>
                            </div> -->
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover message-table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th style="width: 30px;">#</th>
                                <th style="width: 180px;">From</th>
                                <th>Message</th>
                                <th style="width: 100px;">Date</th>
                                <th style="width: 80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($messages)):
                                $counter = 1;
                                foreach ($messages as $message):
                            ?>
                                    <tr id="message-<?php echo $message['m_id']; ?>">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input message-checkbox" type="checkbox" value="<?php echo $message['m_id']; ?>">
                                            </div>
                                        </td>
                                        <td><?php echo $counter++; ?></td>
                                        <td>
                                            <i class="bi bi-person-circle me-2"></i>
                                            <?php echo htmlspecialchars($message['sender_role']); ?>
                                        </td>
                                        <td>
                                            <a href="#" class="message-link view-message"
                                                data-message-id="<?php echo $message['m_id']; ?>"
                                                data-sender="<?php echo htmlspecialchars($message['sender_role']); ?>"
                                                data-date="<?php echo htmlspecialchars($message['date']); ?>"
                                                data-message="<?php echo htmlspecialchars($message['message']); ?>"
                                                data-doc="<?php echo htmlspecialchars($message['doc']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#messageModal">
                                                <?php
                                                $preview = substr($message['message'], 0, 50);
                                                echo htmlspecialchars($preview);
                                                if (strlen($message['message']) > 50) echo '...';
                                                ?>
                                            </a>
                                        </td>
                                        <td class="message-date"><?php echo htmlspecialchars($message['date']); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-link message-action-btn p-0 me-2 view-message"
                                                data-message-id="<?php echo $message['m_id']; ?>"
                                                data-sender="<?php echo htmlspecialchars($message['sender_role']); ?>"
                                                data-date="<?php echo htmlspecialchars($message['date']); ?>"
                                                data-message="<?php echo htmlspecialchars($message['message']); ?>"
                                                data-doc="<?php echo htmlspecialchars($message['doc']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#messageModal">
                                                <i class="bi bi-envelope-open"></i>
                                            </button>
                                            <button class="btn btn-sm btn-link message-action-btn p-0 delete-message"
                                                data-message-id="<?php echo $message['m_id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">No messages found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white py-2">
                <nav aria-label="Message pagination">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Message Modal -->
<div class="modal fade mt-5" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>From:</strong> <span id="modalSender"></span>
                        </div>
                        <div>
                            <strong>Date:</strong> <span id="modalDate"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-3" id="modalMessage">
                        <!-- Message content will be inserted here -->
                    </div>
                    <div class="mt-4" id="modalAttachment">
                        <!-- Attachment info will be inserted here -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger me-auto" id="modalDelete" data-message-id="">
                    <i class="bi bi-trash me-1"></i> Delete
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enable tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Select all checkbox functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const itemCheckboxes = document.querySelectorAll('.message-checkbox');

        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        // View message functionality
        const viewButtons = document.querySelectorAll('.view-message');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const messageId = this.getAttribute('data-message-id');
                const sender = this.getAttribute('data-sender');
                const date = this.getAttribute('data-date');
                const message = this.getAttribute('data-message');
                const doc = this.getAttribute('data-doc');

                // Populate modal content
                document.getElementById('modalSender').textContent = sender;
                document.getElementById('modalDate').textContent = date;
                document.getElementById('modalMessage').innerHTML = '<p>' + message.replace(/\n/g, '<br>') + '</p>';
                document.getElementById('modalDelete').setAttribute('data-message-id', messageId);

                // Handle attachment display
                const attachmentContainer = document.getElementById('modalAttachment');
                if (doc && doc !== "") {
                    attachmentContainer.innerHTML = `
                            <div class="card">
                                <div class="card-header bg-light">
                                    <strong>Attachments</strong>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark text-primary fs-4 me-2"></i>
                                        <div>
                                            <div>${doc}</div>
                                            <small class="text-muted">Document</small>
                                        </div>
                                        <a href="msg_document/${doc}" class="btn btn-sm btn-primary ms-auto" download>
                                            <i class="bi bi-download me-1"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                } else {
                    attachmentContainer.innerHTML = '';
                }
            });
        });

        // Delete message functionality
        const deleteButtons = document.querySelectorAll('.delete-message');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const messageId = this.getAttribute('data-message-id');
                if (confirm('Are you sure you want to delete this message?')) {
                    deleteMessage(messageId);
                }
            });
        });

        // Modal delete button
        document.getElementById('modalDelete').addEventListener('click', function() {
            const messageId = this.getAttribute('data-message-id');
            if (confirm('Are you sure you want to delete this message?')) {
                deleteMessage(messageId);
                const modal = bootstrap.Modal.getInstance(document.getElementById('messageModal'));
                modal.hide();
            }
        });

        // Delete selected messages button
        document.getElementById('deleteSelected').addEventListener('click', function() {
            const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
            if (selectedCheckboxes.length === 0) {
                alert('Please select at least one message to delete');
                return;
            }

            if (confirm(`Are you sure you want to delete ${selectedCheckboxes.length} message(s)?`)) {
                selectedCheckboxes.forEach(checkbox => {
                    const messageId = checkbox.value;
                    deleteMessage(messageId);
                });
            }
        });

        // Function to handle the delete message action through PHP
        function deleteMessage(messageId) {
            fetch('delete_message_ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'm_id=' + messageId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove message row from UI
                        document.getElementById('message-' + messageId).remove();
                    } else {
                        alert('Error deleting message: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the message.');
                });
        }
    });
</script>