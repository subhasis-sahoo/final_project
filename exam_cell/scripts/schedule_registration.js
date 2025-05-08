const scheduleRegistrationForm = document.getElementById('scheduleRegistrationForm');
const year = document.getElementById('year');
const month = document.getElementById('month');
const startDay = document.getElementById('startDay');
const endDay = document.getElementById('endDay');

const loadingIndicator = document.getElementById('loadingIndicator');
const warningMsg = document.getElementById('warningMsg');
const scheduleRegistrationOverlay = document.getElementById('scheduleRegistrationOverlay');



scheduleRegistrationForm.addEventListener('submit', function (e) {
    e.preventDefault();
    let isSomeFieldEmpty = false;

    // Getting month field value
    const monthValue = month.value.trim();

    const formData = new FormData(this);

    // Hide warning message
    warningMsg.classList.add('d-none');


    // Showing loding indicator
    loadingIndicator.classList.remove("d-none")

    // Showing overlay
    scheduleRegistrationOverlay.classList.remove('d-none');

    setTimeout(async function () {
        // Hide loading indicator
        loadingIndicator.classList.add('d-none');

        // Hide overlay
        scheduleRegistrationOverlay.classList.add('d-none');

        // Validate wheather each fileds are empty
        for (let [key, value] of formData.entries()) {
            if (value === '') {
                isSomeFieldEmpty = true;
            }
        }
        if (monthValue === '') {
            isSomeFieldEmpty = true;
        }

        if (!isSomeFieldEmpty) {
            try {
                const response = await fetch("schedule_registration_data.php", {
                    method: "POST",
                    body: formData
                });

                // Parse the response data
                const data = await response.json()
                console.log(data);

                if (data.status === 'success') {
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
                console.log("Error while schedule deadline for the exam registration: ", error);
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