require('./bootstrap');

// Logout Logic
const logoutLink = document.getElementById('logout');
const logoutForm = document.getElementById('logout-form');

logoutLink.addEventListener('click', function (e) {
    e.preventDefault();
    logoutForm.submit();
});
