function checkPasswordStrength() {
        const password = document.getElementById('passwordInput').value;
        const container = document.getElementById('strengthContainer');
        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');
        const registerBtn = document.getElementById('registerBtn');

        // Show container if user started typing
        if (password.length > 0) {
            container.classList.remove('hidden');
            container.classList.add('flex');
        } else {
            container.classList.add('hidden');
            container.classList.remove('flex');
            if(registerBtn) registerBtn.disabled = true; 
            return;
        }

        // Logic Criteria
        let score = 0;
        
        // 1. Check length (must be 8+)
        if (password.length >= 8) score += 25;
        // 2. Check for lowercase
        if (/[a-z]/.test(password)) score += 25;
        // 3. Check for uppercase
        if (/[A-Z]/.test(password)) score += 25;
        // 4. Check for numbers or special chars
        if (/\d/.test(password) || /[^A-Za-z0-9]/.test(password)) score += 25;

        // UI Updates based on Score
        bar.value = score;
        
        // Reset classes
        bar.classList.remove('progress-error', 'progress-warning', 'progress-success');
        text.classList.remove('text-error', 'text-warning', 'text-success');

        if (score < 50) {
            // Weak
            bar.classList.add('progress-error');
            text.textContent = "Weak";
            text.classList.add('text-error');
            if(registerBtn) registerBtn.disabled = true;
        } else if (score >= 50 && score < 100) {
            // Medium
            bar.classList.add('progress-warning');
            text.textContent = "Medium";
            text.classList.add('text-warning');
            if(registerBtn) registerBtn.disabled = true; // Still disabled on Medium
        } else {
            // Strong
            bar.classList.add('progress-success');
            text.textContent = "Strong";
            text.classList.add('text-success');
            if(registerBtn) registerBtn.disabled = false; // Enable button!
        }
    }
