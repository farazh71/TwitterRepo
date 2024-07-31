<!DOCTYPE html>
<html>

<head>
    <title>Twitter Landing Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/css/home_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log("nfkndsfkndskn")
        const token = localStorage.getItem('jwtToken');
        if (token) {
            verifyToken(token);
        }
    });

    function verifyToken(token) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo base_url()?>/verifyToken", true);
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