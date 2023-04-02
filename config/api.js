async function api(path, method = 'GET', body = JSON.stringify({"key":"value"}), headers ={'Content-Type': 'application/json'}) {
    const baseUrl = 'http://el_llano_api.gob';
    switch (method){
        case "GET":
            return await fetch(baseUrl + path);
        case "PUT":
        case "POST":
        case "DELETE":
            return await fetch(baseUrl + path, {
                method,
                headers,
                body
            });
        default:
            return "no method provider"
    }
}

export default api