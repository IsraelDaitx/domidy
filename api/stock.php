<?php
/**
 * Controle de estoque
 */

function decreaseStock($pdo, $product_id, $qty, $tenant_id) {
    // Verificar estoque disponível
    $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ? AND tenant_id = ?");
    $stmt->execute([$product_id, $tenant_id]);
    $product = $stmt->fetch();

    if (!$product || $product['stock'] < $qty) {
        return false; // Sem estoque
    }

    // Baixar estoque
    $stmt = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ? AND tenant_id = ?");
    $stmt->execute([$qty, $product_id, $tenant_id]);

    return true;
}

function increaseStock($pdo, $product_id, $qty, $tenant_id) {
    $stmt = $pdo->prepare("UPDATE products SET stock = stock + ? WHERE id = ? AND tenant_id = ?");
    $stmt->execute([$qty, $product_id, $tenant_id]);
    return true;
}
?>
