const approveBtn = document.querySelectorAll('.approve-btn');
const rejectBtn = document.querySelectorAll('.reject-btn');
const statusCard = document.querySelector('.status-card');
const closeIcon = document.querySelector('.close-icon');
const appId = document.getElementById('appId');
const commentCardForm = document.getElementById('commentCardForm');
const cardBtn = document.getElementById('cardBtn');
const comment = document.getElementById('comment');
const overlay = document.querySelector('.overlay');

let applicationData = {};
let statusLogs = {};


approveBtn.forEach((button) => {
    button.addEventListener('click', async function (e) {
        const applicationId = e.target.id;
        // console.log(applicationId);

        // Append applicationID into applicationData
        applicationData['applicationId'] = applicationId;

        const applicationID = { applicationId: applicationId }

        statusCard.classList.remove('d-none');
        appId.innerHTML = `[${applicationId}]`;

        overlay.classList.remove('d-none');

        cardBtn.value = "Approve";
        cardBtn.classList.remove('btn-danger');
        cardBtn.classList.add('btn-success');

        // fetching status data using applicationID
        try {
            const response = await fetch("application_status_data.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(applicationID)
            });

            const data = await response.json();
            console.log(data);

            statusLogs = data.data;

        } catch (error) {
            console.log("Error while fetching application status data: ", error);
        }
    });
});

rejectBtn.forEach((button) => {
    button.addEventListener('click', async function (e) {
        const applicationId = e.target.id;
        // console.log(applicationId);

        // Append applicationID into applicationData
        applicationData['applicationId'] = applicationId;

        const applicationID = { applicationId: applicationId }

        statusCard.classList.remove('d-none');
        appId.innerHTML = `[${applicationId}]`;

        overlay.classList.remove('d-none');

        cardBtn.value = "Reject";
        cardBtn.classList.remove('btn-success');
        cardBtn.classList.add('btn-danger');

        // fetching status data using applicationID
        try {
            const response = await fetch("application_status_data.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(applicationID)
            });

            const data = await response.json();
            console.log(data);

            statusLogs = data.data;

        } catch (error) {
            console.log("Error while fetching application status data: ", error);
        }
    });
});

closeIcon.addEventListener('click', function () {
    statusCard.classList.add('d-none');
    overlay.classList.add('d-none');
});


commentCardForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    let defaultComment;
    let newStatus;

    console.log(cardBtn.value);

    // Getting current date
    const today = new Date();
    const options = { day: '2-digit', month: 'short', year: 'numeric' };
    const formattedDate = today.toLocaleDateString('en-IN', options);

    if (cardBtn.value === 'Approve') {
        defaultComment = "Approved and forwarded to next stage.";
        newStatus = "Completed";
        statusLogs['stage2'] = { name: 'dean', status: "Pending", date: formattedDate, comment: ""};
    }
    else if (cardBtn.value === 'Reject') {
        defaultComment = "Application rejected and reverted to student.";
        newStatus = "Rejected";
    }



    Object.entries(statusLogs).forEach(([stageKey, stageData]) => {
        // Checking stageData name for add comment
        if (stageData.name === 'faculty advisor') {
            stageData.comment = comment.value || defaultComment;
            stageData.status = newStatus;
        }
    });

    console.log(statusLogs);

    applicationData['statusLog'] = statusLogs;
    applicationData['status'] = cardBtn.value;
    console.log(applicationData);

    try {
        const response = await fetch("update_application.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(applicationData)
        });

        // Parse the response data
        const data = await response.json(); // Use .text() if not returning JSON
        console.log(data);

        if (data.status === 'success') {
            statusCard.classList.add('d-none');
            overlay.classList.add('d-none');
            document.getElementById(`${applicationData.applicationId}Row`).classList.add("d-none");
        }

    } catch (error) {
        console.log("Error while exam registration: ", error);
    }

});