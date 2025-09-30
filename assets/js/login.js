document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('form');
    const togglePwd = document.getElementById('togglePwd');

    if (!form) return;

    // Function to show messages
    function showError(message, type = 'error') {
        let errorDiv = document.querySelector('.error');

        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'error';
            form.parentNode.insertBefore(errorDiv, form);
        }

        errorDiv.textContent = message;
        errorDiv.style.display = 'block';

        if (type === 'error') {
            setTimeout(() => {
                errorDiv.style.display = 'none';
                errorDiv.textContent = '';
            }, 5000);
        }
    }


    if (togglePwd) {
        togglePwd.onclick = function (e) {
            e.preventDefault();
            const pwd = document.getElementById('password');
            const btn = document.getElementById('togglePwd');

            if (pwd.type === 'password') {
                pwd.type = 'text';
                btn.textContent = '🙈';
             

            } else {
                pwd.type = 'password';
                btn.innerHTML = '👁️';
            }
        };
    }

    // Form submission handler
    form.addEventListener('submit', function (e) {
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        // Clear previous errors
        const existingError = document.querySelector('.error');
        if (existingError) {
            existingError.style.display = 'none';
        }

        // Validation
        if (!email.value || !password.value) {
            e.preventDefault();
            showError('Por favor, preencha todos os campos');
            return;
        }

        if (!isValidEmail(email.value)) {
            e.preventDefault();
            showError('Por favor, insira um endereço de email válido');
            return;
        }

        // If validation passes, the form will submit normally and the server will redirect to the dashboard.
    });

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Real-time validation (optional)
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('blur', function () {
            if (this.value && !isValidEmail(this.value)) {
                showError('Por favor, insira um endereço de email válido');
            }
        });
    }
});