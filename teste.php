<?php

require_once __DIR__ . '/../src/Carro.php';

echo "--- Testes da Classe Carro ---\n\n";

try {
    echo "1. Criando um carro válido (Fiat Uno 2015)...\n";
    $meuCarro = new Carro('Fiat', 'Uno', 2015);
    echo "Carro criado com sucesso: " . $meuCarro->marca() . " " . $meuCarro->modelo() . " (" . $meuCarro->ano() . ")\n\n";

    echo "2. Alterando o modelo para 'Mobi'...\n";
    $meuCarro->alterarModelo('Mobi');
    echo "Modelo alterado com sucesso para: " . $meuCarro->modelo() . "\n\n";

    echo "3. Tentando alterar o ano para um ano futuro (2030)...\n";
    try {
        $meuCarro->alterarAno(2030);
    } catch (InvalidArgumentException $e) {
        echo "Exceção capturada como esperado: " . $e->getMessage() . "\n\n";
    }

    echo "4. Tentando criar um carro com marca vazia...\n";
    try {
        new Carro('   ', 'Fusca', 1970);
    } catch (InvalidArgumentException $e) {
        echo "Exceção capturada como esperado: " . $e->getMessage() . "\n\n";
    }

} catch (Exception $e) {
    echo "Um erro inesperado ocorreu: " . $e->getMessage() . "\n";
}