<!DOCTYPE html>
<html>
<head>
    <title>Twitter Signup Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/css/signup_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="signup">
        <div class="header">
            <i class="fa-brands fa-twitter my-icon"></i>
            <button class="sup-btn" id="next" type="button">Next</button>
        </div>
        <div class="title">Create your account</div>

        <div class="start-form" id="startForm">
            <div>
                <input type="text" class="underline-input" id="name" placeholder="Name" maxlength="50">
                <div class="char-count" id="nameCharCount">0/50</div>
            </div>
            <input type="text" class="underline-input" id="phone" placeholder="Phone">
            <button type="button" id="switch">Use email instead</button>
        </div>

        <div class="end-form hidden" id="endForm">
            <input type="text" id="userName" placeholder="Name">
            <input type="password" id="password" placeholder="Password">
            <input type="date" id="dob" placeholder="Date of Birth">
            <button id="backBtn" onclick="backToStartForm()">Back</button>
            <button type="submit" id="submit" onclick="submitData()">Submit</button>
        </div>
    </div>

    <script>
        let userObj = {};
        let endForm = document.getElementById("endForm");
        let startForm = document.getElementById("startForm");

        function backToStartForm() {
            startForm.classList.remove("hidden");
            endForm.classList.add("hidden");
        }

        document.getElementById('switch').addEventListener('click', function() {
            var phoneInput = document.getElementById('phone');
            if (phoneInput.getAttribute('placeholder') === 'Phone') {
                phoneInput.setAttribute('placeholder', 'Email');
                phoneInput.setAttribute('type', 'email');
            } else {
                phoneInput.setAttribute('placeholder', 'Phone');
                phoneInput.setAttribute('type', 'text');
            }
        });

        document.getElementById('name').addEventListener('input', enableNext);
        document.getElementById('phone').addEventListener('input', enableNext);

        function enableNext() {
            var name = document.getElementById('name').value;
            var phone = document.getElementById('phone').value;
            if (name && phone) {
                document.getElementById('next').removeAttribute('disabled');
            } else {
                document.getElementById('next').setAttribute('disabled', 'true');
            }
        }

        document.getElementById('next').addEventListener('click', function() {
            var name = document.getElementById('name').value;
            var phoneOrEmail = document.getElementById('phone').value;
            userObj.name = name;
            userObj.phoneOrEmail = phoneOrEmail;

            startForm.classList.add("hidden");
            endForm.classList.remove("hidden");
        });

        document.getElementById('name').addEventListener('input', function() {
            var nameLength = this.value.length;
            var maxLength = this.getAttribute('maxlength');
            document.getElementById('nameCharCount').textContent = nameLength + '/' + maxLength + ' characters';
        });

        function submitData() {
            userObj.userName = document.getElementById("userName").value;
            userObj.password = document.getElementById("password").value;
            userObj.dob = document.getElementById("dob").value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "insertData", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    console.log(this.responseText);
                }
            }
            xhr.send("data=" + JSON.stringify(userObj));
        }
    </script>
</body>
</html>


