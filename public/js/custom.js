function darSaida(modelo, id) {
    confirmar = confirm('Tem certeza que quer dar saída no modelo ' + modelo + '?')

    if (confirmar === true) {
        window.location.href = '/dar-saida?id=' + id
    }
}

function excluir(tipo, modelo, id) {
    confirmar = confirm('Tem certeza que quer excluír o ' + tipo + ' ' + modelo + '?')

    if (confirmar === true) {
        window.location.href = '/excluir-' + tipo + '?id=' + id
    }
}

function cancelar(caminho) {
    window.location.href = '/' + caminho
}
