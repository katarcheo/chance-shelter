class Text extends HTMLElement {
    static formAssociated = true;
    connectedCallback() {
        const label = this.getAttribute('label');
        this.innerHTML = `
            ${label ? `<label class="field__label">${label}:</label>` : ''}
            <textarea
                placeholder="${this.getAttribute('placeholder')}"
                class="field field__text"
            ></textarea>
        `;
        this.classList.add('field__container');
    }
}

customElements.define('field-text', Text);
