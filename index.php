<?php
session_start();
require 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domidy SaaS - Sistema de Vendas WhatsApp</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 600px;
        }
        h1 { color: #333; margin: 0 0 10px 0; }
        p { color: #666; font-size: 16px; }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            margin: 10px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover { background: #764ba2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Domidy SaaS</h1>
        <p>Sistema de vendas por WhatsApp + CRM + ERP Multi-loja</p>
        
        <?php if (isset($_SESSION['tenant_id'])): ?>
            <p>Bem-vindo! 👋</p>
            <a href="public/dashboard.php" class="btn">📊 Ir para Dashboard</a>
            <a href="saas/logout.php" class="btn">🚪 Sair</a>
        <?php else: ?>
            <p>Plataforma completa para gerenciar suas vendas online</p>
            <a href="saas/login.php" class="btn">🔐 Entrar no painel</a>
            <a href="saas/register.php" class="btn">📝 Criar conta</a>
        <?php endif; ?>
    </div>
</body>
</html>
