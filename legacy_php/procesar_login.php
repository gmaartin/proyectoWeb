<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Aquí deberías validar el usuario y la contraseña contra tu base de datos
    // Por simplicidad, vamos a asumir que el usuario es "admin" y la contraseña es "password"
    if ($username === "admin" && $password === "password") {
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>