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
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$input["email"]]);
    $user = $stmt->fetch();
    $md5input = md5($input["password"]);
    if($user["role"] == "Admin"){
    if($md5input == $user["password"]){
        if(isset($input["checkbox"])){
            setcookie("email", $input["email"], time() + (60 * 60 * 3), '/');
            setcookie("password", $input["password"], time() + (60 * 60 * 3), '/');
            // echo "Finished!";
        }
        $_SESSION["first_name"] = $user["first_name"];
        $_SESSION["last_name"] = $user["last_name"];
        $_SESSION["id"] = $user["id"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["bio"] = $user["bio"];
        header("Location: home.php");
    }
    else{
        // echo $input["password"] . "<br>";
        // echo $user["password"] . "<br>";
        // $hash = md5("admin123");
        // echo $hash . "<br>";
        echo "Couldn't login";
    }
    }
    else{
        echo "Only admins can login here!";
    }
    closeConnection();
}

function getData(){
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    closeConnection();
    return $result;
}
function getSelectedData($data){
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM users where first_name = ? OR email = ? OR last_name = ?");
    $stmt->execute([$data["first_name"], $data["first_name"], $data["first_name"]]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    closeConnection();
    return $result;
}
function getSelectedData2($data){
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM users where (first_name = ? AND last_name = ?)");
    $stmt->execute([$data["first_name"], $data["last_name"]]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    closeConnection();
    return $result;
}

function viewData($id){
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
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


function updateData($updatedData, $curID){
    $conn = connectToDB();
    $stmt = $conn->prepare("UPDATE users SET id = ?, Photo = ?, first_name = ?, last_name = ?, email = ?, bio = ? WHERE id = ?");
    $stmt->execute([
        $updatedData["id"],
        $updatedData["Photo"],
        $updatedData["first_name"],
        $updatedData["last_name"],
        $updatedData["email"],
        $updatedData["bio"],
        $curID
        
    ]);
    // echo $updatedData["id"] .
    // $updatedData["Photo"] .
    // $updatedData["first_name"] .
    // $updatedData["last_name"] .
    // $updatedData["email"] .
    // $updatedData["bio"];
    closeConnection();
    header("Location: home.php");
}

function deleteData($id){
    $conn = connectToDB();
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    closeConnection();
}
function createData($newUser){
    $conn = connectToDB();
    $stmt = $conn->prepare("INSERT INTO users (id, first_name, last_name, email, bio, `role`) VALUES (?, ?, ?, ?, ?, 'User')");
    $stmt->execute([$newUser["id"], $newUser["first_name"], $newUser["last_name"], $newUser["email"], $newUser["bio"]]);
    closeConnection();
    header("Location: home.php");
}
function logout(){
    if(isset($_COOKIE['email'])){
        unset($_COOKIE);
        setcookie('email', '', time() - 10800, '/');
        setcookie('password', '', time() - 10800, '/');
    }
    session_destroy();
    header("Location: index.php");
}
?>