<?php
// echo "Hello, welcome to HOMEPAGE!<br>";
session_start();
include("database/database.php");
if(isset($_POST["delete"])){
    deleteData($_POST["delete"]);
}
if(isset($_POST["search"])){

}
else{
    $dataArray = getData();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="img/bracer.jpg">
    <title>Dashboard</title>
    <style>
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
        nav{
            display: flex;
            background-color: lightskyblue;
            border-color: black;
            border-radius: 20px;
            height: 50px;
            padding: 20px 30px;
            font-family: 'Catamaran', serif;
        }
        .welcome-text{
            margin: 5px 10px 10px 5px;
            color: black;
            font-family: 'Catamaran', serif;
            font-size: 40px;
        }
        .search-bar{
            background-color: white;
            font-family: 'Catamaran', serif;
            display: flex;
            width: 80%;
            height: 20px;
            margin: 10px;
            margin-top: 40px;
            padding: 10px 10px;
            align-items: center;
            border-color: black;
            border-style: inset;
        }
        .content-body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .attendList{
            background-color: white;
            display: flex;
            flex-direction: column;
            width: 80%;
            height: 270px;
            margin: 10px;
            margin-top: 10px;
            padding: 10px 10px;
            border-color: black;
            border-style: inset;
            border-radius: 20px;
        }
        body{
            background-color: midnightblue;
        }
        .user-list{
            margin-left: 10px;
            margin-top: 10px;
            font-size: 17px;
        }
        .th-top{
            background-color: mediumaquamarine;
        }
        .user-table{
            overflow: auto;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            border-style: solid;
            font-family: 'Catamaran', serif;
        }
        .image{
            height: 70px;
            width: 70px;
        }
        .id-cell{
            width: 50px;
            font-family: 'Catamaran', serif;
        }
        .photo-cell{
            width: 120px;
            font-family: 'Catamaran', serif;
        }
        .name-cell{
            width: 200px;
            font-family: 'Catamaran', serif;
        }
        .email-cell{
            width: 200px;
            font-family: 'Catamaran', serif;
        }
        .action-cell{
            width: 300px;
            font-family: 'Catamaran', serif;
        }
        td{
            text-align: center;
            vertical-align: middle;
            font-family: 'Catamaran', serif;
        }
        button{
            width: 80px;
            height: 30px;
            margin: 5px;
        }
        .view{
            background-color: orange;
            border-style: outset;
            border-color: black;
        }
        .edit{
            background-color: olivedrab;
            border-style: outset;
            border-color: black;
        }
        .delete{
            background-color: indianred;
            border-style: outset;
            border-color: black;
        }
        .createButton{
            background-color: mediumaquamarine;
            height: 40px;
            border-radius: 10px;
            color: black;
            font-weight: bold;
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
        .searchInput{
            background-color: gray;
            width: 800px;
            margin: 10px;
        }
        .searchInput::placeholder{
            color: white;
        }
        .searchBut{
            background-color: white;
            margin: 18px;
        }
        .resetBut{
            background-color: white;
        }
    </style>
    <script>
        function confirmDelete(){
            var confirmation = confirm("Are you sure you want to delete user?");
            return confirmation;
        }
    </script>
</head>
<body>
    <div class="content-box">
        <nav>
            <p class="welcome-text">Welcome 
            <?php 
            echo $_SESSION["first_name"]; 
            ?>!</p>
            <a href="profile.php" class="button">Profile</a>
            <a href="home.php" class="button2">Dashboard</a>
        </nav>
        <div class="content-body">
            <div class="search-bar">
                <form action="home.php" method="post">
                    <input type="text" name="dataSearch" class="searchInput" placeholder="Search name or email here..."></input>
                    <input type="submit" name="search" value="Search" class="searchBut"></input>
                    <input type="reset" name="reset" value="Reset" class="resetBut"></input>
                </form>
            </div>
            <div class="attendList">
                <p class="user-list"><b>User List</b></p>
                <table border=2 cellspacing=1 cellpadding=7 class="user-table">
                    <tr>
                        <th class="th-top">No</th>
                        <th class="th-top">Photo</th>
                        <th class="th-top">Full Name</th>
                        <th class="th-top">Email</th>
                        <th class="th-top">Action</th>
                    </tr>
                    <?php
                    // include("database/database.php");
                    $no = 1;
                    // $dataArray = getData();
                    foreach ($dataArray as $row) {
                    if($row["role"] != "Admin"){
                    echo "<tr>";
                    echo "<td class=\"id-cell\">" . $no . "</td>";
                    echo "<td class=\"photo-cell\">" . "<img class=\"image\" src=\"img/" . $row["Photo"] . "\" alt=\"Can't load...\">" . "</td>";
                    echo "<td class=\"name-cell\">" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                    echo "<td class=\"email-cell\">" . $row["email"] . "</td>";
                    echo "<td class=\"action-cell\">" 
                    . "<form action=\"detail.php\" method=\"post\">"
                    . "<button type=\"submit\" class=\"view\" name=\"view\" value=\"" . $row["id"] . "\">" . "<input type=\"hidden\" name=\"id\" value=\"" . $row["id"] . "\">View</button></form>"
                    . "<form action=\"update.php\" method=\"post\">"
                    . "<button type=\"submit\" class=\"edit\" name=\"edit\" value=\"" . $row["id"] . "\">" . "<input type=\"hidden\" name=\"id\" value=\"" . $row["id"] . "\">Edit</button></form>"
                    . "<form action=\"home.php\" method=\"post\" onsubmit=\"return confirmDelete()\">"
                    . "<button type=\"submit\" class=\"delete\" name=\"delete\" value=\"" . $row["id"] . "\">" . "<input type=\"hidden\" name=\"id\" value=\"" . $row["id"] . "\">Delete</button>" . "</form></td>";
                    echo "</tr>";
                    $no += 1;
                    }
                    }
                    ?>
                </table>
            </div>
            <div class="create">
                <form method="get" action="create.php">
                    <input type=submit class="createButton" name="create" value="New User"></input>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php

// if(isset($_GET["create"])){
//     viewData($_POST["view"]);
// }
// if(isset($_POST["edit"])){
//     viewData($_POST["edit"]);
// }
// if(isset($_POST["delete"])){
//     viewData($_POST["delete"]);
// }
?>