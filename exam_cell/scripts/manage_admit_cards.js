const stsBtn = document.querySelectorAll('.sts-btn');

stsBtn.forEach((btn) => {
    const btnID = btn.id;
    btn.addEventListener('click', async function () {
        console.log(btnID);

        const admitCardID = {admitCardID : btnID};
        try {
            const response = await fetch("manage_admit_cards_data.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(admitCardID)
            });

            const data = await response.json();
            console.log(data);

            if(data.status === 'success') {
                // document.getElementById(btnID).innerHTML = "Completed";
                document.getElementById(`${btnID}Row`).classList.add("d-none");
            }
        } catch (error) {
            console.log("Error while completing exam registration for student's: ", error);
        }
    })
})