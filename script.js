// Function to show the login form
function showLogin() {
    document.getElementById('login-form').style.display = 'block';
    document.getElementById('signup-form').style.display = 'none';
    document.getElementById('forgot-password-form').style.display = 'none'; // Hide forgot password form
    document.getElementById('login-toggle').classList.add('active');
    document.getElementById('signup-toggle').classList.remove('active');
    document.getElementById('forgot-password-toggle').classList.remove('active');
}

// Function to show the signup form
function showSignup() {
    document.getElementById('signup-form').style.display = 'block';
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('forgot-password-form').style.display = 'none'; // Hide forgot password form
    document.getElementById('signup-toggle').classList.add('active');
    document.getElementById('login-toggle').classList.remove('active');
    document.getElementById('forgot-password-toggle').classList.remove('active');
}

// Function to show the forgot password form
function showForgotPassword() {
    document.getElementById('forgot-password-form').style.display = 'block';
    document.getElementById('login-form').style.display = 'none'; // Hide login form
    document.getElementById('signup-form').style.display = 'none'; // Hide signup form
    document.getElementById('forgot-password-toggle').classList.add('active');
    document.getElementById('login-toggle').classList.remove('active');
    document.getElementById('signup-toggle').classList.remove('active');
}

// Initialize the login form as the default form
window.onload = function() {
    showLogin();
};
