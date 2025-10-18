<?php

class Carro
{
    private string $marca;
    private string $modelo;
    private int $ano;

    public function __construct(string $marca, string $modelo, int $ano)
    {
        $this->alterarMarca($marca);
        $this->alterarModelo($modelo);
        $this->alterarAno($ano);
    }

    public function marca(): string
    {
        return $this->marca;
    }

    public function modelo(): string
    {
        return $this->modelo;
    }

    public function ano(): int
    {
        return $this->ano;
    }

    public function alterarMarca(string $novaMarca): void
    {
        $marcaTrimmed = trim($novaMarca);
        if (empty($marcaTrimmed)) {
            throw new InvalidArgumentException("A marca não pode ser vazia.");
        }
        $this->marca = $marcaTrimmed;
    }

    public function alterarModelo(string $novoModelo): void
    {
        $modeloTrimmed = trim($novoModelo);
        if (empty($modeloTrimmed)) {
            throw new InvalidArgumentException("O modelo não pode ser vazio.");
        }
        $this->modelo = $modeloTrimmed;
    }

    public function alterarAno(int $novoAno): void
    {
        $anoAtual = (int)date('Y');
        if ($novoAno < 1886 || $novoAno > $anoAtual) {
            throw new InvalidArgumentException("Ano inválido. Deve ser entre 1886 e o ano atual ($anoAtual).");
        }
        $this->ano = $novoAno;
    }
}