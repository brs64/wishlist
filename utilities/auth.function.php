<?php
session_start();
include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];

        // Redirect based on user role
        if ($user['admin'] == 1) {
            header('Location: /wishlist/pages/upload.view.php');
        } else {
            header('Location: product_list.php');
        }
        exit();
    } else {
        // Invalid credentials
        header('Location: /wishlist/pages/auth.view.php?error=invalid_credentials');
        exit();
    }
} else {
    header('Location: auth.view.php');
    exit();
}
?>
