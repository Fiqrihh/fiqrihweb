$(document).ready(function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 1000); // 2 seconds
});


// Menghilangkan notifikasi sukses setelah 5 detik
setTimeout(function() {
    $('#success-alert').fadeOut('fast');
}, 500);

// Menghilangkan notifikasi kesalahan setelah 5 detik
setTimeout(function() {
    $('#error-alert').fadeOut('fast');
}, 5000);

// notifications.js

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function (alert) {
            alert.style.display = 'none';
        });
    }, 2000); // 3 seconds
});
