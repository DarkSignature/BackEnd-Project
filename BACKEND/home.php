<?php
// echo "Hello, welcome to HOMEPAGE!<br>";
session_start();

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
    <title>Attendance List</title>
    <style>
        .button {
        display: flex;
        position: absolute;
        left: 90%;
        bottom: 90%;
        justify-content: right;
        padding: 5px 15px;
        text-decoration: none;
        background-color: red;
        color: white;
        border: 1px solid red;
        border-radius: 5px;
        cursor: pointer;
        
        }
        nav{
            display: flex;
            background-color: blue;
            height: 50px;
            padding: 20px 30px;
        }
        .welcome-text{
            margin: 5px 10px 10px 5px;
            color: white;
            font-size: 40px;
        }
        .search-bar{
            background-color: gray;
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
            background-color: rgb(32, 162, 227);
        }
        .user-list{
            margin-left: 10px;
            margin-top: 10px;
            font-size: 17px;
        }
        .th-top{
            background-color: rgba(182, 255, 143, 0.3);
        }
        .user-table{
            overflow: auto;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            border-style: solid;
        }
        .image{
            height: 70px;
            width: 70px;
        }
        .id-cell{
            width: 50px;
        }
        .photo-cell{
            width: 120px;
        }
        .name-cell{
            width: 200px;
        }
        .email-cell{
            width: 200px;
        }
        .action-cell{
            width: 300px;
        }
        td{
            text-align: center;
            vertical-align: middle;
        }
        button{
            width: 80px;
            height: 30px;
            margin: 5px;
        }
        .view{
            background-color: yellow;
            border-style: outset;
            border-color: yellow;
        }
        .edit{
            background-color: green;
            border-style: outset;
            border-color: green;
        }
        .delete{
            background-color: red;
            border-style: outset;
            border-color: red;
        }
    </style>
</head>
<body>
    <div class="content-box">
        <nav>
            <p class="welcome-text">Welcome 
            <?php 
            echo $_SESSION["username"]; 
            ?>!</p>
            <a href="index.php" class="button">Logout</a>
        </nav>
        <div class="content-body">
            <div class="search-bar">
                <p>search . . .</p>
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
                    include("database/database.php");
                    $no = 1;
                    $dataArray = getData();
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
                    . "<form action=\"detail.php\" method=\"post\">"
                    . "<button type=\"submit\" class=\"delete\" name=\"delete\" value=\"" . $row["id"] . "\">" . "<input type=\"hidden\" name=\"id\" value=\"" . $row["id"] . "\">Delete</button>" . "</form></td>";
                    echo "</tr>";
                    $no += 1;
                    }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// include("database/database.php");
// if(isset($_POST["view"])){
//     viewData($_POST["view"]);
// }
// if(isset($_POST["edit"])){
//     viewData($_POST["edit"]);
// }
// if(isset($_POST["delete"])){
//     viewData($_POST["delete"]);
// }
?>