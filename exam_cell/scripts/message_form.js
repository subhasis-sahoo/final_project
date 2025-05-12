const date = document.getElementById('apply_date');
const receiver = document.getElementById('receiver');
const msg = document.getElementById('message');
const doc = document.getElementById('documents');
const warningMsg = document.getElementById('warningMsg');
const searchBarForm = document.getElementById("searchBarForm");
const loadingIndicator = document.getElementById("loadingIndicator");



let examRegistrationData = {};

searchBarForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Getting the semester value
  const sending_date = date.value.trim();
  // const receiver_role = receiver.value.trim();
  console.log(sending_date);




    // Get form data
    const formData = new FormData(this);


    // Showing loding indicator
    loadingIndicator.classList.remove("d-none")

    setTimeout(async function () {
        // Hide loading indicator
        loadingIndicator.classList.add('d-none');

    
            try {
               
                const response = await fetch("send_message.php", {
                    method: "POST",
                    body: formData
                });

                // Parse the response data
                const data = await response.json(); // Use .text() if not returning JSON
                console.log(data);

             

              if (data.status === "success") {
              
                warningMsg.classList.remove('d-none');
                warningMsg.classList.add('text-success');
                warningMsg.innerHTML = "Note: successfully sending the message";

              } else {
                warningMsg.classList.remove('d-none')
                warningMsg.classList.add('text-danger');
                   
                warningMsg.innerHTML = "Note: failed to send the message";
                  
              }

            } catch (error) {
              // console.log("Error: ", error);
              warningMsg.classList.remove('d-none');

                warningMsg.innerHTML = "failed ";
            }
        

    }, 1500)

});
