import CallMenus from "/controllers/load/menus/menu.controller.js";
import api from "/config/api.js";

document.addEventListener('DOMContentLoaded', async () => {
    const btnLogout = document.querySelector('#dashboard_btnLogout');

    btnLogout.onclick = () => sign_out();

    const usernameLabel = document.getElementsByClassName('username-label')

    for (const element of usernameLabel) {
        element.innerText = sessionStorage.getItem('name')
    }

    const menus = document.getElementById('dashboard_user-menus').children

    await renderView('/dashboard/view/dashboard')



    // const menus = await CallMenus();
    //
    // const sideBar = document.getElementById('dashboard_side-bar');
    //
    // for (const menu of menus) {
    //     sideBar.appendChild(menu)
    // }

})

function sign_out(){

    sessionStorage.clear();

    window.location.href = '/sign-out'

}

async function renderView(ref) {

    let res = await api(ref)

    // console.log(await res.text())

}