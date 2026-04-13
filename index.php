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
            require_once './Views/create.php'; //mostrar formulário
            break;
        
        case 'editar':
            $app->editar($id);
            break;

        case 'deletar':
            $app->deletar($id);
            break;
        default:
            $app->index();
            break;
    }
}

?>