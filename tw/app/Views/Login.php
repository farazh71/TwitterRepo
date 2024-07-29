<!-- <!DOCTYPE html>
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
        <p>New to Twitter? <a href="./signup">Sign up now</a></p>
    </div>
</body>

</html> -->

<!DOCTYPE html>
<html>
<head>
    <title>Twitter Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/css/login_style.css"> -->
     <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f8fa;
    margin: 0;
    padding: 0;
}

header {
    background-color: white;
    border-bottom: 1px solid #e1e8ed;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content {
    display: flex;
    width: 100%;
    justify-content: space-between;
}

.left-header {
    display: flex;
    align-items: center;
}

.logo {
    width: 50px;
    height: auto;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

nav ul li {
    margin-right: 15px;
}

nav ul li a {
    text-decoration: none;
    color:grey;
    font-weight:700;
}

.right-header select {
    border: 1px solid #e1e8ed;
    padding: 5px;
    border-radius: 3px;
    background-color: white;
}

.login-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.login-container img {
    width: 50px;
    height: auto;
    margin-bottom: 20px;
}

.login-container h2 {
    margin-bottom: 20px;
    color: #1da1f2;
}

.login-container form input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #e1e8ed;
    border-radius: 3px;
}

.login-container .extra-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.login-container .extra-options label,
.login-container .extra-options a {
    color: #1da1f2;
    text-decoration: none;
}

.login-container button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 3px;
    background-color: #1da1f2;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

.login-container p {
    margin-top: 20px;
}

.login-container p a {
    color: #1da1f2;
    text-decoration: none;
}
.l_logo{
    color: #1da1f2;
    margin-right: 5px;
    font-size: 20px;
}
.right-header select {
    border:none;
    padding: 5px;
    border-radius: 3px;
    background-color:whit;
    color: #1da1f2;
    font-weight: bold;
    width: auto;
}

.right-header select option {
    background-color: white;
    color: grey;
}

/* You can target the specific option by its value attribute */
.right-header select option[value="en"] {
    color: #1da1f2;
    font-weight: bold;
}
     </style>
</head>
<body>
    <header>
        <div class="header-content">
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
                    <option class="grey" value="en">English</option>
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
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Log in</button>
        </form>
        <p>New to Twitter? <a href="./signup">Sign up now</a></p>
    </div>
</body>

</html>
