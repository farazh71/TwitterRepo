<!DOCTYPE html>
<html>

<head>
    <title>Twitter Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css"> -->
     <style>
        body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #f5f8fa;
  margin: 0;
  padding: 0;
}

header {
  background-color: white;
  border: 1px solid #e1e8ed;
  padding: 15px;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.left-header {
  display: flex;
  align-items: center;
}

.logo {
  margin-right: 15px;
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
}

nav ul li {
  margin-right: 15px;
}

nav ul li a {
  text-decoration: none;
  color: grey;
  font-weight: 700;
}

.right-header {
  display: flex;
  align-items: center;
}

.right-header label {
  color: grey;
}

.right-header select {
  border: none;
  border-radius: 3px;
  background-color: white;
  color: #808080;
  font-weight: 800;
}

.login-container {
  max-width: 600px;
  margin: 10px auto;
  padding: 10px 100px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.login-container img {
  width: 50px;
  height: auto;
  margin-bottom: 20px;
}

.login-container h2 {
  margin-bottom: 20px;
  font-weight: bolder;
}

.login-container form input {
  width: 50%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #e1e8ed;
  border-radius: 3px;
}

.login-container form input:focus {
  border-color: #1da1f2;
  outline: none;
}

.extra-options {
  display: flex;
  justify-content: left;
  gap: 10px;
  align-items: center;
  margin-bottom: 20px;
}

.extra-options a {
  color: #1da1f2;
  text-decoration: none;
}

.extra-options label {
  display: flex;
  align-items: center;
}

.extra-options input[type="checkbox"] {
  width: 16px;
  height: 16px;
  appearance: none;
  margin-right: 10px;
  border: 1px solid #c0c0c0;
  /* Light grey border to simulate default look */
  border-radius: 3px;
  background-color: #d8d8d8;
  position: relative;
  cursor: pointer;
  display: inline-block;
  vertical-align: middle;
}

.extra-options input[type="checkbox"]:focus {
  outline: none;
  /* Remove the outline when focused */
}

.extra-options input[type="checkbox"]:checked {
  background-color: #d8d8d8;
  /* Background color for the checked state */
  border-color: #c0c0c0;
  /* Ensure the border color stays consistent */
}

.extra-options input[type="checkbox"]:checked::after {
  content: "";
  position: absolute;
  left: 4px;
  top: 1px;
  width: 5px;
  height: 10px;
  border: solid black;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
  display: inline-block;
  vertical-align: middle;
}

.login-container button {
  padding: 10px 20px;
  border: none;
  border-radius: 20px;
  background-color: #1da1f2;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

.login-container p {
  margin-top: 20px;
  color: grey;
}

.login-container p a {
  color: #1da1f2;
  text-decoration: none;
}

.l_logo {
  color: #1da1f2;
  margin-right: 5px;
  font-size: 20px;
}

/*  new styles  */

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
</head>

<body>
    <header>
        <div class="container">
            <div class="left-header">
                <i class="fab fa-twitter l_logo"></i>
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="right-header">
                <label for="language">Language:</label>
                <select id="language">
                    <option value="en">English</option>
                </select>
            </div>
        </div>
    </header>

    <div class="login-container">
        <h2>Log in to Twitter</h2>
        <form id="loginForm">
            <input type="text" id="username" placeholder="Phone, email, or username" required>
            <input type="password" id="password" placeholder="Password" required>
            <div class="extra-options">
                <button type="submit">Log in</button>
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
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
            showLoading();
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "loginUser", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState === 4) {
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
        });

        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        function showSuccessMessage() {
            document.getElementById('successMessage').style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function () {
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
