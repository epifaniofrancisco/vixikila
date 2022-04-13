var btnSeguinte = document.querySelector(".seguinte");
var confirmarBanco = document.querySelector(".confirmar-banco")


btnSeguinte.addEventListener("click", () => {
	confirmarBanco.style.display = "flex";
});

/* Fechar ao clicar fora do modal

onclick = function (event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
};

*/