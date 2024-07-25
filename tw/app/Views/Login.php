<!DOCTYPE html>
<html>
<head>
    <title>Twitter Login Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #F5F8FA;
}

nav ul {
    display: flex;
    justify-content: flex-end;
    padding: 20px;
    list-style-type: none;
}

nav ul li {
    margin-left: 20px;
}

.login-container {
    width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.login-container img {
    height: 50px;
}

.login-container form {
    display: flex;
    flex-direction: column;
    align-items: stretch;
}

.login-container form input {
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #CCC;
    border-radius: 5px;
}

.extra-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0;
}

.login-container form button {
    background-color: #1DA1F2;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    margin-top: 20px;
}
    </style>
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