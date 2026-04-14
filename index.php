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
    case 'dashboard':
        $app->dashboard();
        break;
    default:
        $app->index();
        break;
    }
}

$acao = $_GET['action'] ?? 'listar';

switch ($acao) {
    case 'novo-jogador':
        $controller = new JogadorController();
        $controller->criar($_GET['selecao_id'] ?? null);
        break;

    case 'salvar-jogador':
        $controller = new JogadorController();
        $controller->salvar();
        break;

    case 'elenco':
        $controller = new JogadorController();
        $controller->elenco($_GET['selecao_id'] ?? null);
        break;

    case 'editar-jogador':
        $controller = new JogadorController();
        $controller->editar($_GET['id'] ?? null);
        break;

    case 'atualizar-jogador':
        $controller = new JogadorController();
        $controller->atualizar();
        break;

    case 'deletar-jogador':
        $controller = new JogadorController();
        $controller->deletar($_GET['id'] ?? null, $_GET['selecao_id'] ?? null);
        break;
}

?>