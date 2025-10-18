<?php

require_once __DIR__ . '/Produto.php';

class Pedido
{
    private string $numeroPedido;
    private array $itens = [];
    private float $valorTotal = 0.0;

    public function __construct(string $numeroPedido)
    {
        if (empty(trim($numeroPedido))) {
            throw new InvalidArgumentException("O número do pedido não pode ser vazio.");
        }
        $this->numeroPedido = trim($numeroPedido);
    }

    public function numeroPedido(): string
    {
        return $this->numeroPedido;
    }
    
    public function valorTotal(): float
    {
        return $this->valorTotal;
    }

    public function itens(): array
    {
        return $this->itens;
    }

    public function adicionarItem(Produto $produto, int $qtd): void
    {
        if ($qtd <= 0) {
            throw new InvalidArgumentException("A quantidade deve ser maior que zero.");
        }
        
        $produto->vender($qtd);

        $nomeProduto = $produto->nome();
        if (isset($this->itens[$nomeProduto])) {
            $this->itens[$nomeProduto]['qtd'] += $qtd;
            $this->itens[$nomeProduto]['subtotal'] += $produto->preco() * $qtd;
        } else {
            $this->itens[$nomeProduto] = [
                'produto' => $produto,
                'qtd' => $qtd,
                'subtotal' => $produto->preco() * $qtd
            ];
        }

        $this->recalcularValorTotal();
    }

    public function removerItem(string $nomeProduto): void
    {
        if (!isset($this->itens[$nomeProduto])) {
            throw new InvalidArgumentException("Produto '{$nomeProduto}' não encontrado no pedido.");
        }

        $itemRemovido = $this->itens[$nomeProduto];
        $produto = $itemRemovido['produto'];
        $qtd = $itemRemovido['qtd'];
        
        $produto->repor($qtd);
        
        unset($this->itens[$nomeProduto]);
        
        $this->recalcularValorTotal();
    }
    
    private function recalcularValorTotal(): void
    {
        $this->valorTotal = 0.0;
        foreach ($this->itens as $item) {
            $this->valorTotal += $item['subtotal'];
        }
    }
    
    public function exibirResumo(): string
    {
        $resumo = "Pedido: " . $this->numeroPedido . "\n";
        $resumo .= "-----------------------------------\n";
        if (empty($this->itens)) {
            $resumo .= "Nenhum item no pedido.\n";
        } else {
            foreach ($this->itens as $item) {
                $subtotalFormatado = number_format($item['subtotal'], 2, ',', '.');
                $resumo .= "- {$item['produto']->nome()}: {$item['qtd']} un. | Subtotal: R$ {$subtotalFormatado}\n";
            }
        }
        $resumo .= "-----------------------------------\n";
        $totalFormatado = number_format($this->valorTotal, 2, ',', '.');
        $resumo .= "VALOR TOTAL: R$ " . $totalFormatado . "\n";
        
        return $resumo;
    }
}