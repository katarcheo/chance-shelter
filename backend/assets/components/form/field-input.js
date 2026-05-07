class Input extends HTMLElement {
    static formAssociated = true;
    connectedCallback() {
        this.innerHTML = `
            <input
                placeholder="${this.getAttribute('placeholder')}"
                class="field field__line"
            >
        `;
    }
}

customElements.define('field-input', Input);
