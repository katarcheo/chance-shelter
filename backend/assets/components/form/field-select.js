class Select extends HTMLElement {
    static formAssociated = true;

    constructor() {
        super();
        this.querySelectorAll('option')
            .forEach(option => option.className = 'field__option')
    }
    connectedCallback() {
        const label = this.getAttribute('label');
        this.innerHTML = `
            ${label ? `<label class="field__label">${label}:</label>` : ''}
            <select class="field field__line field__select">${this.innerHTML}</select>
        `;
        this.classList.add('field__container');
    }
}

customElements.define('field-select', Select);
