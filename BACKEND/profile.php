<?php
session_start();
include("database/database.php");
if(isset($_POST["logout"])){
    // echo "logout";
    logout();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        body{
            background-color: midnightblue;
        }
        
        nav{
            display: flex;
            background-color: lightskyblue;
            border-color: black;
            border-radius: 20px;
            height: 50px;
            padding: 20px 30px;
        }
        .logoutButton{
        display: flex;
        position: relative;
        bottom: 130px;
        padding: 5px 15px;
        text-decoration: none;
        background-color: darkred;
        color: white;
        border: 1px solid white;
        border-radius: 5px;
        cursor: pointer;
        }
        .welcome-text{
            margin: 5px 10px 10px 5px;
            color: black;
            font-size: 40px;
        }
        .button {
        display: flex;
        position: absolute;
        left: 90%;
        bottom: 90%;
        justify-content: right;
        padding: 5px 15px;
        text-decoration: none;
        background-color: mediumslateblue;
        color: white;
        border: 1px solid white;
        border-radius: 5px;
        cursor: pointer;
        }
        .button2{
        display: flex;
        position: absolute;
        left: 1000px;
        bottom: 90%;
        justify-content: right;
        padding: 5px 15px;
        text-decoration: none;
        background-color: mediumorchid;
        color: white;
        border: 1px solid white;
        border-radius: 5px;
        cursor: pointer;
        }
        .detail-box{
            overflow: auto;
            background-color: white;
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
            width: 65%;
            height: 310px;
            margin: 10px;
            margin-top: 30px;
            padding: 10px 10px;
            border-color: black;
            border-style: inset;
            border-radius: 20px;
        }
        .content{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .userID{
            /* border-color: black;
            border-style: inset; */
            /* background-color:  rgb(209, 207, 207);; */
            display: flex;
            /* align-items: center; */
            position: relative;
            top: 10px;
            width: 35%;
            height: 150px;
            margin: 10px;
            flex-direction: column;
        }
        .userPhoto{
            /* background-color: red; */
            display: flex;
            /* align-items: center; */
            position: relative;
            top: 10px;
            width: 24%;
            height: 200px;
            margin: 10px;
            left: 270px;
        }
        .foto{
            width: 200px;
            height: 200px;
        }
        .dataID{
            position: relative;
            bottom: 15px;
        }
        .detailID{
            position: relative;
            bottom: 45px;
        }
        .dataName{
            position: relative;
            bottom:65px;
        }
        .detailName{
            position: relative;
            bottom: 80px;
        }
        .detailEmail{
            position: relative;
            bottom: 115px;
        }
        .dataEmail{
            position: relative;
            bottom: 100px;
        }
        .dataBio{
            position: relative;
            bottom: 130px;
        }
        .detailBio{
            position: relative;
            bottom: 140px;
        }
        .email{
            
        }
        .dataWithPic{
            display: flex;
            flex-direction: row;
        }
        .userID p{
            position: relative;
            left: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <p class="welcome-text">Showing 
            <?php 
            // echo $_POST["view"];
            echo $_SESSION["first_name"] . "'s Profile"; 
            ?>!</p>
            <a href="profile.php" class="button">Profile</a>
            <a href="home.php" class="button2">Dashboard</a>
        </nav>
        <div class="content">
           
            <div class="detail-box"> 
                <div class="dataWithPic">
                    <div class="userID">
                        <p class="dataID"><b>User ID</b></p>
                        <p class="detailID"><?php 
                        echo $_SESSION["id"];
                        ?></p>
                        <div class="name">
                            <p class="dataName"><b>Full Name</b></p>
                            <p class="detailName"><?php
                            echo $_SESSION["first_name"] . " " . $_SESSION["last_name"];
                            ?></p>
                        </div>
                        <div class="email">
                            <p class="dataEmail"><b>Email</b></p>
                            <p class="detailEmail"><?php 
                            echo $_SESSION["email"];
                            ?></p>
                        </div>
                        <div class="bio">
                            <p class="dataBio"><b>Bio:</b></p>
                            <div class="bioText">
                            <p class="detailBio"><?php 
                            echo $_SESSION["bio"];
                            ?></p>
                        </div>
                        <div class="logout">
                            <form action="profile.php" method="post">
                                <input type="submit" name="logout" value="Logout" class="logoutButton"></input>
                            </form>
                        </div>
                        </div>
                    </div>
                <div class="userPhoto">
                    <!-- <img class="foto" src="img/" alt="Photo"> -->
                </div>
        </div>
                
                
            </div>
        </div>
    </div>
</body>
</html>