class FileInput extends HTMLElement {
    static formAssociated = true;
    connectedCallback() {
        this.innerHTML = `
            <input hidden>
        `;
    }
}

customElements.define('field-file', FileInput);
