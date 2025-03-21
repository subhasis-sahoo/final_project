// dashboard.js
const sidebarToggle = document.getElementById('sidebarToggle');
const body = document.body;
const dashboardCard = document.querySelectorAll(".dashboard-card")
const dashboardContainer = document.querySelector(".dashboard-container")


// Toggle sidebar on button click
// if (sidebarToggle) {
sidebarToggle.addEventListener('click', function () {

    // console.log("hello")
    if (dashboardContainer.classList.contains('dashboard-container')) {
        dashboardContainer.classList.remove('dashboard-container');
        dashboardContainer.classList.add('toggled-dashboard-container');

        // console.log(dashboardCard);

        dashboardCard.forEach(element => {
            element.classList.remove('dashboard-card')
            element.classList.add('toggled-dashboard-card')
        });

    } else {
        dashboardContainer.classList.add('dashboard-container');
        dashboardContainer.classList.remove('toggled-dashboard-container');

        dashboardCard.forEach(element => {
            element.classList.add('dashboard-card')
            element.classList.remove('toggled-dashboard-card')
        });
    }

});
// }