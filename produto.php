<?php

class Produto
{
    private string $nome;
    private float $preco;
    private int $estoque;

    public function __construct(string $nome, float $preco, int $estoqueInicial = 0)
    {
        if (empty(trim($nome))) {
            throw new InvalidArgumentException("O nome do produto não pode ser vazio.");
        }
        $this->nome = trim($nome);
        $this->atualizarPreco($preco);
        
        if ($estoqueInicial < 0) {
            throw new InvalidArgumentException("O estoque inicial não pode ser negativo.");
        }
        $this->estoque = $estoqueInicial;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function preco(): float
    {
        return $this->preco;
    }

    public function estoque(): int
    {
        return $this->estoque;
    }

    public function atualizarPreco(float $novoPreco): void
    {
        if ($novoPreco < 0) {
            throw new InvalidArgumentException("O preço não pode ser negativo.");
        }
        $this->preco = round($novoPreco, 2);
    }
    
    public function repor(int $qtd): void
    {
        if ($qtd <= 0) {
            throw new InvalidArgumentException("A quantidade para reposição deve ser maior que zero.");
        }
        $this->estoque += $qtd;
    }
    
    public function vender(int $qtd): void
    {
        if ($qtd <= 0) {
            throw new InvalidArgumentException("A quantidade para venda deve ser maior que zero.");
        }
        if ($qtd > $this->estoque) {
            throw new RuntimeException("Estoque insuficiente para vender {$qtd} unidades de {$this->nome}.");
        }
        $this->estoque -= $qtd;
    }
}