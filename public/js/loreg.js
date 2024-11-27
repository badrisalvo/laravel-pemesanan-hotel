document.addEventListener("DOMContentLoaded", function () {
    // Modal elements
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const loginAlert = document.getElementById('login-alert');
    const registerAlert = document.getElementById('register-alert');
    const loginClose = document.getElementById('loginClose');
    const registerClose = document.getElementById('registerClose');
    
    // Elements for opening modals
    const openLoginModal = document.getElementById('openLoginModal'); // From Register Modal
    const openRegisterModal = document.getElementById('openRegisterModal'); // From Login Modal
    const loginBtn = document.getElementById('loginBtn'); // The 'Login' button in your navigation bar

    // Open Login Modal when clicking 'Login' from Navigation
    loginBtn.onclick = function() {
        loginModal.style.display = "block"; // Show Login Modal
        registerModal.style.display = "none"; // Hide Register Modal
    };

    // Show Register Modal when clicking 'Register' from Login Modal
    openRegisterModal.onclick = function() {
        loginModal.style.display = "none"; // Hide Login Modal
        registerModal.style.display = "block"; // Show Register Modal
    };

    // Show Login Modal when clicking 'Login' from Register Modal
    openLoginModal.onclick = function() {
        registerModal.style.display = "none"; // Hide Register Modal
        loginModal.style.display = "block"; // Show Login Modal
    };

    // Close Modal when clicking on close icon (X)
    loginClose.onclick = () => loginModal.style.display = "none";
    registerClose.onclick = () => registerModal.style.display = "none";

    // Handle Login Submit
    document.getElementById('loginSubmit').onclick = async function () {
        const formData = new FormData(document.getElementById('loginForm'));
        try {
            const response = await fetch(routes.login, { // Use global 'routes' variable
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (response.ok) {
                loginAlert.classList.remove('d-none', 'alert-danger');
                loginAlert.classList.add('alert-success');
                loginAlert.textContent = "Login success! Redirecting...";

                // Redirect based on user role
                const userRole = result.user.role; // Ensure 'role' is returned in the response
                if (userRole === 'customer') {
                    setTimeout(() => location.href = '/', 1000); // Redirect to /home for customer
                } else if (userRole === 'admin') {
                    setTimeout(() => location.href = '/admin/about', 1000); // Redirect to /admin/about for admin
                } else {
                    setTimeout(() => location.reload(), 1000); // Fallback to reload if role is undefined
                }
            } else {
                loginAlert.classList.remove('d-none', 'alert-success');
                loginAlert.classList.add('alert-danger');
                loginAlert.textContent = result.errors 
                    ? result.errors.map(e => `${e.field}: ${e.message}`).join('\n') 
                    : result.message || "Login failed!";
            }
        } catch (error) {
            console.error(error);
        }
    };

    // Handle Register Submit
    document.getElementById('registerSubmit').onclick = async function () {
        const formData = new FormData(document.getElementById('registerForm'));
        try {
            const response = await fetch(routes.register, { // Use global 'routes' variable
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (response.ok) {
                registerAlert.classList.remove('d-none', 'alert-danger');
                registerAlert.classList.add('alert-success');
                registerAlert.textContent = "Registration successful! Redirecting...";
                setTimeout(() => {
                    window.location.href = result.redirect_url;
                }, 1500);
            } else {
                registerAlert.classList.remove('d-none', 'alert-success');
                registerAlert.classList.add('alert-danger');
                registerAlert.textContent = result.errors 
                    ? result.errors.map(e => `${e.field}: ${e.message}`).join('\n') 
                    : result.message || "Registration failed!";
            }
        } catch (error) {
            console.error(error);
        }
    };
});
