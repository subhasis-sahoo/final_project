const statusBtn = document.querySelectorAll('.sts-btn');
const statusCard = document.querySelector('.status-card');
const closeIcon = document.querySelector('.close-icon');
const appId = document.getElementById('appId');
const overlay = document.querySelector('.overlay');


statusBtn.forEach((button) => {
    button.addEventListener('click', function (e) {
        const applicationId = e.target.id;
        console.log(applicationId);

        statusCard.classList.remove('d-none');
        appId.innerHTML = `[${applicationId}]`;

        overlay.classList.remove('d-none');

    });
});


closeIcon.addEventListener('click', function () {
    statusCard.classList.add('d-none');
    overlay.classList.add('d-none');
});