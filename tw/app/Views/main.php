<!DOCTYPE html>
<html>

<head>
    <title>Twitter Landing Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/main_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <div id="profile-photo-section"></div>
            <!-- <img src="user-image.png" alt="User Image"> -->
            <button class="action-btn">Tweet</button>
        </div>
    </div>
    <div class="height-200 width-100 cover-picture parent" id="cover-picture">
        <form id="uploadForm" class="hover-element">
            <input type="file" id="coverPhoto" name="cover_photo">
            <button type="submit">Upload Cover Photo</button>
        </form>
    </div>

    <div class="container">
        <div class="profile-picture-container">
            <div class="profile-picture parent" id="profile-picture">
                <form id="profileUploadForm" class="hover-element">
                    <input type="file" id="profilePhoto" name="profile_photo">
                    <button type="submit">upload profile Photo</button>
                </form>
            </div>
        </div>

        <div class="bucket-memu">
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
            <button class="default-btn" id="edit-profile-btn" onclick="showEditProfileForm()">Edit profile</button>
            <div id="save-profile-changes" class="hidden">
                <button class="info-btn black-clr">Cancel</button>
                <button class="info-btn blue-clr" onclick="submitData()">Save changes</button>
            </div>
        </div>
    </div>
    <div class="main-body">
        <div class="profile-section">
            <div id="view-profile">
                <b>
                    <p id="user-name"></p>
                </b>
                <p><span>Bio: </span><span id="bio"></span></p>
                <p><i class="fa-solid fa-calendar-days icon-style icon-right-space"> </i><span id="joining-date"></spam>
                </p>
            </div>
            <div id="edit-profile" class="hidden">
                <div id="updateProfileForm" class="update-profile-form">
                    Name: <input type="text" value="" id="firstNameLastName">
                    Bio: <input type="text" value="" id="bioProfile">
                    Location: <input type="text" value="" id="location">
                    Website: <input type="text" value="" id="website">
                    Birthday: <input type="date" value="" id="dob">
                    <input type="text" class="hidden" value="" id="userName">
                </div>
            </div>

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
    <!-- Loading screen -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Success message -->
    <div class="success-message" id="successMessage">
    </div>
    <script>
        function submitData() {
            const userObj = {};
            userObj.Name = document.getElementById("firstNameLastName").value,
            userObj.bio = document.getElementById("bioProfile").value,
            userObj.date_of_birth = document.getElementById("dob").value,
            userObj.website = document.getElementById("website").value
            userObj.location = document.getElementById("location").value
            userObj.user_name = document.getElementById("userName").value

            showLoading();
            var token = localStorage.getItem('jwtToken');
                if (!token) {
                    alert('No JWT token found. Please log in.');
                    return;
                }
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "updateProfile", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            xhr.onreadystatechange = function () {
                if (this.readyState === 4) {
                    hideLoading();
                    if (this.status === 200) {
                        showSuccessMessage("Your account has been successfully updated!")
                        document.getElementById("save-profile-changes").classList.add("hidden");
                        document.getElementById("edit-profile-btn").classList.remove("hidden");
                    } else if (this.status === 409) { // HTTP status code for conflict (duplicate entry)
                        showSuccessMessage("Unable to save data");
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
        function showEditProfileForm() {
            const viewProfile = document.getElementById("view-profile");
            const editProfile = document.getElementById("edit-profile");
            const editProfileBtn = document.getElementById("edit-profile-btn");
            const saveProfile = document.getElementById("save-profile-changes");
            viewProfile.classList.add("hidden");
            editProfile.classList.remove("hidden");
            editProfileBtn.classList.add("hidden");
            saveProfile.classList.remove("hidden")
        }
        document.addEventListener('DOMContentLoaded', function () {
            fetchUserData();
            async function fetchUserData() {
                try {
                    // Retrieve the JWT token from localStorage
                    const token = localStorage.getItem('jwtToken');

                    const response = await fetch('http://localhost:8081/user/data', {
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
                        const headerProfilePhoto = document.getElementById('profile-photo-section')
                        const userName = document.getElementById('user-name')
                        const bio = document.getElementById('bio')
                        const joinedDate = document.getElementById('joining-date')
                        if (userData.cover_photo_url) {
                            coverPictureDiv.style.backgroundImage = `url(${userData.cover_photo_url})`;
                        } else {
                            coverPictureDiv.style.backgroundImage = 'none';
                        }
                        if (userData.profile_photo_url) {
                            profilePictureDiv.style.backgroundImage = `url(${userData.profile_photo_url})`;
                            headerProfilePhoto.style.backgroundImage = `url(${userData.profile_photo_url})`;
                        } else {
                            profilePictureDiv.style.backgroundImage = 'none';
                            headerProfilePhoto.style.backgroundImage = 'none';
                        }
                        userName.innerText = userData.Name;
                        bio.innerText = userData.bio;
                        joinedDate.innerText = formatDate(userData.created_at);
                        document.getElementById("firstNameLastName").value = userData.Name;
                        document.getElementById("bioProfile").value = userData.bio;
                        document.getElementById("location").value = userData.location;
                        document.getElementById("website").value = userData.website;
                        document.getElementById("dob").value = userData.dob || "";
                        document.getElementById("userName").value = userData.user_name;
                    } else if (response.status === 401) {
                        console.error('Unauthorized. Please login again.');
                        window.location.href = 'login';
                        // Handle the case when the token is invalid or expired
                    } else {
                        console.error('Failed to fetch user data.');
                        window.location.href = 'login';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    window.location.href = 'login';
                }
            }

            function formatDate(dateString) {
                const date = new Date(dateString);
                const options = { year: 'numeric', month: 'long' };
                return date.toLocaleDateString('en-US', options);
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
                xhr.open('POST', 'http://localhost:8081/upload-photo', true);

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
                            window.location.href = 'login';
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