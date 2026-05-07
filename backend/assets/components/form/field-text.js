class Text extends HTMLElement {
    static formAssociated = true;
    connectedCallback() {
        this.innerHTML = `
            <textarea
                placeholder="${this.getAttribute('placeholder')}"
                class="field field__text"
            ></textarea>
        `;
    }
}

customElements.define('field-text', Text);
