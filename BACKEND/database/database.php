<?php
$stmt = "";
$conn = "";

function connectToDB(){
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "attendancedb";
    $db_SourceName = "mysql:host=" . $db_server . ";dbname=" . $db_name;
    try{
        $conn = new PDO($db_SourceName, $db_user, $db_pass);
        return $conn;
    }
    catch(PDOException $e) {
        echo "Can't connect to database!<br>";
    }
    
   
}

function closeConnection(){
    $conn = NULL;
    $stmt = NULL;
}

function login($input){
    $conn = connectToDB(); 
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$input["email"]]);
    $user = $stmt->fetch();
    $md5input = md5($input["password"]);
    if($md5input == $user["password"]){
        if(isset($input["checkbox"])){
            setcookie("email", $input["email"], time() + (60 * 60 * 24), '/');
            echo "Finished!";
        }
        $_SESSION["username"] = $user["first_name"];
        header("Location: home.php");
    }
    else{
        // echo $input["password"] . "<br>";
        // echo $user["password"] . "<br>";
        // $hash = md5("admin123");
        // echo $hash . "<br>";
        echo "Couldn't login";
    }
    closeConnection();
}

function getData(){
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM user");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    closeConnection();
    return $result;
}

function viewData($id){
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    $selectedUser = $stmt->fetch();
    // foreach($selectedUser as $data){
    //     echo $data["id"] . "<br>";
    //     echo $data["email"] . "<br>";
    //     echo $data["first_name"] . "<br>";
    // }

    closeConnection();
    return $selectedUser;
}
?>