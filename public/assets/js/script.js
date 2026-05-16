// Header scroll effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.classList.add('bg-black/80', 'backdrop-blur-xl', 'py-2');
        header.classList.remove('bg-black/10', 'backdrop-blur-md', 'py-4');
    } else {
        header.classList.add('bg-black/10', 'backdrop-blur-md', 'py-4');
        header.classList.remove('bg-black/80', 'backdrop-blur-xl', 'py-2');
    }
});

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
