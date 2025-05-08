const newApplicationForm = document.getElementById('newApplicationForm');
const reasonForApplication = document.getElementById('reasonForApplication');
const documents = document.getElementById('documents');
const loadingIndicator = document.getElementById('loadingIndicator');
const warningMsg = document.getElementById('warningMsg');
const newApplicationOverlay = document.getElementById('newApplicationOverlay');


newApplicationForm.addEventListener('submit', function (e) {
    e.preventDefault();
    let isSomeFieldEmpty = false;
    let statusLog = {};

    // Getting form field data
    const reasonValue = reasonForApplication.value.trim();
    const documentValue = reasonForApplication.value.trim();

    const formData = new FormData(this);

    // Getting current date
    const today = new Date();
    const options = { day: '2-digit', month: 'short', year: 'numeric' };
    const formattedDate = today.toLocaleDateString('en-IN', options);

    // Hide warning message
    warningMsg.classList.add('d-none');


    // Showing loding indicator
    loadingIndicator.classList.remove("d-none")

    // Showing overlay
    newApplicationOverlay.classList.remove('d-none');

    setTimeout(async function () {
        // Hide loading indicator
        loadingIndicator.classList.add('d-none');

        // Hide overlay
        newApplicationOverlay.classList.add('d-none');

        // Validate wheather each fileds are empty
        if (reasonValue === '' || documentValue === '') {
            isSomeFieldEmpty = true;
        }

        if (!isSomeFieldEmpty) {
            // Checking application reason and generate a status log
            if (reasonValue === 'Allow for Exam Registration (Unpaid Dues Issue)' || reasonValue === 'Allow to Download Admit card (Unpaid Dues Issue)') {
                statusLog['accounts section'] = { status: "Pending", date: formattedDate, comment: ""}
            } else if (reasonValue === 'Allow to Download Admit card (Low Attendance Issue)' || reasonValue === 'Allow to Download Admit card (Both Reason 2 and 3)') {
                statusLog['faculty advisor'] = { status: "Pending", date: formattedDate, comment: ""}
            }

            // Append stageLog into formData
            formData.append('statusLog', JSON.stringify(statusLog));

            try {
                const response = await fetch("new_application_data.php", {
                    method: "POST",
                    body: formData
                });

                // Parse the response data
                const data = await response.json()
                console.log(data);

                if(data.status === 'success') {
                    warningMsg.innerHTML = `<i class="fa-solid fa-circle-check"></i> ${data.msg}`;
                    warningMsg.classList.remove('d-none');
                    warningMsg.classList.remove('alert-warning');
                    warningMsg.classList.add('alert-success');
                } else if(data.status === 'fail') {
                    warningMsg.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${data.msg}`;
                    warningMsg.classList.remove('d-none');
                    warningMsg.classList.remove('alert-warning');
                    warningMsg.classList.add('alert-danger');
                }
            } catch (error) {
                console.log("Error while submit application: ", error);
            }
        } else {
            warningMsg.innerHTML = `<i class="fas fa-exclamation-triangle"></i> All fields must be filled.`;
            warningMsg.classList.remove('d-none');
            warningMsg.classList.remove('alert-success');
            warningMsg.classList.remove('alert-danger');
            warningMsg.classList.add('alert-warning');
        }
    }, 1500)

})


