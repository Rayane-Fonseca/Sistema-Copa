<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Seleção</title>
    <link rel="shortcut icon" href="../assets/ball.png" type="image/x-icon">
    <style>
        body{
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            background-size: cover;
            background-position: center;
            margin-top: 150px;
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
        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #304d6d;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 20px;
        }
        input { 
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
        label{
            color: #f0f3f5;
            font-weight: bold;
            margin-bottom: 6px;
            display: block;
        }
        h2{
            color: #f0f3f5;
            text-align: center;
        }
        .acoes {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            gap: 10px;
        }
        .btn {
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
        .info {
            background: #1e3a5f;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            color: #f0f3f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Seleção</h2>
        
        <div class="info">
            <strong><?= htmlspecialchars($time['nome']) ?></strong> 
            <small style="color: #94a3b8;">(Criado em <?= date('d/m/Y H:i', strtotime($time['criado_em'])) ?>)</small>
        </div>

        <form method="POST" action="index.php?action=atualizar">
            <input type="hidden" name="id" value="<?= htmlspecialchars($time['id']) ?>">
            
            <p>
                <label>Nome:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($time['nome']) ?>" required>
            </p>
            <p>
                <label>Grupo:</label>
                <input type="text" name="grupo" value="<?= htmlspecialchars($time['grupo']) ?>" required>
            </p>
            <p>
                <label>Títulos:</label>
                <input type="text" name="titulos" value="<?= htmlspecialchars($time['titulos']) ?>" required>
            </p>
            
            <div class="acoes">
                <a href="index.php" class="btn">Cancelar</a>
                <button type="submit" class="btn">Salvar Alterações</button>
            </div>
        </form>
    </div>
</body>
</html>