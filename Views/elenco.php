<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco da Seleção</title>
    <link rel="shortcut icon" href="../assets/ball.png" type="image/x-icon">
    <style>
        body{
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            background-size: cover;
            background-position: center;
            margin-top: 200px;
        }

        body::before{
            content: "";
            position: fixed;
            inset: 0;
            background-image: url(assets/fundo.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(2px);
            z-index: -1;
            transform: scale(1.05);
        }

        .container{
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 16px;
        }

        h1, h2, p{
            display: flex;
            justify-content: center;
            color: #f0f3f5;
            margin-bottom: 30px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            border-radius: 25px;
            overflow: hidden;
        }

        th { 
            background-color: #1e3a5f;
            border: 1px solid #545e75; 
            padding: 15px 10px; 
            color: #f0f3f5;
            font-weight: bold;
        }

        td { 
            border: 1px solid #545e75; 
            padding: 12px 10px; 
            background-color: #304d6d;
            color: #f0f3f5;
            text-align: center;
        }

        tr:hover td {
            background-color: #3a5a7a;
        }

        .btn {
            display: center;
            padding: 10px 16px;
            background: #304d6d;
            color: #f0f3f5;
            text-decoration: none;
            border-radius: 25px;
            margin-top: 15px;
            align-items: center;
        }

        .btn-voltar {
            display: center;
            padding: 10px 16px;
            background: #304d6d;
            color: #f0f3f5;
            text-decoration: none;
            border-radius: 25px;
            margin-top: 15px;
            align-items: center;
        }

        .btn:hover {
            background: #1e3a5f;
        }
        .btn-voltar:hover {
            background: #1e3a5f;
        }

        .acoes {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            gap: 10px;
        }

        .btn-secundario {
            padding: 10px 16px;
            background: #dc2626;
            color: #f0f3f5;
            text-decoration: none;
            border-radius: 25px;
            margin-top: 15px;
        }
        .titulo-selecao {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            color: white;
            margin-bottom: 30px;
        }

        .bandeira {
            width: 40px;
            height: 28px;
            object-fit: cover;
            border-radius: 4px;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Elenco da Seleção</h1>
        <h2 class="titulo-selecao">
            <img 
                src="<?= htmlspecialchars($selecao['bandeira'] ?? '') ?>" 
                alt="Bandeira de <?= htmlspecialchars($selecao['nome'] ?? '') ?>" 
                class="bandeira">
            <span><?= htmlspecialchars($selecao['nome'] ?? '') ?></span>
        </h2>

        <?php if (empty($jogadores)): ?>
            <p style="margin-top: 20px;">Nenhum jogador cadastrado para esta seleção.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Posição</th>
                        <th>Camisa</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jogadores as $j): ?>
                        <tr>
                            <td><?= htmlspecialchars($j['nome']) ?></td>
                            <td><?= htmlspecialchars($j['posicao']) ?></td>
                            <td><?= htmlspecialchars($j['numero_camisa']) ?></td>
                            <td>
                                <a href="index.php?action=editar-jogador&id=<?= $j['id'] ?>" class="btn"style="padding: 8px 16px; font-size: 14px;">Editar</a>
                                <a href="index.php?action=deletar-jogador&id=<?= $j['id'] ?>&selecao_id=<?= $selecao['id'] ?> "class="btn-secundario"  style="background: #dc2626; padding: 8px 16px; font-size: 14px;" onclick="return confirm('Tem certeza que deseja excluir este jogador?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <div class="acoes">
        <a href="index.php" class="btn-voltar">Voltar para Seleções</a>
        <a href="index.php?action=novo-jogador&selecao_id=<?= $selecao['id'] ?>" class="btn" >Adicionar Jogador</a>
    </div>

</body>
</html>