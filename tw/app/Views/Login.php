<!DOCTYPE html>
<html>

<head>
    <title>Twitter Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/login_style.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="left-header">
                <i class="fa-brands fa-twitter l_logo"></i>
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="right-header">
                <label>Language:</label>
                <select>
                    <option value="en">English</option>
                </select>
            </div>
        </div>
    </header>
    <div class="login-container">
        <h2>Log in to Twitter</h2>
        <form>
            <input type="text" placeholder="Phone, email, or username" required>
            <input type="password" placeholder="Password" required>
            <div class="extra-options">
                <button type="submit">Log in</button>
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
        </form>
        <p>New to Twitter? <a href="./signup">Sign up now >></a></p>
    </div>
</body>

</html>