<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $confirm_pwd = $_POST["confirm_pwd"];

    if ($confirm_pwd !== $pwd) {
        header("Location: ../register.php?error=password_mismatch");
        exit();
    } else {
        try {
            require_once("dbh.inc.php");
            $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
    
            $stmt = $conn->prepare($query);
    
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":pwd", $pwd);
            $stmt->bindParam(":email", $email);
    
            $stmt->execute();
    
            $conn = null;
            $stmt = null;
            header("Location: ../index.html");
            exit();
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
} else { 
    header("Location: ../index.html");
    exit();
}
?>
