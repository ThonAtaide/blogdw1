<?php
require "dataBase.php";

function inserir($post)
{
    $conexao = conectar();
    $insert = executar($conexao, "INSERT INTO POSTAGEM (TEXTO, AUTOR) VALUES ('" . $post->getTexto . "', " . $post->getAutor . ")");
    $desconectar = desconectar($conexao);
}

function listarPosts()
{
    $conexao = conectar();
    $select = executar($conexao, "SELECT * FROM POSTAGEM");
    $desconectar = desconectar($conexao);

    $linha = retorna_linha($select);
    $total = verifica_resultado($select);

    // se o número de resultados for maior que zero, mostra os dados
    if ($total > 0) {
        // inicia o loop que vai mostrar todos os dados
        do {
            ?>
            <p><?= $linha['ID'] ?> / <?= $linha['TEXTO'] ?></p>
<?php
        // finaliza o loop que vai mostrar os dados
} while ($linha = retorna_linha($select));
    // fim do if 
}
?>
</body>
</html>
<?php

}
?>