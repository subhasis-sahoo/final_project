// dashboard.js
const sidebarToggle = document.getElementById('sidebarToggle');
const body = document.body;
const mainContainer = document.querySelector(".main-container")
const dashboardCard = document.querySelectorAll(".dashboard-card")


// Toggle sidebar on button click
sidebarToggle.addEventListener('click', function () {

    // console.log("hello")
    if (mainContainer.classList.contains('main-container')) {
        mainContainer.classList.remove('main-container');
        mainContainer.classList.add('toggled-main-container');

        // console.log(dashboardCard);

        dashboardCard.forEach(element => {
            element.classList.remove('dashboard-card')
            element.classList.add('toggled-dashboard-card')
        });

    } else {
        mainContainer.classList.add('main-container');
        mainContainer.classList.remove('toggled-main-container');

        dashboardCard.forEach(element => {
            element.classList.add('dashboard-card')
            element.classList.remove('toggled-dashboard-card')
        });
    }

});