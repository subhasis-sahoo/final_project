const statusBtn = document.querySelectorAll('.sts-btn');
const statusCard = document.querySelector('.status-card');
const closeIcon = document.querySelector('.close-icon');
const statusCardBody = document.getElementById('statusCardBody');
const appId = document.getElementById('appId');
const overlay = document.querySelector('.overlay');


statusBtn.forEach((button) => {
    button.addEventListener('click', async function (e) {
        const applicationId = e.target.id;
        // console.log(applicationId);

        const applicationID = { applicationId: applicationId }

        statusCard.classList.remove('d-none');
        appId.innerHTML = `[${applicationId}]`;

        overlay.classList.remove('d-none');

        // fetching status data using applicationID
        try {
            const response = await fetch("application_status.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(applicationID)
            });

            const data = await response.json();
            console.log(data);

            if (data.status === 'success') {
                generateStatusCardBody(data.data);
            }
        } catch (error) {
            console.log("Error while fetching application status data: ", error);
        }
    });
});


closeIcon.addEventListener('click', function () {
    statusCard.classList.add('d-none');
    overlay.classList.add('d-none');
});

function generateStatusCardBody(statusData) {
    statusCardBody.innerHTML = "";

    console.log(statusData);

    Object.entries(statusData).forEach(([stageKey, stageData]) => {
        let statusColor = '';

        // Checking stageData status
        if(stageData.status === 'Pending') {
            statusColor = 'warning';
        } else if(stageData.status === 'Completed') {
            statusColor = 'success';
        } else if(stageData.status === 'Rejected') {
            statusColor = 'danger';
        }


        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-capitalize" >${stageData.name}</td>
            <td class="text-${statusColor}" >${stageData.status}</td>
            <td>${stageData.date}</td>
            <td>${stageData.comment || '-'}</td>
        `;
        statusCardBody.appendChild(row);
    });


}