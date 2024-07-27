<!DOCTYPE html>
<html>

<head>
    <title>Twitter Landing Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            line-height: 100px;
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
            padding: 6px 0px;
        }

        .action-btn {
            background-color: #1DA1F2;
            color: white;
            border: 0;
            padding: 7px 0px;
        }

        .width-50 {
            width: 50%;
        }

        .width-100 {
            width: 100%;
        }

        .block-display {
            display: block;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 700;
            text-align: center;
        }

        .font-35 {
            font-size: 27px;
        }

        /* new styles by me */
        .icon-style {
            margin-right: 20px;
        }

        .landing-login-div {
            margin-top: 20px;
        }

        .twitter-logo {
            color: #1DA1F2;
            font-size: 50px;
        }

        .landing-login-btn-small {
            border-radius: 20px;
            padding: 10px;
            font-weight: 550;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <ul>
                <li><i class="fa-solid fa-magnifying-glass icon-style"></i> Follow your interests.</li>
                <li><i class="fa-solid fa-user-group icon-style"></i> Hear what people are talking about.</li>
                <li><i class="fa-regular fa-comment icon-style"></i> Join the conversation.</li>
            </ul>
        </div>
        <div class="right-section">
            <div class="width-50">
                <div class="header">
                    <i class="fa-brands fa-twitter twitter-logo"></i>
                    <!-- <img src="../../assets/twitter.webp" alt="Twitter Logo"> -->
                    <a href="./login" class="info-btn landing-login-btn-small">Login</a>
                </div>
                <div class="landing-title">
                    <h3 class="font-35">See what’s happening in the world right now.</h3>
                </div>

                <h4>Join Twitter today.</h4>
                <div>
                    <a href="./signup" class="width-100 action-btn block-display">Sign up</a>
                </div>
                <div class="landing-login-div">
                    <a href="./login" class="width-100 info-btn block-display">Log in</a>
                </div>

            </div>

        </div>
    </div>
</body>

</html>