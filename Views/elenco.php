<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco da Seleção</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            background: #1e3a5f;
            color: #f0f3f5;
        }

        h1, h2{
            text-align: center;
        }

        .topo{
            text-align: center;
            margin-bottom: 25px;
        }

        .topo a{
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background: #304d6d;
            color: #f0f3f5;
            border-radius: 20px;
            text-decoration: none;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 20px;
        }

        th{
            background: #1e3a5f;
            color: #fff;
            padding: 12px;
            border: 1px solid #556;
        }

        td{
            background: #304d6d;
            padding: 12px;
            border: 1px solid #556;
            color: #fff;
        }

        .btn{
            display: inline-block;
            padding: 8px 14px;
            border-radius: 16px;
            text-decoration: none;
            color: #fff;
            background: #0f63a8;
            font-size: 14px;
        }

        .btn-excluir{
            background: #dc2626;
        }
    </style>
</head>
<body>
    <h1>Elenco da Seleção</h1>

    <div class="topo">
        <h2><?= htmlspecialchars($selecao['nome']) ?></h2>
        <p>Grupo <?= htmlspecialchars($selecao['grupo']) ?> | Títulos: <?= htmlspecialchars($selecao['titulos']) ?></p>
        <a href="index.php">Voltar para seleções</a>
    </div>

    <?php if (empty($jogadores)): ?>
        <p style="text-align:center;">Nenhum jogador cadastrado para esta seleção.</p>
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
                <?php foreach ($jogadores as $jogador): ?>
                <tr>
                    <td><?= htmlspecialchars($jogador['nome']) ?></td>
                    <td><?= htmlspecialchars($jogador['posicao']) ?></td>
                    <td><?= htmlspecialchars($jogador['numero_camisa']) ?></td>
                    <td>
                        <a href="index.php?action=editar-jogador&id=<?= $jogador['id'] ?>" class="btn">Editar</a>
                        <a href="index.php?action=deletar-jogador&id=<?= $jogador['id'] ?>" class="btn btn-excluir"
                           onclick="return confirm('Deseja excluir este jogador?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>