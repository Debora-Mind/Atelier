<?php

namespace Dam\Atelier\Model\Funcoes;

class Paginacao
{
    private $itens;
    private mixed $itensPorPagina;

    public function __construct($itens, $itensPorPagina = 10)
    {
        $this->itens = $itens;
        $this->itensPorPagina = $itensPorPagina;
    }

    function paginate(): array
    {
        $totalItems = count($this->itens);
        $totalPaginas = ceil($totalItems / $this->itensPorPagina);
        $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $primeiroItem = ($paginaAtual - 1) * $this->itensPorPagina;
        $itemsPaginados = array_slice($this->itens, $primeiroItem, $this->itensPorPagina);

        return [
            'itens' => $itemsPaginados,
            'totalPaginas' => $totalPaginas,
            'paginaAtual' => $paginaAtual,
        ];
    }
    public function getTotalItens(): int
    {
        return count($this->itens);
    }

    public function getTotalItensPagina(): int
    {
        return count($this->paginate()['itens']);
    }

    public function getValorTotalEntrada(): float
    {
        $totalEntrada = 0;

        foreach ($this->itens as $item) {
            $totalEntrada += $item->getModelo()->getValorEntrada() * $item->getQuantidade();
        }

        return $totalEntrada;
    }

    public function getValorTotalSaida(): float
    {
        $totalSaida = 0;

        foreach ($this->itens as $item) {
            $totalSaida += $item->getModelo()->getValorSaida() * $item->getQuantidade();
        }

        return $totalSaida;
    }

    public function getQuantidadeTotal(): int
    {
        $quantidade = 0;
        foreach ($this->itens as $item) {
            $quantidade += $item->getQuantidade();
        }
        return $quantidade;
    }

}

