const paidAmount = document.querySelectorAll('.paid-amount');
const totalPaidAmountField = document.getElementById('totalPaidAmount');
let totalPaidAmount = 0.0;


paidAmount.forEach((field) => {
    field.addEventListener('change', function() {
        paidAmount.forEach((currField) => {
            totalPaidAmount += Number.parseFloat(currField.value);
        })

        totalPaidAmountField.innerHTML = totalPaidAmount;
    });
    
})
