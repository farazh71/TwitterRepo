<!DOCTYPE html>
<html>

<head>
    <title>Twitter Login Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/css/login_style.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
        </ul>
    </nav>
    <div class="login-container">
        <img src="twitter-logo.png" alt="Twitter Logo">
        <h2>Log in to Twitter</h2>
        <form>
            <input type="text" placeholder="Phone, email, or username" required>
            <input type="password" placeholder="Password" required>
            <div class="extra-options">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Log in</button>
        </form>
        <p>New to Twitter? <a href="#">Sign up now</a></p>
    </div>
</body>

</html>