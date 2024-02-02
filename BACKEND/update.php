<?php
session_start();
$detail = [];
include("database/database.php");
if (isset($_POST["submit"])){
    $curID = $_POST["curID"];
    $detail["id"] = $_POST["id"];
    $spacePosition = strpos($_POST["name"], ' ');

    if($spacePosition !== false){
    $detail["first_name"] = substr($_POST["name"], 0, $spacePosition);
    $detail["last_name"] =  substr($_POST["name"], $spacePosition + 1);
    }
    else{
        $detail["first_name"] = $_POST["name"];
        $detail["last_name"] = '';
    }
    // $detail["first_name"] = strstr($_POST["name"], ' ', true);
    // $detail["last_name"] = strstr($_POST["name"], ' ', false);
    // $cutLastName = explode(' ', $detail["last_name"], 1);
    // $detail["last_name"] = $cutLastName;
    $detail["email"] = $_POST["email"];
    $detail["bio"] = $_POST["bio"];
    $detail["Photo"] = $_POST["photo"];
    if(empty($detail["id"]) ||empty($detail["first_name"]) ||empty($detail["email"])){
        echo "Please fill any empty forms other than bio...";
    }
    else{
        updateData($detail, $curID);
    }
    // echo $detail["first_name"];
}
else{
    if(isset($_POST["edit"])){
        $id = $_POST["edit"];
        $detail = viewData($id);
        // echo $detail["email"] . " " . $detail["Photo"];
    }
}
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
            width: 25%;
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
            bottom: 5px;
        }
        .detailID{
            position: relative;
            bottom: 5px;
            width: 200px;
        }
        .dataName{
            position: relative;
            bottom: 0px;
        }
        .detailName{
            position: relative;
            bottom: 0px;
            width: 200px;
        }
        .detailEmail{
            position: relative;
            top: 5px;
            width: 200px;
        }
        .dataEmail{
            position: relative;
            top: 5px;
        }
        .dataBio{
            position: relative;
            top: 10px;
        }
        .detailBio{
            position: relative;
            top: 10px;
            width: 300px;
            height: 100px;
            box-sizing: border-box;
            /* padding: 10px; */
        }
        .detailBio input{
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            margin; 0;
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
        .content{
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .update{
            background-color: lightgreen;
            height: 40px;
            border-radius: 10px;
            color: black;
            font-weight: bold;
        }
    </style>
    <script>
        function confirmUpdate(){
            var confirmation = confirm("Are you sure you want to apply changes?");
            return confirmation;
        }
    </script>
</head>
<body>
    <div class="container">
        <nav>
            <p class="welcome-text">Showing 
            <?php 
            // include("database/database.php");
            // $detail = [];
            // // echo $_POST["update"];
            // if(isset($_POST["edit"])){
            //     $id = $_POST["edit"];
            //     $detail = viewData($id);
            // }
            echo $detail["first_name"] . "'s Information"; 
            ?>!</p>
            <a href="profile.php" class="button">Profile</a>
            <a href="home.php" class="button2">Dashboard</a>
        </nav>
        <div class="content">
           
            <div class="detail-box"> 
                <div class="dataWithPic">
                    <div class="userID">
                        <form action="update.php" method="post" onsubmit="return confirmUpdate()" required>
                        <label class="dataID" for="id"><b>User ID</b></label>
                        <input type="text" name="id" class="detailID" value="<?php 
                        echo $detail["id"];
                        ?>" required></input>
                        <div class="name">
                            <label class="dataName" for="name"><b>Full Name</b></label>
                            <input type="text" name="name" class="detailName" value="<?php
                            echo $detail["first_name"] . " " . $detail["last_name"];
                            ?>" required></input>
                        </div>
                        <div class="email">
                            <label class="dataEmail" for="email"><b>Email</b></label>
                            <input type="email" name="email" class="detailEmail" value="<?php 
                            echo $detail["email"];
                            ?>" required></input>
                        </div>
                        <div class="bio">
                            <label class="dataBio" for="bio"><b>Bio:</b></label>
                            <div class="bioText">
                            <textarea rows="4" column="30" name="bio" class="detailBio"><?php 
                            echo $detail["bio"];
                            ?></textarea>
                        </div>
                        </div>
                    </div>
                <div class="userPhoto">
                    <img class="foto" src="img/<?php echo $detail["Photo"]; ?>" alt="Photo">
                    <input type="hidden" name="photo" value="<?php echo $detail["Photo"]; ?>"></input>
                    <input type="hidden" name="curID" value="<?php echo $detail["id"]; ?>"></input>
                </div>
        </div>
                
                
            </div>
            <input type="submit" value="Apply Changes" name="submit" class="update"></input>
            </form>
        </div>
    </div>
</body>
</html>

<?php
// if (isset($_POST["submit"])){
//     $detail["id"] = $_POST["id"];
//     $detail["first_name"] = strstr($_POST["name"], ' ', true);
//     $detail["last_name"] = strstr($_POST["name"], ' ', false);
//     $detail["email"] = $_POST["email"];
//     $detail["bio"] = $_POST["bio"];
    // echo $detail["id"] . $detail["first_name"] . $detail["last_name"] . $detail["email"] . $detail["bio"];


    // updateData($_POST);
    // echo "success";
// }
// else{
//     echo "error";
// }

?>