const sidebarToggle = document.getElementById('sidebarToggle');
const body = document.body;
const examTermsContainer = document.querySelector(".exam-terms-container");

// Toggle sidebar on button click
sidebarToggle.addEventListener('click', function () {

    // console.log("hello")
    if (examTermsContainer.classList.contains('exam-terms-container')) {
        examTermsContainer.classList.remove('exam-terms-container');
        examTermsContainer.classList.add('toggled-exam-terms-container');
    } else {
        examTermsContainer.classList.add('exam-terms-container');
        examTermsContainer.classList.remove('toggled-exam-terms-container');
    }

});
