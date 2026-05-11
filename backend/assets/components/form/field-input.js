class Input extends HTMLElement {
    static formAssociated = true;
    connectedCallback() {
        const label = this.getAttribute('label');
        this.innerHTML = `
            ${label ? `<label class="field__label">${label}:</label>` : ''}
            <input
                placeholder="${this.getAttribute('placeholder') || ''}"
                class="field field__line"
            >
        `;
        this.classList.add('field__container');
    }
}

customElements.define('field-input', Input);
