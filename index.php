<?php 

require_once './Controller/SelecaoController.php';

$app = new SelecaoController();

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($action === 'atualizar'){
        $app->atualizarDados();
    } else {
        $app-> salvar();
    }
} else {

    switch ($action) {
    case 'novo':
        $app->criar();
        break;
    case 'salvar':
        $app->salvar();
        break;
    case 'editar':
        $app->editar($_GET['id']);
        break;
    case 'atualizar':
        $app->atualizarDados();
        break;
    case 'deletar':
        $app->deletar($_GET['id']);
        break;
    default:
        $app->index();
        break;
    }
}

?>