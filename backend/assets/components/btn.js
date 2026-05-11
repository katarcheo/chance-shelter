class Btn extends HTMLElement {
    connectedCallback() {
        this.outerHTML = `
            <button
                class="chance__btn"
                type="${this.getAttribute('type') || 'button'}"
            >
                ${this.innerText}
            </button>
        `
    }
}

customElements.define('chance-btn', Btn);
