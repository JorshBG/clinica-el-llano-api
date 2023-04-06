import api from "/config/api.js";
import Menu from '/views/pages/components/Menu.js'

async function getMenus(){

    let res =  await api(`/api/get/menus`, 'GET', undefined, {
        'x-api-key': sessionStorage.getItem('token')
    });
    if (!res.ok) {
        console.error("Error de acceso a los menus del usuario")
        return
    }
    return res;
}

async function CallMenus() {
    let dataMenus = await (await getMenus()).json()
    return createMenus(dataMenus)
}

function createMenus(data) {
    let menuElements = [];
    for (let i = 0; i < data['result'].length; i++) {
        menuElements.push(Menu(
            data['result'][i]['texto'],
            data['result'][i]['icono']??false
            ))
    }
    // for (const datumElement of data['result']) {
    //     menuElements[datumElement['MN_TEXTO']] = Menu(datumElement['MN_TEXTO'])
    //
    // }
    return menuElements;
}

export default CallMenus