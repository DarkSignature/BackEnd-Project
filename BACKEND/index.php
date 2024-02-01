<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leeves Attendance - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="img/bracer.jpg">
    <style>
        .container{
            border: black solid;
            border-radius: 20px;
            width: 220px;
            padding: 15px;
            height: 300px;
            background-color: rgba(88, 207, 250, 0.5);
            position: relative;

            /* top: 200px; */
            /* left: 500px; */
            z-index: 2;
        }
        .titlebox{
            background-color: red;
            width: 220px;
            height: 40px;
            border-radius: 20px;
            border-color: black;
            border-style: solid;
            position: relative;
            margin-bottom: 10px;
        }
        .title{
            font-family: 'Playfair Display', serif;
            
            margin: 0px 10px 10px 10px;
            text-align: center;
            font-size: 25px;
        }
        .form-control{
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            border-radius: 5px;
            border: 2px solid;
            margin: 15px 15px 15px 0px;
            padding: 4px;
            width: 205px
        }
        label{
            font-family: 'Playfair Display', serif;
            font-size: 15px;
        }
        body{
            background-image: url(img/Campus.png);
            background-size: cover;
            background-position: center;
            margin: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .buttonLogin{
            margin: 20px;
            text-align: center;
        }
        .button{
            width: 150px;
            height: 35px;
            background-color: green;
            /* border-color: green; */
            color: white;
            border-radius: 10px;
            /* box-shadow:4px 4px 15px 10px rgba(251, 251, 251, 0.756); */
            
        }
        body::before{
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(85, 84, 84, 0.5);
            z-index: 1; 
        }
    </style>
</head>
<body>
    <div class="transparentBox">
        <div class = "container">
            <div class = "titlebox">
                <div class = "title">Log-in Account</div>
            </div>
            <form action="index.php" method="post">
                <div class = "loginForm">
                    <label for="email"><b>Email Address</b></label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email address..." name="email" required>
                
                </div>
                <div class="loginForm">
                    <label for="password"><b>Password</b></label> 
                    <input type="password" class="form-control" id="password" placeholder="Enter your password..." name="password" required>
                
                </div>
                <div class="checkboxLogin">
                    <input type="checkbox" value="checkbox" id="checkbox" name="checkbox">
                    <label for="checkbox"><b>Remember me</b></label>
                </div>
                <div class="buttonLogin">
                    <input type="submit" class="button" name="login" value="Log-in"></input>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include("database/database.php");

if(isset($_POST['login'])){
    login($_POST);
}
?>