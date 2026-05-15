const passwordSets = [
    {
        input: document.getElementById("passwordInput"),
        checkbox: document.getElementById("toggleCheckbox"),
        label: document.getElementById("toggleLabel"),
    },
    {
        input: document.getElementById("confirmPasswordInput"),
        checkbox: document.getElementById("confirmToggleCheckbox"),
        label: document.getElementById("confirmToggleLabel"),
    },
];

passwordSets.forEach(({ input, checkbox, label }) => {
    if (!input || !checkbox || !label) return; // safety check

    checkbox.addEventListener("change", function () {
        input.type = this.checked ? "text" : "password";
    });

    label.addEventListener("mousedown", (e) => {
        e.preventDefault();
        input.focus();
    });
});
