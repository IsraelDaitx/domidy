<?php
session_start();
require_once '../api/db.php';
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if ($password !== $password_confirm) {
        $_SESSION['error'] = 'Senhas não correspondem';
        header('Location: register.php');
        exit;
    }

    // Criar tenant (loja)
    $stmt = $pdo->prepare("INSERT INTO tenants (name) VALUES (?)");
    $stmt->execute([$name]);
    $tenant_id = $pdo->lastInsertId();

    // Criar usuário
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("
        INSERT INTO users (name, email, password, tenant_id, role, active)
        VALUES (?, ?, ?, ?, 'admin', 1)
    ");

    if ($stmt->execute([$name, $email, $hashed_password, $tenant_id])) {
        $_SESSION['success'] = 'Conta criada com sucesso! Faça login.';
        header('Location: login.php');
    } else {
        $_SESSION['error'] = 'Erro ao criar conta';
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar - Domidy SaaS</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #764ba2; }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>📝 Criar Conta</h2>
        
        <form method="POST">
            <div class="form-group">
                <label>Nome da loja</label>
                <input type="text" name="name" placeholder="Seu negócio" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" placeholder="Mínimo 6 caracteres" required>
            </div>

            <div class="form-group">
                <label>Confirmar senha</label>
                <input type="password" name="password_confirm" placeholder="Repita a senha" required>
            </div>

            <button type="submit">Criar Conta</button>
        </form>

        <div class="links">
            <p>Já tem conta? <a href="login.php">Fazer login</a></p>
        </div>
    </div>
</body>
</html>
