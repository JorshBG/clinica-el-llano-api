async function api(path, method = 'GET', body = JSON.stringify({"key":"value"}), headers) {
    const baseUrl = 'http://el_llano_api.gob';
    switch (method){
        case "GET":
            if (headers){
                return await fetch(baseUrl + path + '?idUsuario=' + sessionStorage.getItem('id'),{headers:headers});
            }
            return await fetch(baseUrl + path + '?idUsuario=' + sessionStorage.getItem('id'));
        case "PUT":
        case "POST":
        case "DELETE":
            return await fetch(baseUrl + path + '?idUsuario=' + sessionStorage.getItem('id'), {
                method,
                headers:headers,
                body
            });
        default:
            return "no method provider"
    }
}

export default api