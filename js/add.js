function validateFileType() {
    var selectedFile = document.getElementById('fileInput').files[0];
    var allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

    if (!allowedTypes.includes(selectedFile.type)) {
       alert('Invalid file type. Please upload a JPEG, PNG, or PDF file.');
       document.getElementById('fileInput').value = '';
    }
 }