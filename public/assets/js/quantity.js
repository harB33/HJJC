document.addEventListener("DOMContentLoaded", () => {
    const minusButton = document.querySelector(".minus-btn");
    const plusButton = document.querySelector(".plus-btn");
    const quantityInput = document.querySelector(".quantity-input");
    const hiddenQuantityInput = document.getElementById("hiddenQuantityInput");

    if (!minusButton || !plusButton || !quantityInput || !hiddenQuantityInput) return;

    const min = parseInt(quantityInput.getAttribute("min")) || 1;
    const max = parseInt(quantityInput.getAttribute("max")) || 100;

    function synchronizeQuantity(value) {
        let parsedValue = parseInt(value, 10) || 1;
        parsedValue = Math.max(min, Math.min(parsedValue, max));
        quantityInput.value = parsedValue;
        hiddenQuantityInput.value = parsedValue;
        minusButton.disabled = parsedValue <= min;
        plusButton.disabled = parsedValue >= max;
    }

    // Button handlers
    plusButton.addEventListener("click", () => {
        synchronizeQuantity(parseInt(quantityInput.value, 10) + 1);
    });

    minusButton.addEventListener("click", () => {
        synchronizeQuantity(parseInt(quantityInput.value, 10) - 1);
    });

    // Allow manual input
    quantityInput.addEventListener("input", (e) => {
        synchronizeQuantity(e.target.value);
    });

    // Initialize
    synchronizeQuantity(quantityInput.value);
});
