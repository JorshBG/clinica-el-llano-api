document.addEventListener('DOMContentLoaded', () =>{
    const btnLogout = document.querySelector('#dashboard_btnLogout');

    btnLogout.onclick = () => sign_out();

    const usernameLabel = document.getElementsByClassName('username-label')

    for (const element of usernameLabel) {
        element.innerText = sessionStorage.getItem('name')
    }
})

function sign_out(){

    sessionStorage.clear();

    window.location.href = '/sign-out'

}