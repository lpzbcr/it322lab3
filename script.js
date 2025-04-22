document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            e.preventDefault(); // Stops form from reloading the page

            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            // ✅ Change this to your actual credentials
            const validEmail = "spiderman@gmail.com";
            const validPassword = "password123";

            if (email === validEmail && password === validPassword) {
                localStorage.setItem("isAuthenticated", "true"); // Store login state
                window.location.href = "dashboard.html"; // Redirect to dashboard
            } else {
                alert("Invalid email or password. Try again!");
            }
        });
    }
});
