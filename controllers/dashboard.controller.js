document.addEventListener('DOMContentLoaded', () =>{
    const usernameLabel = document.getElementsByClassName('username-label')

    for (const element of usernameLabel) {
        element.innerText = sessionStorage.getItem('name')
    }
})