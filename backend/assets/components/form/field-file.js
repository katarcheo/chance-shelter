class FileInput extends HTMLElement {
    static formAssociated = true;
    connectedCallback() {
        const label = this.getAttribute('label');
        const placeholder = this.getAttribute('placeholder') ?? 'Choose a file';
        this.innerHTML = `
            ${label ? `<label class="field__label">${label}:</label>` : ''}
            <input type="file" hidden>
            <div class="field__file">${placeholder}</div>
        `;
        this.classList.add('field__container');

        const input = this.querySelector('input');
        const trigger = this.querySelector('.field__file');
        trigger.addEventListener('click', () => input.click());
        input.addEventListener('change', () => {
            trigger.textContent = input.files[0]?.name ?? placeholder;
            trigger.classList.toggle('field__file--filled', !!input.files[0]);
        });
    }
}

customElements.define('field-file', FileInput);
