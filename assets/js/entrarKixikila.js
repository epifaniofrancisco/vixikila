var spanFechar = document.querySelector(".fechar");
const btn = document.querySelector(".entrar")
const modal = document.getElementById("modal");

btn.addEventListener("click", () => {
	modal.style.display = "flex";
});

spanFechar.addEventListener("click", () => {
	modal.style.display = "none";
});

/* Fechar ao clicar fora do modal

onclick = function (event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
};

*/