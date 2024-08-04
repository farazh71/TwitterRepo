<!DOCTYPE html>
<html>

<head>
    <title>Twitter Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/login_style.css">
</head>
<style>
    /* Add CSS for the loading screen */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        display: none;
        /* Initially hidden */
    }

    .loading-spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border-left-color: #09f;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Add CSS for the success message */
    .success-message {
        display: none;
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #dff0d8;
        color: #3c763d;
        padding: 15px;
        border: 1px solid #d6e9c6;
        border-radius: 4px;
        z-index: 1001;
    }
</style>

<body>
    <!-- Your HTML code goes here -->
    <div class="login-container">
        <h2>Log in to Twitter</h2>
        <form id="loginForm">
            <input type="text" id="username" placeholder="Phone, email, or username" required>
            <input type="password" id="password" placeholder="Password" required>
            <div class="extra-options">
                <button type="submit">Log in</button>
                <label><input type="checkbox">Remember me</label>
                <a href="#" class="disabled">Forgot password?</a>
            </div>
        </form>
        <p>New to Twitter? <a href="./signup">Sign up now >></a></p>
    </div>

    <!-- Loading screen -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Success message -->
    <div class="success-message" id="successMessage">
        Login successfully...
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "loginUser", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState === 4) {
                    console.log(JSON.parse(this.response), "anfkndskfn")
                    hideLoading();
                    if (this.status === 200) {
                        showSuccessMessage();
                        localStorage.setItem('jwtToken', JSON.parse(this.response).token);
                        setTimeout(() => {
                            window.location.href = 'main';
                        }, 3000);
                    } else {
                        alert('Login failed!');
                    }
                }
            };
            xhr.send("data=" + JSON.stringify({
                user_name: username,
                password: password,
            }));
        }
        );

        function showLoading() {
            loadingOverlay.style.display = 'flex';
        }

        function hideLoading() {
            loadingOverlay.style.display = 'none';
        }

        function showSuccessMessage() {
            successMessage.style.display = 'block';
        }
        document.addEventListener('DOMContentLoaded', function () {
            console.log("nfkndsfkndskn")
            const token = localStorage.getItem('jwtToken');
            if (token) {
                verifyToken(token);
            }
        });

        function verifyToken(token) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo base_url() ?>/verifyToken", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    window.location.href = 'main';
                }
            };
            xhr.send("token=" + token);
        }
    </script>
</body>

</html>