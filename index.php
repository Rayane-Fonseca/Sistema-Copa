<?php
require_once './Controller/SelecaoController.php';
require_once './Controller/JogadorController.php';

$selecaoController = new SelecaoController();
$jogadorController = new JogadorController();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'novo':
        $selecaoController->criar();
        break;

    case 'salvar':
        $selecaoController->salvar();
        break;

    case 'editar':
        $selecaoController->editar($_GET['id'] ?? null);
        break;

    case 'atualizar':
        $selecaoController->atualizarDados();
        break;

    case 'deletar':
        $selecaoController->deletar($_GET['id'] ?? null);
        break;

    case 'dashboard':
        $selecaoController->dashboard();
        break;

    case 'novo-jogador':
        $jogadorController->criar($_GET['selecao_id'] ?? null);
        break;

    case 'salvar-jogador':
        $jogadorController->salvar();
        break;

    case 'elenco':
        $jogadorController->elenco($_GET['selecao_id'] ?? null);
        break;

    case 'editar-jogador':
        $jogadorController->editar($_GET['id'] ?? null);
        break;

    case 'atualizar-jogador':
        $jogadorController->atualizar();
        break;

    case 'deletar-jogador':
        $jogadorController->deletar($_GET['id'] ?? null, $_GET['selecao_id'] ?? null);
        break;

    default:
        $selecaoController->index();
        break;
}
?>