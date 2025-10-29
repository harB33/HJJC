const passwordInput = document.getElementById('passwordInput');
    const toggleCheckbox = document.getElementById('toggleCheckbox');

    toggleCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });

    const toggleLabel = document.getElementById('toggleLabel');
    toggleLabel.addEventListener('mousedown', (e) => {
        e.preventDefault(); 
        passwordInput.focus();
    });