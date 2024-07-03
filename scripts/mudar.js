function mudar(tipo) {
    var nome = document.getElementById('nome');
    var serie = document.getElementById('serie');
    var tel = document.getElementById('tel');
    var email = document.getElementById('email');
    var but = document.getElementById('but');

    if (tipo === 'nome') {
        nome.style.cssText = 'display: block;';
        but.style.cssText = 'display: block;';
    } else if (tipo === 'serie') {
        serie.style.cssText = 'display: block;';
        but.style.cssText = 'display: block;';
    } else if (tipo === 'email') {
        email.style.cssText = 'display: block;';
        but.style.cssText = 'display: block;';
    } else if (tipo === 'telefone') {
        tel.style.cssText = 'display: block;';
        but.style.cssText = 'display: block;';
    }
}
var btn = document.querySelector("#but");
btn.addEventListener("click", function (e) {
    var confirmar = confirm("Tem certeza que deseja alterar as informações deste usuário?");
    if (confirmar === true) {

    } else {
        e.preventDefault();

        alert('não enviou');
    }
});