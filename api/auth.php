<?php
/**
 * Autenticação do sistema
 */

session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Email e senha são obrigatórios';
        header('Location: ../saas/login.php');
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND active = 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['tenant_id'] = $user['tenant_id'];
        $_SESSION['role'] = $user['role'];

        header('Location: ../public/dashboard.php');
    } else {
        $_SESSION['error'] = 'Email ou senha incorretos';
        header('Location: ../saas/login.php');
    }
    exit;
}
?>
