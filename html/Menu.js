// menu.js

// Aguarda o navegador carregar todo o HTML antes de executar
document.addEventListener("DOMContentLoaded", function() {    
    
    // Cria o HTML do select
    var conteudoSelect = `
        <select name="menu_navegacao" style="width: 300px; height: 40px; display: block; margin: 0 auto;" onchange="navegarParaPagina(this.value)">
        <option value="">-- Selecione para onde deseja ir --</option>
        <option value="index.php?class=PessoaForm">Home</option>
        <option value="">------</option>
        <option value="index.php?class=PessoaForm">Sair</option>
        <option value="">------</option>
        <option value="index.php?class=PessoaList">Pessoa</option>
        <option value="index.php?class=PessoaForm">Cidades</option>
        </select>
    `;

    // Substitui o conteúdo da div #menu a cada carregamento
    var elementoMenu = document.getElementById('menu');
    if (elementoMenu) {
        elementoMenu.innerHTML = conteudoSelect;
    }
});

// Função global para fazer a navegação
function navegarParaPagina(url) {
    if (url) {
        window.location.href = url;
    }
}