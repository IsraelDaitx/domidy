<?php
/**
 * Motor de IA básica para respostas automáticas
 */

function aiResponse($message) {
    $msg = strtolower(trim($message));

    // Menu principal
    if (in_array($msg, ['oi', 'olá', 'ola', 'opa', 'e aí', 'eae', 'menu'])) {
        return "👋 *Bem-vindo ao Domidy!*\n\n" .
               "Escolha uma opção:\n\n" .
               "1️⃣ Ofertas do dia\n" .
               "2️⃣ Fazer pedido\n" .
               "3️⃣ Pagamento Pix\n" .
               "4️⃣ Localização\n" .
               "5️⃣ Falar com atendente\n\n" .
               "Responda com o número.";
    }

    // Opção 1 - Ofertas
    if ($msg == '1' || strpos($msg, 'oferta') !== false) {
        return "🔥 *OFERTAS DO DIA*\n\nConsulte nosso catálogo: https://bit.ly/ofertas-domidy\n\nPromoções válidas até o fim do estoque!";
    }

    // Opção 2 - Pedido
    if ($msg == '2' || strpos($msg, 'pedido') !== false) {
        return "📦 *FAZER PEDIDO*\n\nEnvie:\n- Produtos\n- Quantidades\n\nExemplo: Arroz 2, Feijão 1";
    }

    // Opção 3 - Pix
    if ($msg == '3' || strpos($msg, 'pix') !== false || strpos($msg, 'pagamento') !== false) {
        return "💳 *PAGAMENTO PIX*\n\nChaves disponíveis:\nCNPJ: 27850670000153\nEmail: vendas@domidy.com\n\nApós pagamento, envie o comprovante.";
    }

    // Opção 4 - Localização
    if ($msg == '4' || strpos($msg, 'endereço') !== false || strpos($msg, 'local') !== false) {
        return "📍 *LOCALIZAÇÃO*\n\nRua Domidy, 844 - Gravataí/RS\n\n🕐 Segunda a Sexta: 07h30 às 19h\n🕐 Sábado: 07h30 às 18h";
    }

    // Opção 5 - Atendente
    if ($msg == '5' || strpos($msg, 'atendente') !== false || strpos($msg, 'humano') !== false) {
        return "👩‍💼 *ATENDENTE HUMANO*\n\nUm atendente irá te responder em instantes ⏳\n\nAtendimento em horário comercial.";
    }

    // Preço
    if (strpos($msg, 'preço') !== false || strpos($msg, 'valor') !== false) {
        return "💰 Qual produto você deseja consultar o preço?";
    }

    // Padrão
    return "🤖 Não entendi bem... 🤔\n\nDigite MENU para ver opções ou fale com um atendente.";
}
?>
