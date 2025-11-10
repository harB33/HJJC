document.addEventListener('DOMContentLoaded', function() {
    const selector = document.querySelector('.quantity-selector');
    const input = selector.querySelector('.quantity-input');
    const minusBtn = selector.querySelector('.minus-btn');
    const plusBtn = selector.querySelector('.plus-btn');

    // Get min/max values from HTML attributes
    const min = parseInt(input.getAttribute('min'));
    const max = parseInt(input.getAttribute('max'));

    // Initial check to disable the minus button if value is already at min
    function checkMinMax() {
        const currentValue = parseInt(input.value);
        
        // Disable minus button if current value is at min
        minusBtn.disabled = (currentValue <= min); 
        
        // Disable plus button if current value is at max
        plusBtn.disabled = (currentValue >= max); 
    }

    // Event listener for the Minus button
    minusBtn.addEventListener('click', function() {
        let currentValue = parseInt(input.value);
        if (currentValue > min) {
            input.value = currentValue - 1;
            checkMinMax(); // Check min/max after change
        }
    });

    // Event listener for the Plus button
    plusBtn.addEventListener('click', function() {
        let currentValue = parseInt(input.value);
        if (currentValue < max) {
            input.value = currentValue + 1;
            checkMinMax(); // Check min/max after change
        }
    });

    // Run initial check
    checkMinMax();
});