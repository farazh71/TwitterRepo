<!DOCTYPE html>
<html>
<head>
    <title>Twitter Signup Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        #signup {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
        }

        button {
            padding: 10px 20px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div id="signup">

        <div class="start-form" id="startForm">
            <input type="text" id="name" placeholder="Name">
            <input type="text" id="phone" placeholder="Phone">
            <button type="button" id="switch">Switch to Email</button>
            <button type="button" id="next" disabled>Next</button>
        </div>

        <div class="end-form hidden" id="endForm">
            <input type="text" id="useraName" placeholder="Name">
            <input type="password" id="password" placeholder="password">
            <input type="date" id="dob" placeholder="Date">
            <button id="backBtn" onclick="backToStartForm()"> Back </button>
            <button type="submit" id="submit" onclick="submitData()">Submit</button>
        </div>


    </div>

    <script>
        let userObj = {};
        let endForm = document.getElementById("endForm");
        let startForm = document.getElementById("startForm");
        console.log(document.getElementById("startForm"), "asfnasl")

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

        function submitData() {

            userObj.userName = document.getElementById("userName").value;
            userObj.password = document.getElementById("password").value
            userObj.dob = document.getElementById("dob").value
            console.log(userObj);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "insertData.php", true);
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