<?php
/**
 * Webhook para receber mensagens do WhatsApp
 */

require_once 'db.php';
require_once 'ai_engine.php';

// Receber dados do WhatsApp
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    exit;
}

$phone = $data['from'] ?? '';
$message = trim($data['message'] ?? '');
$tenant_id = $data['tenant_id'] ?? 1;

if (empty($phone) || empty($message)) {
    http_response_code(400);
    exit;
}

// 1. Buscar ou criar cliente
$stmt = $pdo->prepare("SELECT id FROM clients WHERE phone = ? AND tenant_id = ?");
$stmt->execute([$phone, $tenant_id]);
$client = $stmt->fetch();

if (!$client) {
    $stmt = $pdo->prepare("INSERT INTO clients (name, phone, tenant_id) VALUES (?, ?, ?)");
    $stmt->execute(['Cliente WhatsApp', $phone, $tenant_id]);
    $client_id = $pdo->lastInsertId();
} else {
    $client_id = $client['id'];
}

// 2. Buscar ou criar conversa
$stmt = $pdo->prepare("SELECT id FROM conversations WHERE client_id = ? AND status = 'open'");
$stmt->execute([$client_id]);
$conv = $stmt->fetch();

if (!$conv) {
    $stmt = $pdo->prepare("INSERT INTO conversations (client_id, tenant_id) VALUES (?, ?)");
    $stmt->execute([$client_id, $tenant_id]);
    $conversation_id = $pdo->lastInsertId();
} else {
    $conversation_id = $conv['id'];
}

// 3. Salvar mensagem do cliente
$stmt = $pdo->prepare("INSERT INTO messages (conversation_id, sender, message, tenant_id) VALUES (?, ?, ?, ?)");
$stmt->execute([$conversation_id, 'client', $message, $tenant_id]);

// 4. Gerar resposta via IA
$response = aiResponse($message);

// 5. Salvar resposta do bot
$stmt = $pdo->prepare("INSERT INTO messages (conversation_id, sender, message, tenant_id) VALUES (?, ?, ?, ?)");
$stmt->execute([$conversation_id, 'bot', $response, $tenant_id]);

// 6. Retornar resposta
header('Content-Type: application/json');
echo json_encode(['reply' => $response]);
?>
