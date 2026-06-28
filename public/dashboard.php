<?php
session_start();
require_once '../api/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../saas/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Domidy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 { color: #333; }
        .links a {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .links a:hover { background: #764ba2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Dashboard</h1>
        <p>Bem-vindo ao Domidy!</p>
        
        <div class="links">
            <a href="clients.php">👥 Clientes</a>
            <a href="finance.php">💰 Financeiro</a>
            <a href="../saas/logout.php">🚪 Sair</a>
        </div>
    </div>
</body>
</html>
