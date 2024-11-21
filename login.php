<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            echo 'Login successful. Welcome, ' . $user['name'];
        } else {
            echo 'Invalid email or password.';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
