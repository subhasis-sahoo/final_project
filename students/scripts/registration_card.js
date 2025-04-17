const registrationForm = document.getElementById('registrationForm');
const downloadBtn = document.getElementById('downloadBtn');

downloadBtn.addEventListener('click', function () {
    const studentName = document.getElementById('studentName').innerHTML.replace(" ", "_");
    const studentSic = document.getElementById('studentSic').innerHTML;
    // console.log(studentName, studentSic);
    
    const opt = {
        margin: 0,
        filename: `${studentName}(${studentSic})_exam_registration_card.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 1.5 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(registrationForm).save();
})
