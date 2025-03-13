document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("form").addEventListener("submit", function (e) {
        e.preventDefault();

        let email = document.getElementById("email-input").value;
        let password = document.getElementById("password-input").value;
        let errorMessage = document.getElementById("error-message");

        fetch("login.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "dashboard.php"; // Redirect on success
            } else {
                errorMessage.textContent = data.message;
                errorMessage.style.color = "red";
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
