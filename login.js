// JavaScript validation
const loginForm = document.getElementById('loginForm');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');

loginForm.addEventListener('submit', function (event) {
    let isValid = true;

    // Validate email
    if (!emailInput.value || !emailInput.value.includes('@')) {
        emailError.style.display = 'block';
        isValid = false;
    } else {
        emailError.style.display = 'none';
    }

    // Validate password
    if (!passwordInput.value) {
        passwordError.style.display = 'block';
        isValid = false;
    } else {
        passwordError.style.display = 'none';
    }

    // Prevent form submission if invalid
    if (!isValid) {
        event.preventDefault();
    }
});
