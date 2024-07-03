var n = 0;
document.addEventListener('DOMContentLoaded', (event) => {
    var conta = document.getElementById('conta');
    if (conta) {
        conta.style.left = "-5%";
    } else {
    }
});

function seta() {
    var func = document.getElementById('func');
    var abrir1 = document.getElementById('abrir1');
    var abrir2 = document.getElementById('abrir2');

    n += 1;

    if (n === 1) {
        func.style.cssText = 'display: block;';
        abrir2.style.cssText = 'display: block;';
        abrir1.style.cssText = 'display: none;';
        n += 1;
    } else {
        func.style.cssText = 'display: none;';
        abrir2.style.cssText = 'display: none;';
        abrir1.style.cssText = 'display: block;';

        n = 0;
    }
}