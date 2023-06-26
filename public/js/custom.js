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

// espera o DOM ser carregado
document.addEventListener('DOMContentLoaded', function() {
    const switches = document.querySelectorAll('.switch input[type="checkbox"]');

    function toggleNumberInput(switchElement) {
        const numberInput = switchElement.closest('.form-group').nextElementSibling;
        const isChecked = switchElement.checked;

        numberInput.style.display = isChecked ? 'block' : 'none';
    }

    for (let i = 0; i < switches.length; i++) {
        const switchElement = switches[i];
        toggleNumberInput(switchElement);
        switchElement.addEventListener('click', function() {
            toggleNumberInput(this);
        });
    }
});


function limparConteudo() {
    document.getElementById('data-saida').value = ''; //limpa o valor do input
}

(function() {
    const input = document.getElementById("modelo-filtro");
    const select = document.getElementById("modelo");
    const options = select.options;

    input.addEventListener("input", function() {
        const value = input.value.trim().toLowerCase();

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            const optionValue = option.value.trim().toLowerCase();

            if (optionValue.indexOf(value) !== -1) {
                option.style.display = "";
            } else {
                option.style.display = "none";
            }
        }
    });

    input.addEventListener("blur", function() {
        const value = input.value.trim().toLowerCase();

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            const optionValue = option.value.trim().toLowerCase();

            if (optionValue === value) {
                select.value = optionValue;
                break;
            }
        }

        input.value = "";
    });
})();
