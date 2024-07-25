<!DOCTYPE html>
<html>
<head>
    <title>Twitter Landing Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
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

.right-section .header button,
.right-section button {
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
    <div class="container">
        <div class="left-section">
            <ul>
                <li>Follow your interests.</li>
                <li>Hear what people are talking about.</li>
                <li>Join the conversation.</li>
            </ul>
        </div>
        <div class="right-section">
            <div class="header">
                <img src="twitter-logo.png" alt="Twitter Logo">
                <button>Login</button>
            </div>
            <p>See what’s happening in the world right now.</p>
            <h2>Join Twitter Today.</h2>
            <button>Sign up</button>
            <button>Log in</button>
        </div>
    </div>
</body>
</html>