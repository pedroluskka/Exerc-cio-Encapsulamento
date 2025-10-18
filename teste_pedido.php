<?php

require_once __DIR__ . '/../src/Produto.php';
require_once __DIR__ . '/../src/Pedido.php';

echo "--- Testes do Mini E-commerce (Produto + Pedido) ---\n\n";

try {
    $teclado = new Produto('Teclado Mecânico', 120.00, 10);
    $mouse = new Produto('Mouse Gamer', 85.50, 5);
    echo "Produtos iniciais criados:\n";
    echo "- {$teclado->nome()}: Estoque {$teclado->estoque()}, Preço R$ {$teclado->preco()}\n";
    echo "- {$mouse->nome()}: Estoque {$mouse->estoque()}, Preço R$ {$mouse->preco()}\n\n";

    $pedido = new Pedido('P-001');

    echo "1. Adicionando 2 teclados ao pedido...\n";
    $pedido->adicionarItem($teclado, 2);
    echo "Item adicionado. Estoque do teclado agora é: " . $teclado->estoque() . "\n";
    echo "Valor total do pedido: R$ " . $pedido->valorTotal() . "\n\n";

    echo $pedido->exibirResumo() . "\n";

    echo "2. Tentando adicionar 50 teclados (estoque insuficiente)...\n";
    try {
        $pedido->adicionarItem($teclado, 50);
    } catch (RuntimeException $e) {
        echo "Exceção capturada como esperado: " . $e->getMessage() . "\n";
        echo "Estoque do teclado permaneceu: " . $teclado->estoque() . "\n";
        echo "Valor total do pedido permaneceu: R$ " . $pedido->valorTotal() . "\n\n";
    }

    echo "3. Removendo 'Teclado Mecânico' do pedido...\n";
    $pedido->removerItem('Teclado Mecânico');
    echo "Item removido.\n";
    echo "Estoque do teclado foi reposto para: " . $teclado->estoque() . "\n";
    echo "Valor total do pedido agora é: R$ " . $pedido->valorTotal() . "\n\n";
    
    echo $pedido->exibirResumo() . "\n";

    echo "4. Atualizando preço do teclado para R$ 150.00 e adicionando 1 unidade...\n";
    $teclado->atualizarPreco(150.00);
    $pedido->adicionarItem($teclado, 1);
    echo "Item adicionado com novo preço.\n";
    echo "Estoque do teclado agora é: " . $teclado->estoque() . "\n";
    echo "Valor total do pedido agora é: R$ " . $pedido->valorTotal() . "\n\n";

    echo $pedido->exibirResumo();

} catch (Exception $e) {
    echo "\n!!! UM ERRO INESPERADO OCORREU: " . $e->getMessage() . "\n";
}