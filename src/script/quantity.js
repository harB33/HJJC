document.addEventListener('DOMContentLoaded', function() {
    const selector = document.querySelector('.quantity-selector');
    
    // Safety check
    if (!selector) {
        return;
    }

    const input = selector.querySelector('.quantity-input');
    const minusBtn = selector.querySelector('.minus-btn');
    const plusBtn = selector.querySelector('.plus-btn');

    // Safety check
    if (!input || !minusBtn || !plusBtn) {
        return;
    }

    // Get min/max values from HTML attributes
    const min = parseInt(input.getAttribute('min'));
    const max = parseInt(input.getAttribute('max'));

    // This function sets the button state on page load
    function checkMinMax() {
        const currentValue = parseInt(input.value);
        minusBtn.disabled = (currentValue <= min);
        plusBtn.disabled = (currentValue >= max);
    }

    // Event listener for the Minus button
    minusBtn.addEventListener('click', function() {
        let currentValue = parseInt(input.value);
        if (currentValue > min) {
            input.value = currentValue - 1;
            // checkMinMax(); // <-- THIS LINE WAS THE BUG. Do not call it here.
        }
    });

    // Event listener for the Plus button
    plusBtn.addEventListener('click', function() {
        let currentValue = parseInt(input.value);
        if (currentValue < max) {
            input.value = currentValue + 1;
            // checkMinMax(); // <-- THIS LINE WAS THE BUG. Do not call it here.
        }
    });
    // Run initial check ON PAGE LOAD (this is correct)
    checkMinMax();
});

document.addEventListener('DOMContentLoaded', function() {
    // 1. Get the Add To Cart form
    const addToCartForm = document.getElementById('addToCartForm');
    if (!addToCartForm) return;

    // 2. Get the currently visible quantity input (from the quantity selector form)
    const visibleQuantityInput = document.querySelector('.quantity-input');
    
    // 3. Get the new hidden quantity input we added to the Add To Cart form
    const hiddenQuantityInput = document.getElementById('hiddenQuantityInput');
    
    // 4. Attach an event listener to the Add To Cart form
    addToCartForm.addEventListener('submit', function(e) {
        // Before submitting, update the hidden quantity field with the current visible value
        if (visibleQuantityInput && hiddenQuantityInput) {
            hiddenQuantityInput.value = visibleQuantityInput.value;
        }
        // Let the form submit normally
    });
});