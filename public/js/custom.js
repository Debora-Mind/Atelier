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

    // define a função toggleNumberInput
    function toggleNumberInput(switchElement) {
        const numberInput = switchElement.parentNode.querySelector('.number-input');
        const inputText = switchElement.parentNode.querySelector('.input-text');

        if (switchElement.checked) {
            numberInput.classList.remove('hide');
            numberInput.classList.add('show');
            inputText.classList.remove('hide');
            inputText.classList.add('show');
            numberInput.removeAttribute('disabled');
        } else {
            numberInput.classList.remove('show');
            numberInput.classList.add('hide');
            inputText.classList.remove('show');
            inputText.classList.add('hide');
            numberInput.setAttribute('disabled', 'disabled');
        }
    }
        // define as variáveis switches e switchElement
        const switches = document.querySelectorAll('.form-check-input');
        let switchElement;

        // itera sobre cada switch e adiciona um evento change
        for (let i = 0; i < switches.length; i++) {
            switchElement = switches[i];
            toggleNumberInput(switchElement); // inicializa a exibição do input
            switchElement.addEventListener('change', function () {
                toggleNumberInput(this);
            });
        }
    })

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
