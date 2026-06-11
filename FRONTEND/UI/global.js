document.addEventListener('DOMContentLoaded', function () {
    const toggleButtons = document.querySelectorAll('.auth-toggle');

    toggleButtons.forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            const input = this.closest('.auth-input-group').querySelector('input');
            if (!input) {
                return;
            }
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });

    function maskCpf(value) {
        value = value.replace(/\D/g, '').substring(0, 11);
        if (value.length > 3) {
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
        }
        if (value.length > 7) {
            value = value.replace(/(\d{3})(\d{3})(\d)/, '$1.$2-$3');
        }
        return value;
    }

    function maskPhone(value) {
        value = value.replace(/\D/g, '').substring(0, 11);
        if (value.length > 2) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
        }
        if (value.length > 7) {
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        }
        return value;
    }

    document.querySelectorAll('.mask-cpf').forEach(function (input) {
        input.addEventListener('input', function (event) {
            event.target.value = maskCpf(event.target.value);
        });
    });

    document.querySelectorAll('.mask-phone').forEach(function (input) {
        input.addEventListener('input', function (event) {
            event.target.value = maskPhone(event.target.value);
        });
    });
});