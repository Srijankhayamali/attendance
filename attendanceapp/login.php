<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>login page</title>
</head>
<body>
    <div class="loginform">
        <div class="inputgroup">
            <input type="text" id="txtUsername" required>
            <label for="txtUsername" id="lblUsername"> USER NAME</label>
        </div>
            <div class="inputgroup topmarginlarge">
                <input type="password" id="txtPassword" required>
                <label for="txtPassword" id="lalPassword"> PASSWORD</label>
            </div>
            <div  class="divcallforaction topmarginlarge">
                <button class="btnlogin inactivecolor" id="btnlogin">LOGIN</button>
            </div>

    </div>
    <script src="js/jquery.js"></script>
    <script src="js/login.js"></script>
</body>
</html>