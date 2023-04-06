import api from '/config/api.js'
import Message  from "/views/pages/components/Message.js"
import Spinner from "/views/pages/components/Spinner.js";
import Button from "/views/pages/components/Button.js";
document.addEventListener('DOMContentLoaded', ()=>{
    const form_sign_in = document.getElementById('form_sign-in')
    const btnLogin = document.querySelector('#sign-in_btnLogin');


    form_sign_in.onsubmit = (e) => {
        e.preventDefault()
        btnLogin.innerHTML = Spinner();
        btnLogin.classList.add('justify-content-center')
        sign_in()
            .then(r => r.json()
                .then(res=>{
                    if (res.isValid){
                        sessionStorage.setItem('token',res.token)
                        sessionStorage.setItem('email',res.data.correo)
                        sessionStorage.setItem('name',res.data.Nombre)
                        sessionStorage.setItem('id',res.data.ID)
                        sessionStorage.setItem('role',res.data.Rol)
                        sessionStorage.setItem('isActive', 'true')

                        successMessage()
                        btnLogin.innerHTML = Button('Iniciar sesión', 'submit', 'btn btn-gray-800')
                        btnLogin.classList.remove('justify-content-center')
                        setTimeout(()=>{redirectto()}, 2000)
                    } else {
                        warningMessage()
                        btnLogin.innerHTML = Button('Iniciar sesión', 'submit', 'btn btn-gray-800')
                        btnLogin.classList.remove('justify-content-center')
                    }
                })
                .catch(err => {
                    userNotFound()
                    btnLogin.innerHTML = Button('Iniciar sesión', 'submit', 'btn btn-gray-800')
                    btnLogin.classList.remove('justify-content-center')
                }))
            .catch(
                e => {
                    errorMessage()
                    btnLogin.innerHTML = Button('Iniciar sesión', 'submit', 'btn btn-gray-800')
                    btnLogin.classList.remove('justify-content-center')
                }
            )

    }

})





async function sign_in() {
    const email = document.querySelector('#email').value
    const password = document.querySelector('#password').value

   return await api('/api/validar','POST',JSON.stringify({email, password}), {'Content-Type': 'application/json'})
}








function redirectto(){
    window.location.href = '/dashboard';
}

function successMessage(){
    Message.fire({
        icon: 'success',
        title: 'Inicio exitoso',
        text: 'Te vamos a redirigir al dashboard',
        showConfirmButton: true,
        timer: 1500
    })
}

function errorMessage(){
    Message.fire({
        icon: 'error',
        title: 'Error inesperado',
        text: 'No nos hemos podido comunicar con el servidor, inténtalo más tarde',
        showConfirmButton: true,
    })
}

function warningMessage(){
    Message.fire({
        icon: 'warning',
        title: 'Error de credenciales',
        text: 'Tú correo o contraseña es incorrecto, revísalo',
        showConfirmButton: true,

    })
}

function userNotFound(){
    Message.fire({
        icon: 'warning',
        title: 'No se han encontrado el usuario',
        text: 'Tú correo no está registrado en el sistema, si crees que es un error consulta con un administrador',
        showConfirmButton: true,

    })
}