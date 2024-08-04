<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Signup Page</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/signup_style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            top: 5%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #dff0d8;
            color: #3c763d;
            padding: 15px;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            z-index: 1001;
        }

        /* Highlighting for error state */
        .underline-input.error {
            border-color: #f00;
            /* Change border color to red */
            background-color: #ffe6e6;
            /* Light red background color */
        }
    </style>
</head>

<body>
    <div id="signup">
        <div class="header">
            <button id="backBtn" class="info-btn hidden" onclick="backToStartForm()">Back</button>
            <i class="fa-brands fa-twitter my-icon"></i>
            <button class="action-btn" id="nextBtn" type="button" disabled>Next</button>
        </div>
        <div class="title">Create your account</div>

        <div class="start-form" id="startForm">
            <div>
                <input type="text" class="underline-input" id="name" placeholder="Name" maxlength="50" required>
                <div class="char-count" id="nameCharCount">0/50</div>
            </div>
            <input type="text" class="underline-input" id="phone" placeholder="Phone" required>
            <button type="button" id="switch">Use email instead</button>
        </div>

        <div class="end-form hidden" id="endForm">
            <input type="text" class="underline-input" id="userName" placeholder="User Name" onchange="removeError()"
                required>
            <input type="password" class="underline-input" id="password" placeholder="Password" required>
            <input type="date" class="underline-input" id="dob" placeholder="Date of Birth" required>
            <textarea class="underline-input" id="bio" placeholder="Enter Bio"></textarea>
            <button type="submit" class="action-btn" id="submit" onclick="submitData()">Submit</button>
        </div>
    </div>

    <!-- Loading screen -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Success message -->
    <div class="success-message" id="successMessage">
        Your account has been successfully created! Redirecting to login...
    </div>

    <script>
        const userObj = {};
        const endForm = document.getElementById("endForm");
        const startForm = document.getElementById("startForm");
        const nextBtn = document.getElementById("nextBtn");
        const backBtn = document.getElementById("backBtn");
        const nameInput = document.getElementById("name");
        const phoneInput = document.getElementById("phone");
        const loadingOverlay = document.getElementById("loadingOverlay");
        const successMessage = document.getElementById("successMessage");

        document.getElementById('switch').addEventListener('click', switchPhoneEmail);
        nameInput.addEventListener('input', updateCharCount);
        nameInput.addEventListener('input', enableNextButton);
        phoneInput.addEventListener('input', enableNextButton);
        nextBtn.addEventListener('click', showEndForm);

        function backToStartForm() {
            toggleForms();
            nextBtn.classList.remove("hidden");
            backBtn.classList.add("hidden");
        }

        function removeError() {
            document.getElementById("userName").classList.remove('error');
        }

        function switchPhoneEmail() {
            if (phoneInput.placeholder === 'Phone') {
                phoneInput.placeholder = 'Email';
                phoneInput.type = 'email';
            } else {
                phoneInput.placeholder = 'Phone';
                phoneInput.type = 'text';
            }
        }

        function updateCharCount() {
            const nameLength = nameInput.value.length;
            const maxLength = nameInput.getAttribute('maxlength');
            document.getElementById('nameCharCount').textContent = `${nameLength}/${maxLength} characters`;
        }

        function enableNextButton() {
            const name = nameInput.value;
            const phone = phoneInput.value;
            if (name && phone) {
                nextBtn.removeAttribute('disabled');
            } else {
                nextBtn.setAttribute('disabled', 'true');
            }
        }

        function showEndForm() {
            userObj.Name = nameInput.value;
            userObj.phone_or_email = phoneInput.value;
            toggleForms();
            nextBtn.classList.add("hidden");
            backBtn.classList.remove("hidden");
        }

        function toggleForms() {
            startForm.classList.toggle("hidden");
            endForm.classList.toggle("hidden");
        }

        function submitData() {

            userObj.user_name = document.getElementById("userName").value,
                userObj.password = document.getElementById("password").value,
                userObj.date_of_birth = document.getElementById("dob").value,
                userObj.bio = document.getElementById("bio").value

            showLoading();

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "insertData", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState === 4) {
                    hideLoading();
                    if (this.status === 200) {
                        showSuccessMessage("Your account has been successfully created! Redirecting to login...");
                        setTimeout(() => {
                            window.location.href = 'login'; // Redirect to login page
                        }, 3000);
                    } else if (this.status === 409) { // HTTP status code for conflict (duplicate entry)
                        showSuccessMessage("Username already exists. Please choose a different username.");
                        highlightInput('userName');
                    } else {
                        console.error("An error occurred");
                        console.log(this.responseText); // Log the error response for debugging
                    }
                }
            };
            xhr.send("data=" + JSON.stringify(userObj));
        }

        function showLoading() {
            loadingOverlay.style.display = 'flex';
        }

        function hideLoading() {
            loadingOverlay.style.display = 'none';
        }

        function showSuccessMessage(message) {
            successMessage.style.display = 'block';
            successMessage.innerText = message;
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        }

        function highlightInput(inputId) {
            const input = document.getElementById(inputId);
            input.classList.add('error');
            input.focus();
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