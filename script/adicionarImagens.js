document.addEventListener("DOMContentLoaded", function () {
    const botaoAdicionarImagem = document.getElementById("botaoAdicionarImagem");
    const containerImagens = document.getElementById("containerImagens");
    const limiteImagens = 3; // Defina o limite desejado

    botaoAdicionarImagem.addEventListener("click", function () {
        const camposImagem = containerImagens.querySelectorAll(".imagem-url");

        if (camposImagem.length < limiteImagens) {
            const novoCampoImagem = document.createElement("div");
            novoCampoImagem.classList.add("campo-imagem");

            novoCampoImagem.innerHTML = `
                <br>
                <input type="text" class="form-control imagem-url" name="imagem_url[]">
            `;

            containerImagens.appendChild(novoCampoImagem);
        } else {
            alert("Limite de imagens atingido (máximo de 3).");
        }
    });
});