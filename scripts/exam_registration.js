// Exam Registration Page JavaScript
const searchButton = document.getElementById("searchButton");
const semesterSearch = document.getElementById("semesterSearch");
const loadingIndicator = document.getElementById("loadingIndicator");
const noSubjectsFound = document.getElementById('noSubjectsFound');
const registrationForm = document.getElementById('registrationForm');
const declaration = document.getElementById('declaration');
const registerButton = document.getElementById('registerButton');


// const checkedSubjectList = []; 

// Sample subject data for different semesters
const subjectsData = {
    '1': [
        {
            sl: "1",
            subject: "INTERNET TECHNOLOGY & APPLICATIONS(25C99S3T15)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "2",
            subject: "DATABASE MANAGEMENT SYSTEMS(25C99S3T16)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "3",
            subject: "OBJECT ORIENTED PROGRAMMING(25C99S3T17)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "4",
            subject: "COMPUTER NETWORKS(25C99S3T18)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false",
        },
        {
            sl: "5",
            subject: "DISCRETE MATHEMATICS(25C99S3T19)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "6",
            subject: "PROFESSIONAL COMMUNICATION(25C99S3T20)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        }
    ],
    '2': [
        {
            sl: "1",
            subject: "DATA STRUCTURES AND ALGORITHMS(25C99S4T21)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "2",
            subject: "OPERATING SYSTEMS(25C99S4T22)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "3",
            subject: "SOFTWARE ENGINEERING(25C99S4T23)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "4",
            subject: "WEB DEVELOPMENT(25C99S4T24)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "5",
            subject: "COMPUTER ARCHITECTURE(25C99S4T25)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        }
    ],
    '3': [
        {
            sl: "1",
            subject: "ARTIFICIAL INTELLIGENCE(25C99S5T26)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "2",
            subject: "MACHINE LEARNING(25C99S5T27)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "3",
            subject: "CLOUD COMPUTING(25C99S5T28)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "4",
            subject: "MOBILE APPLICATION DEVELOPMENT(25C99S5T29)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "5",
            subject: "INFORMATION SECURITY(25C99S5T30)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "6",
            subject: "BIG DATA ANALYTICS(25C99S5T31)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        }
    ],
    '4': [
        {
            sl: "1",
            subject: "BLOCKCHAIN TECHNOLOGY(25C99S6T32)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "2",
            subject: "INTERNET OF THINGS(25C99S6T33)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "3",
            subject: "NATURAL LANGUAGE PROCESSING(25C99S6T34)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "4",
            subject: "DIGITAL IMAGE PROCESSING(25C99S6T35)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        },
        {
            sl: "5",
            subject: "ETHICAL HACKING(25C99S6T36)",
            amount: 0,
            registration_date: "16-9-2025", 
            status: "false"
        }
    ]
};

// Search button click event
searchButton.addEventListener("click", function () {
    const semester = semesterSearch.value.trim();

    // Hide previous results
    registrationForm.classList.add('d-none');
    noSubjectsFound.classList.add('d-none');

    // Showing loding indicator
    loadingIndicator.classList.remove("d-none")

    // Simulate server request delay
    setTimeout(function () {
        // Hide loading indicator
        loadingIndicator.classList.add('d-none');

        // Checking if semester is valid or not
        if (subjectsData[semester]) {
            // generate subject list with checkboxes inside table body
            generateSubjectList(subjectsData[semester]);

            // Show registration form
            registrationForm.classList.remove('d-none');
        } else {
            // Show no subjects found message
            noSubjectsFound.classList.remove('d-none');
        }
    }, 1000)
});

function generateSubjectList(subjects) {
    const tableBody = document.getElementById("tableBody");

    // Removing previous data from the table body
    tableBody.innerHTML = '';

    // console.log(subjects);

    subjects.forEach((subject) => {

        const tableRow = `
        <tr>
            <td class="fw-medium p-2" style="font-size: .8rem;">${subject.sl}</td>
            <td class="fw-medium p-2" style="font-size: .8rem;">${subject.subject}</td>
            <td class="fw-medium p-2 text-center" style="font-size: .8rem;">${subject.amount}</td>
            <td class="fw-medium p-2 text-center" style="font-size: .8rem;">${subject.registration_date}</td>
            <td class="fw-medium p-2 text-center" style="font-size: .8rem;">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input subject-checkbox w-100 h-100" value="${subject.subject}" id="subject${subject.sl}">
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
document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const checkedSubjectList = [];
    const semester = semesterSearch.value.trim();

    document.querySelectorAll('.subject-checkbox:checked').forEach((ele) => {
        const checkedBoxValue = document.getElementById(`${ele.id}`).value;
        checkedSubjectList.push(subjectsData[semester].filter((subject) => {
            return subject.subject === checkedBoxValue;
        }));
    });

    console.log(checkedSubjectList);

    // checkedSubjectList = 

    alert("Your form is submited successfully.")
    // window.location = "test.php";
});
