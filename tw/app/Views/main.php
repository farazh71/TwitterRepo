<!DOCTYPE html>
<html>

<head>
    <title>Twitter Landing Page</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/home_style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .left-section {
            flex-basis: 50%;
        }

        .left-section ul {
            list-style-type: none;
        }

        .right-section {
            flex-basis: 50%;
        }

        .right-section .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .right-section .header img {
            height: 50px;
        }

        button {
            border-radius: 20px;
            padding: 10px 20px;
        }

        .left-section {
            height: 100vh;
            width: 50vw;
            background: #1DA1F2;
            color: white;
            line-height: 55px;
            display: flex;
            align-items: center;
            font-size: 25px;
            font-family: Helvetica;
        }

        .right-section {
            height: 100vh;
            width: 50vw;
            display: flex;
            align-items: center;
            font-family: Helvetica;
            justify-content: center;
        }

        .info-btn {
            background: none;
            color: #1DA1F2;
            border: 1px solid #1DA1F2;
        }

        .action-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background-color: #1da1f2;
            color: white;
            font-weight: 900;
            font-size: 15px;
            cursor: pointer;
        }


        .width-50 {
            width: 50%;
        }

        .width-100 {
            width: 100%;
        }

        .font-35 {
            font-size: 35px;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
        }

        .left-nav,
        .middle-nav,
        .right-nav {
            display: flex;
            align-items: center;
        }

        .right-nav button {
            margin-right: 20px;
        }

        .middle-nav img {
            height: 50px;
            width: 50px;
        }

        .right-nav input {
            padding: 5px;
        }

        .right-nav img {
            height: 30px;
            width: 30px;
            border-radius: 50%;
        }

        .height-200 {
            height: 200px;
        }

        .cover-picture {
            background-color: #1DA1F2;
            border: 1px solid grey;
        }

        .menu ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        .menu ul li {
            margin: 0 10px;
        }

        .edit-profile button {
            padding: 10px 20px;
        }

        .left-nav {
            display: flex;
            flex-direction: row;
            /* Align items horizontally */
            justify-content: space-around;
            /* Space out items */
            border-bottom: 1px solid #e1e4e8;
            /* Optional: bottom border */
        }

        .left-nav a {
            text-decoration: none;
            color: #000;
            font-size: 18px;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            /* Padding around the links */
        }

        .left-nav a i {
            margin-right: 10px;
        }

        .left-nav a:hover {
            background-color: #e1e4e8;
            /* Optional: background color on hover */
            border-radius: 5px;
            /* Optional: rounded corners on hover */
        }

        .search-container {
            position: relative;
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 5px 10px;
            background-color: #f8f9fa;
        }

        .search-icon {
            margin-right: 10px;
            color: #888;
        }

        .search-input {
            border: none;
            outline: none;
            background: none;
            font-size: 16px;
            width: 100%;
        }

        .search-input::placeholder {
            color: #888;
        }

        .profile-photo-section {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: blue;
            margin: 0 10px;
        }

        .cover-picture {
            background-color: #1DA1F2;
            height: 200px;
            width: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .cover-picture .change-cover-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-container {
            position: relative;
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 5px 10px;
            background-color: #f8f9fa;
        }

        .search-icon {
            margin-right: 10px;
            color: #888;
        }

        .search-input {
            border: none;
            outline: none;
            background: none;
            font-size: 16px;
            width: 100%;
        }

        .search-input::placeholder {
            color: #888;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: black;
            position: relative;
            bottom: 100px;
            left: 25px;
        }

        #profileUploadForm {
            position: relative;
            top: 61px;
            text-align: center;
        }

        #profileUploadForm button {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="nav-bar">
        <div class="left-nav">
            <a href="#"><i class="fa-solid fa-house icon-style"></i> Home</a>
            <a href="#"><i class="fa-solid fa-bolt icon-style"></i> Moments</a>
            <a href="#"><i class="fa-solid fa-bell icon-style"></i> Notifications</a>
            <a href="#"><i class="fa-solid fa-envelope icon-style"></i> Messages</a>
        </div>
        <div class="middle-nav">
            <img src="twitter-icon.png" alt="Twitter Icon">
        </div>
        <div class="right-nav">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search Twitter">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </div>
            <div class="profile-photo-section">

            </div>
            <!-- <img src="user-image.png" alt="User Image"> -->
            <button class="action-btn">Tweet</button>
        </div>
    </div>
    <div class="height-200 width-100 cover-picture" id="cover-picture">
        <form id="uploadForm">
            <input type="file" id="coverPhoto" name="cover_photo">
            <button type="submit">Upload Cover Photo</button>
        </form>
    </div>

    <div class="container">
        <div class="profile-picture" id="profile-picture">
            <form id="profileUploadForm">
                <input type="file" id="profilePhoto" name="profile_photo">
                <button type="submit">upload profile Photo</button>
            </form>
        </div>
        <div class="menu">
            <ul>
                <li>
                    <div>Tweets</div>
                    <div>1</div>
                </li>
                <li>
                    <div>Lists</div>
                    <div>1</div>
                </li>
                <li>
                    <div>Moment</div>
                    <div>1</div>
                </li>
            </ul>
        </div>
        <div class="edit-profile">
            <button>Edit profile</button>
        </div>
    </div>
    <div class="main-body">
        <div class="profile-section">
            <p>Rini</p>
            <p>Joined july 2028</p>

        </div>
        <div class="tweets-section">
            <h3>Tweets</h3>
            <div>
                POST
            </div>
        </div>
        <div class="follow-section">
            <h3>Who to follow</h3>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchUserData();

            async function fetchUserData() {
                try {
                    // Retrieve the JWT token from localStorage
                    const token = localStorage.getItem('jwtToken');

                    const response = await fetch('http://localhost:8080/user/data', {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`, // Include the JWT token in the Authorization header
                            'Content-Type': 'application/json'
                        }
                    });

                    if (response.ok) {
                        const userData = await response.json();
                        console.log(userData, "userDatauserData")
                        const coverPictureDiv = document.getElementById('cover-picture');
                        const profilePictureDiv = document.getElementById('profile-picture');
                        if (userData.cover_photo_url) {
                            coverPictureDiv.style.backgroundImage = `url(${userData.cover_photo_url})`;
                        } else {
                            coverPictureDiv.style.backgroundImage = 'none';
                        }
                        if (userData.profile_photo_url) {
                            profilePictureDiv.style.backgroundImage = `url(${userData.profile_photo_url})`;
                        } else {
                            profilePictureDiv.style.backgroundImage = 'none';
                        }
                    } else if (response.status === 401) {
                        console.error('Unauthorized. Please login again.');
                        // Handle the case when the token is invalid or expired
                    } else {
                        console.error('Failed to fetch user data.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            function prepareImageUpload(type, field) {
                var fileInput = document.getElementById(type);
                var file = fileInput.files[0];


                if (!file) {
                    alert('Please select a file to upload.');
                    return;
                }

                // Retrieve the JWT token from localStorage
                var token = localStorage.getItem('jwtToken');
                if (!token) {
                    alert('No JWT token found. Please log in.');
                    return;
                }

                var formData = new FormData();
                formData.append(field, file);


                // Create a new XMLHttpRequest
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'http://localhost:8080/upload-photo', true);

                // Set the Authorization header with the JWT token
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                // Handle the response
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log('Image uploaded successfully:', xhr.responseText);
                            alert('Image updated successfully.');
                            // window.location.href = 'main';
                            fetchUserData();
                        } else if (xhr.status === 401) {
                            alert('Unauthorized. Please log in again.');
                            // Optionally, redirect to login page
                            window.location.href = 'login.html';
                        } else {
                            alert('Failed to upload Image.');
                        }
                    }
                };

                // Send the form data
                xhr.send(formData);
            }

            document.getElementById('uploadForm').addEventListener('submit', function (e) {
                e.preventDefault();
                prepareImageUpload('coverPhoto', 'cover_photo')
            });

            document.getElementById('profileUploadForm').addEventListener('submit', function (e) {
                e.preventDefault();
                prepareImageUpload('profilePhoto', 'profile_photo')
            });

        });
    </script>
</body>

</html>