<?php
session_start();

$username = htmlspecialchars($_POST['userName'] ?? ''); 
$email = htmlspecialchars($_POST['userEmail'] ?? ''); 

$errors = [];

if(empty($username)){
$errors[] = "Имя не может быть пустым";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Некорректный email";
}

if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit();
}

$_SESSION['username'] = $username;
$_SESSION['email'] = $email;

$line = $username . ";" . $email . "\n";

file_put_contents("data.txt", $line, FILE_APPEND);

header("Location: index.php");
exit();
?>
