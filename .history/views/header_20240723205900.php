// js/scripts.js

document.addEventListener('DOMContentLoaded', function () {
    // Validación de formularios
    var forms = document.querySelectorAll('form');

    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            var inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
            var valid = true;

            inputs.forEach(function (input) {
                if (!input.value) {
                    input.style.borderColor = 'red';
                    valid = false;
                } else {
                    input.style.borderColor = 'initial';
                }
            });

            if (!valid) {
                event.preventDefault();
                alert('Por favor, rellena todos los campos obligatorios.');
            }
        });
    });

    // Actualización dinámica de cantidad de productos
    var cantidadInputs = document.querySelectorAll('input[name="cantidad"]');
    var precioInputs = document.querySelectorAll('input[name="precio"]');
    var totalDisplay = document.querySelector('#total');

    cantidadInputs.forEach(function (cantidadInput) {
        cantidadInput.addEventListener('input', actualizarTotal);
    });

    precioInputs.forEach(function (precioInput) {
        precioInput.addEventListener('input', actualizarTotal);
    });

    function actualizarTotal() {
        var cantidad = parseFloat(cantidadInputs[0].value) || 0;
        var precio = parseFloat(precioInputs[0].value) || 0;
        var total = cantidad * precio;

        if (totalDisplay) {
            totalDisplay.textContent = 'Total: $' + total.toFixed(2);
        }
    }

    // Mostrar/ocultar contraseña
    var togglePassword = document.querySelector('#togglePassword');
    var passwordInput = document.querySelector('input[name="password"]');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Mostrar' : 'Ocultar';
        });
    }
});
