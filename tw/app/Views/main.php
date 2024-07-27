<!DOCTYPE html>
<html>

<head>
    <title>Twitter Landing Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            margin-top: 20px;
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
            background-color: #1DA1F2;
            color: white;
            border: 0;
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
            padding: 20px;
        }

        .left-nav,
        .middle-nav,
        .right-nav {
            display: flex;
            align-items: center;
        }

        .left-nav a,
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
    </style>
</head>

<body>
    <div class="nav-bar">
        <div class="left-nav">
            <a href="#">Home</a>
            <a href="#">Moments</a>
            <a href="#">Notifications</a>
            <a href="#">Messages</a>
        </div>
        <div class="middle-nav">
            <img src="twitter-icon.png" alt="Twitter Icon">
        </div>
        <div class="right-nav">
            <input type="text" placeholder="Search">
            <img src="user-image.png" alt="User Image">
            <button>Tweet</button>
        </div>
    </div>
    <div class="height-200 width-100 cover-picture">

    </div>
    <div class="container">
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
</body>

</html>