// Exam Registration Page JavaScript

const sidebarToggle = document.getElementById('sidebarToggle');
const body = document.body;
const examRegistrationContainer = document.querySelector(".exam-registration-container")

const searchBarForm = document.getElementById("searchBarForm");
const searchButton = document.getElementById("searchButton");
const semesterSearch = document.getElementById("semesterSearch");
const loadingIndicator = document.getElementById("loadingIndicator");
const warningBox = document.getElementById('warningBox');
const warningMsg = document.getElementById('warningMsg');
const noSubjectsFound = document.getElementById('noSubjectsFound');
const registrationForm = document.getElementById('registrationForm');
const declaration = document.getElementById('declaration');
const registerButton = document.getElementById('registerButton');


// Toggle sidebar on button click
// if (sidebarToggle) {
sidebarToggle.addEventListener('click', function () {

    // console.log("hello")
    if (examRegistrationContainer.classList.contains('exam-registration-container')) {
        examRegistrationContainer.classList.remove('exam-registration-container');
        examRegistrationContainer.classList.add('toggled-exam-registration-container');
    } else {
        examRegistrationContainer.classList.add('exam-registration-container');
        examRegistrationContainer.classList.remove('toggled-exam-registration-container');
    }

});
// }

searchBarForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Getting the semester value
    const semester = semesterSearch.value.trim();

    // Get form data
    const formData = new FormData(this);

    // Hide previous results
    registrationForm.classList.add('d-none');
    warningBox.classList.add('d-none');
    noSubjectsFound.classList.add('d-none');

    // Showing loding indicator
    loadingIndicator.classList.remove("d-none")

    setTimeout(async function () {
        // Hide loading indicator
        loadingIndicator.classList.add('d-none');

        // Checking if semester is valid or not
        if (semester >= 1 && semester <= 4) {
            try {
                // // Get form data
                // const formData = new FormData(this);

                // Sending semester value and check the student' semester is same or not. If same showing subject list of that semester else showing a warning message. (if semester is same status = 'true' else 'false') 
                const response = await fetch("subject_data.php", {
                    method: "POST",
                    body: formData
                });

                // Parse the response data
                const data = await response.json(); // Use .text() if not returning JSON
                console.log(data);

                if (data.status === "false") {
                    noSubjectsFound.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${data.msg}`;
                    noSubjectsFound.classList.remove("d-none");
                } else {
                    // generate subject list with checkboxes inside table body
                    generateSubjectList(data);

                    // Show registration form
                    registrationForm.classList.remove('d-none');
                }


            } catch (error) {
                console.log("Error: ", error);
            }
        } else {
            noSubjectsFound.innerHTML = `<i class="fas fa-exclamation-triangle"></i> No subjects found for the specified semester.`
            noSubjectsFound.classList.remove('d-none');
        }

    }, 1000)

});


// It generates the subject list in a table format
function generateSubjectList(subjects) {
    const tableBody = document.getElementById("tableBody");

    // Removing previous data from the table body
    tableBody.innerHTML = '';

    // console.log(subjects);

    subjects.forEach((subject, index) => {

        const tableRow = `
        <tr>
            <td class="fw-medium p-2" style="font-size: .83rem;">${index+1}</td>
            <td class="fw-medium p-2" style="font-size: .83rem;">${subject.subject_name}(${subject.subject_code})</td>
            <td class="fw-medium p-2 text-center" style="font-size: .83rem;">${subject.amount}</td>
            <td class="fw-medium p-2 text-center" style="font-size: .83rem;">${subject.registration_date}</td>
            <td class="fw-medium p-2 text-center" style="font-size: .83rem;">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input subject-checkbox w-100 h-100">
                </div>
            </td>
        </tr>
        `;

        tableBody.innerHTML += tableRow;
    });

    // Add event listeners to subject checkboxes
    const subjectCheckboxes = document.querySelectorAll('.subject-checkbox');
    subjectCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const checkedSubjects = document.querySelectorAll('.subject-checkbox:checked').length;


            // Enable or disable the register button based on subject selection
            registerButton.disabled = (checkedSubjects === 0 || !declaration.checked);
        });
    });
}


// Declaration checkbox change event
declaration.addEventListener('change', function () {
    const checkedSubjects = document.querySelectorAll('.subject-checkbox:checked').length;
    registerButton.disabled = (checkedSubjects === 0 || !declaration.checked);
});

// Form submission
registrationForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const checkedSubjectList = [];
    const semester = semesterSearch.value.trim();

    // document.querySelectorAll('.subject-checkbox:checked').forEach((ele) => {
    //     const checkedBoxValue = document.getElementById(`${ele.id}`).value;
    //     checkedSubjectList.push(subjectsData[semester].filter((subject) => {
    //         return subject.subject === checkedBoxValue;
    //     }));
    // });

    // console.log(checkedSubjectList);

    // checkedSubjectList = 

    alert("Your form is submited successfully.")
    window.location = "registration_card.php";
});
