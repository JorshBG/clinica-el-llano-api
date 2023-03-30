async function api(path, method = 'GET', headers ={'Content-Type': 'application/json'}, body) {
    const baseUrl = 'http://el_llano_api.gob';
    return await fetch(baseUrl + path, {
        method,
        headers,
        body: JSON.stringify(body)
    });
}
