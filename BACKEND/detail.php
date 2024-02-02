<?php
session_start();
// include("database/database.php");
// if(isset($_POST["view"])){
//     $id = $_POST["view"];
//     $detail = viewData($id);
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: midnightblue;
        }
        nav{
            display: flex;
            background-color: lightskyblue;
            font-family:'Catamaran', serif;
            border-color: black;
            border-radius: 20px;
            height: 50px;
            padding: 20px 30px;
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
        left: 1050px;
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
            include("database/database.php");
            $detail = [];
            // echo $_POST["view"];
            if(isset($_POST["view"])){
                $id = $_POST["view"];
                $detail = viewData($id);
            }
            echo $detail["first_name"] . "'s Information"; 
            ?>!</p>
            <a href="index.php" class="button">Logout</a>
            <a href="home.php" class="button2">Home</a>
        </nav>
        <div class="content">
           
            <div class="detail-box"> 
                <div class="dataWithPic">
                    <div class="userID">
                        <p class="dataID"><b>User ID</b></p>
                        <p class="detailID"><?php 
                        echo $detail["id"];
                        ?></p>
                        <div class="name">
                            <p class="dataName"><b>Full Name</b></p>
                            <p class="detailName"><?php
                            echo $detail["first_name"] . " " . $detail["last_name"];
                            ?></p>
                        </div>
                        <div class="email">
                            <p class="dataEmail"><b>Email</b></p>
                            <p class="detailEmail"><?php 
                            echo $detail["email"];
                            ?></p>
                        </div>
                        <div class="bio">
                            <p class="dataBio"><b>Bio:</b></p>
                            <div class="bioText">
                            <p class="detailBio"><?php 
                            echo $detail["bio"];
                            ?></p>
                        </div>
                        </div>
                    </div>
                <div class="userPhoto">
                    <img class="foto" src="img/<?php echo $detail["Photo"]; ?>" alt="Photo">
                </div>
        </div>
                
                
            </div>
        </div>
    </div>
</body>
</html>