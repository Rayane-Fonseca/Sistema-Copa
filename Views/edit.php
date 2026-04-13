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
        }
        body::before{
            content: "";
            position: fixed;
            inset: 0;
            background-image: url(assets/fundo3.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(2px);
            z-index: -1;
            transform: scale(1.05);
        }
        input { 
            border: 1px solid #545e75; 
            padding: 10px;
            width: 100%;
            max-width: 400px;
            text-align: left; 
            background-color: #304d6d;
            color: #f0f3f5;
            border-radius: 25px;
            box-sizing: border-box;
        }
        label{
            color: #f0f3f5;
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        h1{
            display: flex;
            justify-content: center;
            color: white;
        }
        h2{
            color: #f0f3f5;
        }
        .acoes{
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 24px;
            background: #304d6d;
            color: #f0f3f5;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #1e3a5f;
        }
        p {
            margin-bottom: 20px;
        }
        form {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            padding: 30px;
            border-radius: 25px;
            text-align: center;
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
</body>
</html>