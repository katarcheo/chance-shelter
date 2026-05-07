class Select extends HTMLElement {
    static formAssociated = true;

    constructor() {
        super();
        this.querySelectorAll('option')
            .forEach(option => option.className = 'field__option')
    }
    connectedCallback() {
        this.innerHTML = `
            <select class="field field__line field__select">${this.innerHTML}</select>
        `;
    }
}

customElements.define('field-select', Select);
