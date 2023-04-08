import api from "/config/api.js";

document.addEventListener('DOMContentLoaded', async () => {
    const btnLogout = document.querySelector('#dashboard_btnLogout');

    btnLogout.onclick = () => sign_out();

    const usernameLabel = document.getElementsByClassName('username-label')

    for (const element of usernameLabel) {
        element.innerText = sessionStorage.getItem('name')
    }

    const menus = document.getElementsByClassName('nav-only-item')

    const bodyContent = document.getElementById('mainContent');

    for (const menu of menus) {
        menu.addEventListener('click', async function (evt) {
            evt.preventDefault();
            bodyContent.innerHTML = await renderView(menu.pathname)
            // console.log(menu.pathname);
        })
    }

    // await renderView('/dashboard/view/dashboard')

})

function sign_out(){

    sessionStorage.clear();

    window.location.href = '/sign-out'

}

async function renderView(ref) {

    let res = await api(ref)

    return await res.text()

}