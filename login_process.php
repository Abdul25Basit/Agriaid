<?php
session_start();
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Validate inputs
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Please fill in all fields");
        exit();
    }
    
    // Check user in database
    $stmt = $conn->prepare("SELECT id, password, first_name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'];
            
            // Set remember me cookie if checked
            if (isset($_POST['remember'])) {
                $cookie_value = $user['id'] . ':' . hash('sha256', $user['password']);
                setcookie('remember_me', $cookie_value, time() + (86400 * 30), "/"); // 30 days
            }
            
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=Invalid email or password");
            exit();
        }
    } else {
        header("Location: login.php?error=Invalid email or password");
        exit();
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
?>