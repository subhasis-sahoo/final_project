// Exam Registration Page JavaScript
const searchBarForm = document.getElementById("searchBarForm");
const searchButton = document.getElementById("searchButton");
const semesterSearch = document.getElementById("semesterSearch");
const loadingIndicator = document.getElementById("loadingIndicator");
const warningBox = document.getElementById('warningBox');
const warningMsg = document.getElementById('warningMsg');
const icon = document.getElementById('icon')
const downloadButton = document.getElementById('downloadButton');

// Variable to store subjects list for exam registration
let examRegistrationData = {};

searchBarForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Getting the semester value
    const semester = semesterSearch.value.trim();

    // Get form data
    const formData = new FormData(this);


    // Showing loding indicator
    loadingIndicator.classList.remove("d-none")

    setTimeout(async function () {
        // Hide loading indicator
        loadingIndicator.classList.add('d-none');

            try {
                // Sending semester value and check the student' semester is same or not. If same showing subject list of that semester else showing a warning message. (if semester is same status = 'true' else 'false') 
                const response = await fetch("admit_card.php", {
                    method: "POST",
                    body: formData
                });

                // Parse the response data
                const data = await response.json(); // Use .text() if not returning JSON
                console.log(data);

                // Assigned the response data to registeredSubjectList
                // examRegistrationData = data;

              if (data.status === "success") {
                // noSubjectsFound.innerHTML = <i class="fas fa-exclamation-triangle"></i> ${data.msg};
                // noSubjectsFound.classList.remove("d-none");
                icon.classList.add('d-none');
                warningBox.classList.remove('alert-danger');
                warningBox.classList.remove('d-none');
                warningBox.classList.add('alert-success');
                downloadButton.classList.remove('d-none')

                warningMsg.innerHTML = "Note: You are  eligible to download admit card !!!!";

              } else {
                icon.classList.remove('d-none');
                warningBox.classList.remove('alert-success');
                warningBox.classList.remove('d-none');
                warningBox.classList.add('alert-danger');
                warningMsg.innerHTML = "Note: You are not eligible to download admit card !!!!";
                    
              }

            } catch (error) {
                console.log("Error while fetching the subject list of the student: ", error);
            }

    }, 1500)

});
