<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jogador</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 30px auto;
            background: #1e3a5f;
            color: #f0f3f5;
        }

        h1{
            text-align: center;
            margin-bottom: 30px;
        }

        form{
            background: #304d6d;
            padding: 25px;
            border-radius: 20px;
        }

        label{
            display: block;
            margin-bottom: 6px;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select{
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button, a{
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        button{
            background: #0f63a8;
            color: #fff;
        }

        a{
            background: #555;
            color: #fff;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>Editar Jogador</h1>

    <form action="index.php?action=atualizar-jogador" method="POST">
        <input type="hidden" name="id" value="<?= $jogador['id'] ?>">

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($jogador['nome']) ?>" required>

        <label for="posicao">Posição</label>
        <input type="text" name="posicao" id="posicao" value="<?= htmlspecialchars($jogador['posicao']) ?>" required>

        <label for="numero_camisa">Número da camisa</label>
        <input type="number" name="numero_camisa" id="numero_camisa" value="<?= htmlspecialchars($jogador['numero_camisa']) ?>" required>

        <label for="selecao_id">Seleção</label>
        <select name="selecao_id" id="selecao_id" required>
            <option value="">Selecione</option>
            <?php foreach ($selecoes as $selecao): ?>
                <option value="<?= $selecao['id'] ?>" <?= $jogador['selecao_id'] == $selecao['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($selecao['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Atualizar Jogador</button>
        <a href="index.php">Voltar</a>
    </form>
</body>
</html>