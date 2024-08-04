<!DOCTYPE html>
<html>

<head>
    <title>Twitter Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/login_style.css">
</head>

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
            const successMessage = document.getElementById("successMessage");
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