import api from '/config/api.js'
document.addEventListener('DOMContentLoaded', ()=>{
    const form_sign_in = document.getElementById('form_sign-in')

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-gray'
        },
        buttonsStyling: false
    });

    form_sign_in.onsubmit = (e) => {
        e.preventDefault()
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

                        swalWithBootstrapButtons.fire({
                            icon: 'success',
                            title: 'Inicio exitoso',
                            text: 'Te vamos a redirigir al dashboard',
                            showConfirmButton: true,
                            timer: 1500
                        })
                        setTimeout(()=>{redirectto()}, 2000)
                    } else {
                        swalWithBootstrapButtons.fire({
                            icon: 'warning',
                            title: 'Error de credenciales',
                            text: 'Tú correo o contraseña es incorrecto, revísalo',
                            showConfirmButton: true,

                        })
                    }
                })
                .catch(err => console.log(err)))
            .catch(
                e => {
                    swalWithBootstrapButtons.fire({
                        icon: 'error',
                        title: 'Error inesperado',
                        text: 'No nos hemos podido comunicar con el servidor, inténtalo más tarde',
                        showConfirmButton: true,
                    })
                    console.log(e)
                }
            )
    }

})

async function sign_in() {
    const email = document.querySelector('#email').value
    const password = document.querySelector('#password').value

   return await api('/api/validar','POST',JSON.stringify({email, password}))
}

function redirectto(){
    window.location.href = '/dashboard';
}