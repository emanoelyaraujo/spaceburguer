function msgError(mensagem) {
    let toast = document.querySelector('.toast')

    toast = new bootstrap.Toast(toast)
    document.querySelector('.toast-header .rounded').src = "/assets/img/SVG/x.svg"
    document.querySelector('.toast-header .me-auto').innerHTML = "Erro"
    document.querySelector('.toast-body').innerHTML = mensagem

    toast.show()
}

function msgSucesso(mensagem) {
    let toast = document.querySelector('.toast')

    toast = new bootstrap.Toast(toast)
    document.querySelector('.toast-header .rounded').src = "/assets/img/SVG/check.svg"
    document.querySelector('.toast-header .me-auto').innerHTML = "Sucesso"
    document.querySelector('.toast-body').innerHTML = mensagem

    toast.show()
}