const hover = document.querySelector('.hover');
const btn = document.querySelector('.hoverbtn');
const txt = document.querySelector('.hovertxt');

const regtxt = "Vous n'avez pas de compte ?"
const regbtn = "Inscrivez-vous !"

const logtxt = "Vous avez déjà un compte ?"
const logbtn = "Connectez-vous !"

document.addEventListener('DOMContentLoaded', function() {
    hover.style.left = "50%";
    txt.innerHTML = regtxt;
    btn.innerHTML = regbtn;
    btn.onclick = hoverConnect;
});


function hoverConnect() {
    if (hover.style.left == "50%") {
        hover.style.left = "0%";
        txt.innerHTML = logtxt;
        btn.innerHTML = logbtn;
    } else {
        hover.style.left = "50%";
        txt.innerHTML = regtxt;
        btn.innerHTML = regbtn;
    }
}