const stsBtn = document.querySelectorAll('.sts-btn');

stsBtn.forEach((btn) => {
    const btnID = btn.id;
    btn.addEventListener('click', async function () {
        console.log(btnID);

        const studentSIC = {sic : btnID};
        try {
            const response = await fetch("complete_registration_data.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(studentSIC)
            });

            const data = await response.json();
            console.log(data);

            if(data.status === 'success') {
                document.getElementById(btnID).innerHTML = "Completed";
                document.getElementById(btnID).classList.add("disabled");
            }
        } catch (error) {
            console.log("Error while completing exam registration for student's: ", error);
        }
    })
})