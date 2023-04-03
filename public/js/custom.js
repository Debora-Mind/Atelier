function darSaida(modelo, id) {
    confirmar = confirm('Tem certeza que quer dar saída no modelo ' + modelo + '?')

    if (confirmar === true) {
        window.location.href = '/dar-saida?id=' + id
    }
}

function excluir(modelo, id) {
    confirmar = confirm('Tem certeza que quer excluír o modelo ' + modelo + '?')

    if (confirmar === true) {
        window.location.href = '/excluir-modelo?id=' + id
    }
}
