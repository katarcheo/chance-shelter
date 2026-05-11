import { apiRequest } from '../../api.js';

class ApiForm extends HTMLElement {
    constructor() {
        super();
        var form = document.createElement('form');
        form.innerHTML = this.innerHTML
        form.setAttribute('action', this.getAttribute('action'))
        form.setAttribute('method', this.getAttribute('method'))
        this.innerHTML = '';
        this.append(form);

        form.addEventListener('submit', async e => {
            e.preventDefault();
            const form = e.target;
            const method = form.method || 'GET';
            const action = form.action;
            const formData = new FormData(form);

            apiRequest(action, method, formData)
                .then(result => this.dispatchSuccess(result))
                .catch(result => this.dispatchError(result));
        });
    }

    dispatchSuccess(result) {
        this.dispatchEvent(new CustomEvent('api-form:success', result));
    }

    dispatchError(result) {
        this.dispatchEvent(new CustomEvent('api-form:error', result));
    }
}

customElements.define('api-form', ApiForm);
