const searchBarForm = document.getElementById("searchBarForm");
const searchButton = document.getElementById("searchButton");
const sicSearched = document.getElementById("sicSearched");
const loadingIndicator = document.getElementById("loadingIndicator");
const warningMsg = document.getElementById('warningMsg');
const accountsDetailsTable = document.getElementById('accountsDetailsTable');
const accountsDetailsTableBody = document.getElementById('accountsDetailsTableBody');

let accountsDetailsData = {};

searchBarForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Get student sic
    const studentSic = sicSearched.value.trim();

    // Get form data
    const formData = new FormData(this);

    // Hide previous results
    accountsDetailsTable.classList.add('d-none');
    warningMsg.classList.add('d-none');

    // Showing loding indicator
    loadingIndicator.classList.remove("d-none");

    setTimeout(async function () {
        // Hide loading indicator
        loadingIndicator.classList.add('d-none');

        // Checking if sic field is empty or not
        if (studentSic !== '') {
            try {
                // Fetching accounts details through student's sic
                const response = await fetch("student_accounts_data.php", {
                    method: "POST",
                    body: formData
                });

                // Parse the response data
                const data = await response.json(); // Use .text() if not returning JSON
                console.log(data);

                if (data.status === 'success') {
                    accountsDetailsData = data.data;
                    generateAccountsDetails(data.data);
                    accountsDetailsTable.classList.remove('d-none');
                } else {
                    warningMsg.classList.add('d-none');
                    warningMsg.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${data.msg}`;
                    warningMsg.classList.remove('d-none');
                }
            } catch (error) {
                console.log("Error while fetching the accounts details of the student: ", error);
            }
        } else {
            warningMsg.classList.add('d-none');
            warningMsg.innerHTML = `<i class="fas fa-exclamation-triangle"></i> Student's SIC must be filled.`;
            warningMsg.classList.remove('d-none');
        }
    }, 1500)
})

function generateAccountsDetails(accountsDetails) {

    // Removing previous data from the table body
    accountsDetailsTableBody.innerHTML = '';

    const payableAmountDetails = accountsDetails.payable_amount_details;
    const reciviableAmountDetails = accountsDetails.reciviable_mount_details;

    // console.log(payableAmountDetails);
    // console.log(reciviableAmountDetails);

    let tableIndex = 0;
    Object.entries(payableAmountDetails).forEach(([key, value]) => {
        tableIndex += 1;
        // console.log(key, " : ", value);

        const tableRow = `
            <div class="row d-flex justify-content-between w-100 m-0 p-0">
                <div class="col-md-1 p-2 border border-secondary border-end-0 border-top-0 m-0">
                    ${tableIndex}
                </div>
                <div class="col-md-7 p-2 border border-secondary border-end-0 border-top-0 m-0 text-capitalize">
                    ${key}(DR)
                </div>
                <div class="col-md-2 p-2 border border-secondary border-end-0 border-top-0 m-0 text-end">
                    ${value.toFixed(2)}
                </div>
                <div class="col-md-2 p-2 border border-secondary border-top-0 m-0 text-end">
                    ${value.toFixed(2)}
                </div>
            </div>
        `;

        accountsDetailsTableBody.innerHTML += tableRow;
    });

    Object.entries(reciviableAmountDetails).forEach(([key, value]) => {
        tableIndex += 1;
        // console.log(key, " : ", value);

        const tableRow = `
            <div class="row d-flex justify-content-between w-100 m-0 p-0">
                <div class="col-md-1 p-2 border border-secondary border-end-0 border-top-0 m-0">
                    ${tableIndex}
                </div>
                <div class="col-md-7 p-2 border border-secondary border-end-0 border-top-0 m-0 text-capitalize">
                    ${key}(CR)
                </div>
                <div class="col-md-2 p-2 border border-secondary border-end-0 border-top-0 m-0 text-end">
                    ${value.toFixed(2)}
                </div>
                <div class="col-md-2 p-2 border border-secondary border-top-0 m-0 text-end">
                    ${value.toFixed(2)}
                </div>
            </div>
        `;

        accountsDetailsTableBody.innerHTML += tableRow;
    });


}