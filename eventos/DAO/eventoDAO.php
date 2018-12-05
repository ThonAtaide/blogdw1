<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
require_once $dir . '/blogdw1/dataBase.php';
require_once $dir . '/blogdw1/eventos/Model/evento.php';

function insertEvento($evento)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('INSERT INTO EVENTO(NOME, DESCRICAO, ADDRESS, DATA, LAT, LNG) VALUES (:nome, :descricao, :endereco, :data, :lat, :lng);');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':nome' => $evento->getNome(),
        ':descricao' => $evento->getDescricao(),
        ':endereco' => $evento->getEndereco(),
        ':data' => $evento->getData(),
        ':lat' => $evento->getLat(),
        ':lng' => $evento->getLng()
    ));
}

function updateEvento($evento)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('UPDATE EVENTO SET NOME = :nome, DESCRICAO = :descricao, ADDRESS = :endereco, DATA = :data, LAT = :lat, LNG = :lng WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':nome' => $evento->getNome(),
        ':descricao' => $evento->getDescricao(),
        ':endereco' => $evento->getEndereco(),
        ':data' => $evento->getData(),
        ':lat' => $evento->getLat(),
        ':lng' => $evento->getLng(),
        ':id' => $evento->getId()
    ));
}

function deleteEvento($id)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('UPDATE EVENTO SET DELETADO = TRUE WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':id' => $id
    ));
}

function readPageEventos($pc)
{
    $total_reg = "3";

    $inicio = $pc - 1;

    $inicio = $inicio * $total_reg;

    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM EVENTO WHERE DELETADO = FALSE ORDER BY DATA DESC LIMIT ' . $inicio . ', ' . $total_reg . ';');

    $todos = readEventos();

    $tr = $todos->rowCount(); // verifica o número total de registros

    $tp = $tr / $total_reg; // verifica o número total de páginas

    return $array = array($stmt, $tp);
}

function readEventos()
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM EVENTO WHERE DELETADO = FALSE ORDER BY DATA DESC;');

    return $stmt;
}

function getEvento($id)
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM EVENTO WHERE ID=' . $id . ';');

    $select = $stmt->fetch();

    $evento = new Evento();
    $evento->setId($select['ID']);
    $evento->setNome($select['NOME']);
    $evento->setDescricao($select['DESCRICAO']);
    $evento->setData($select['DATA']);
    $evento->setEndereco($select['ADDRESS']);
    $evento->setLat($select['LAT']);
    $evento->setLng($select['LNG']);

    return $evento;
}

function readLocalEventos()
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM EVENTO WHERE DELETADO = FALSE ORDER BY DATA DESC;');

    return $stmt;
}

function verificaPresenca($idEvento)
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM PRESENCAEVENTO WHERE IDUSUARIO = ' . $_SESSION['UsuarioID'] . ' AND IDEVENTO = ' . $idEvento . ';');

    return $stmt;
}

function criarPresenca($idEvento)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('INSERT INTO PRESENCAEVENTO(IDUSUARIO, IDEVENTO) VALUES (:idUsuario, :idEvento);');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':idUsuario' => $_SESSION['UsuarioID'],
        ':idEvento' => $idEvento
    ));
}

function deletarPresenca($idEvento)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('DELETE FROM PRESENCAEVENTO WHERE IDUSUARIO = :idUsuario AND IDEVENTO = :idEvento;');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':idUsuario' => $_SESSION['UsuarioID'],
        ':idEvento' => $idEvento
    ));
}

?>