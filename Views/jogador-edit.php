<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jogador</title>
    <link rel="shortcut icon" href="../assets/ball.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            background: #f4f6f9;
            color: #1f2937;
            position: relative;
            margin-top: 200px;
        }

        body::before {
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

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #304d6d;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        h1, h2 {
            display: flex;
            justify-content: center;
            color: #f0f3f5;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 20px;
        }

        label {
            color: #f0f3f5;
            font-weight: bold;
            margin-bottom: 6px;
            display: block;
        }

        .grupo-campo {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #545e75;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            background:  #f0f3f5;
            color: #545e75;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.2);
        }

        .grupo-campo {
            display: flex;
            flex-direction: column;
        }

        .acoes {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            gap: 10px;
        }

        .btn, .btn-voltar {
            display: inline-block;
            padding: 10px 16px;
            background: #1e3a5f;
            color: #f0f3f5;
            text-decoration: none;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #1e3a5f;
        }

        .btn-secundario {
            display: inline-block;
            padding: 10px 16px;
            background: #64748b;
            color: #f0f3f5;
            text-decoration: none;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        .btn-secundario:hover {
            background: #475569;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Jogador</h1>

        <form action="index.php?action=atualizar-jogador" method="post">
            <input type="hidden" name="id" value="<?= $jogador['id'] ?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($jogador['nome']) ?>" required>

            <label>Posição</label>
            <input type="text" name="posicao" value="<?= htmlspecialchars($jogador['posicao']) ?>" required>

            <label>Número da Camisa</label>
            <input type="number" name="numero_camisa" min="1" max="99" value="<?= htmlspecialchars($jogador['numero_camisa']) ?>" required>

            <label>Seleção</label>
            <select name="selecao_id" required>
                <option value="">Selecione</option>
                <?php foreach ($todasSelecoes as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $jogador['selecao_id'] == $s['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="acoes">
                <a href="index.php" class="btn-voltar">Voltar</a>
                <button type="submit" class="btn">Atualizar Jogador</button>
            </div>
        </form>
    </div>
</body>
</html>