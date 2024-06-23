var n = 0;
var conta = document.getElementById('conta');
conta.style.cssText = 'left: -5%;';

function seta(){
    var func = document.getElementById('func');
    var abrir = document.getElementById('abrir');
    n += 1;

    if (n === 1){
        func.style.cssText = 'display: block;';
        abrir.style.cssText = 'rotate: 180deg; top: -10px;';
        n += 1;
        console.log(n);
    }else{
        func.style.cssText = 'display: none;';
        abrir.style.cssText = 'rotate: 0deg;';
        n = 0;
    }
}