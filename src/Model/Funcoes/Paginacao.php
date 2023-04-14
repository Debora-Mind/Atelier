<?php

namespace Dam\Atelier\Model\Funcoes;

class Paginacao
{
    private $itens;
    private mixed $itemsPorPagina;

    public function __construct($items, $itemsPorPagina = 10)
    {
        $this->itens = $items;
        $this->itemsPorPagina = $itemsPorPagina;
    }

    function paginate(): array
    {
        $totalItems = count($this->itens);
        $totalPaginas = ceil($totalItems / $this->itemsPorPagina);
        $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $primeiroItem = ($paginaAtual - 1) * $this->itemsPorPagina;
        $itemsPaginados = array_slice($this->itens, $primeiroItem, $this->itemsPorPagina);

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

    public function getValorTotalItens(): float
    {
        $total = 0;

        foreach ($this->itens as $item) {
            $total += $item->getValor() * $item->getQuantidade();
        }

        return $total;
    }

    public function getValorTotalItensPagina(): float
    {
        $itemsPaginados = $this->paginate()['itens'];

        $total = 0;

        foreach ($itemsPaginados as $item) {
            $total += $item->getValor() * $item->getQuantidade();
        }

        return $total;
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

