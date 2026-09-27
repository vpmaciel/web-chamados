document.addEventListener("DOMContentLoaded", function() {
    var conteudoSelect1 = `<select name="menu_navegacao" style="width: 280px; height: 42px; padding: 0 12px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #ffffff; cursor: pointer; font-size: 14px; color: #334155; outline: none;" onchange="navegarParaPagina(this.value)">
    <option value="">-- Módulo Principal --</option>
    <option value="index.php?class=PessoaForm">Home</option>
    <option value="index.php?class=PessoaList">Pessoas</option>
    <option value="index.php?class=CidadesList">Cidades</option>
</select>`;
    var conteudoSelect2 = `<select name="menu_navegacao2" style="width: 280px; height: 42px; padding: 0 12px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #ffffff; cursor: pointer; font-size: 14px; color: #334155; outline: none;" onchange="navegarParaPagina(this.value)">
    <option value="">-- Ações Rápidas --</option>
    <option value="index.php?class=RelatorioForm">Relatórios</option>
    <option value="index.php?class=ConfigForm">Configurações</option>
    <option value="index.php?class=Sair">Sair</option>
</select>`;

    var elementoMenu = document.getElementById('menu');
    if (elementoMenu) {
        // Unifica os dois selects
        elementoMenu.innerHTML = conteudoSelect1 + conteudoSelect2;

        // Estilos para centralizar horizontalmente com espaçamento
        elementoMenu.style.display = 'flex';
        elementoMenu.style.justifyContent = 'center';
        elementoMenu.style.alignItems = 'center';
        elementoMenu.style.gap = '20px';
        elementoMenu.style.flexWrap = 'wrap';
    }
});

function navegarParaPagina(url) {
    if (url) window.location.href = url;
}