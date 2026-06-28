<?php
/**
 * Sistema de notificações
 */

function notify($pdo, $type, $title, $message, $tenant_id) {
    $stmt = $pdo->prepare("
        INSERT INTO notifications (type, title, message, tenant_id, read_at)
        VALUES (?, ?, ?, ?, NULL)
    ");

    return $stmt->execute([$type, $title, $message, $tenant_id]);
}

function notifyWhatsApp($phone, $message) {
    // TODO: Integrar com API WhatsApp real
    // Exemplo: Z-API, Twilio, 360dialog, etc
    return true;
}
?>
