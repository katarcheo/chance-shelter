export async function apiRequest(action, method, formData) {
    var requestData = {
        method: method.toUpperCase(),
        headers: { 'Accept': 'application/json' },
        body: formData,
    };

    return fetch(action, requestData)
        .then(response => response.json())
        .catch(response => response);
}
