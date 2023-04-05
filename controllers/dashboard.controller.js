import CallMenus from "/controllers/load/menus/medic.controller.js";

document.addEventListener('DOMContentLoaded', async () => {
    const btnLogout = document.querySelector('#dashboard_btnLogout');

    btnLogout.onclick = () => sign_out();

    const usernameLabel = document.getElementsByClassName('username-label')

    for (const element of usernameLabel) {
        element.innerText = sessionStorage.getItem('name')
    }

    const menus = await CallMenus();

    const sideBar = document.getElementById('dashboard_side-bar');

    for (const menu of menus) {
        sideBar.appendChild(menu)
    }



    // let writeMenus = "holasdasd"
    //
    // Object.keys(menus).forEach(function (key, index){
    //
    //     writeMenus =+ "\"" + menus[key] + "\"" + " <br/>"
    //     console.log(menus[key])
    //
    // })
    //
    // console.log(writeMenus)
    //
    // sideBar.innerHTML = writeMenus

})

function sign_out(){

    sessionStorage.clear();

    window.location.href = '/sign-out'

}