<?php
$status = $_GET['status'] ?? '';
$msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Seleção</title>
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

        .btn:hover {
            background: #304d6d;
        }
        
        .mensagem {
            max-width: 500px;
            margin: 0 auto 20px auto;
            padding: 14px 18px;
            border-radius: 14px;
            color: #fff;
            font-weight: bold;
        }
        .mensagem.erro {
            background: #b91c1c;
        }
        .mensagem.sucesso {
            background: #166534;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2>Cadastrar Seleção</h2>

        <?php if (!empty($msg)): ?>
            <div class="mensagem <?= $status === 'sucesso' ? 'sucesso' : 'erro' ?>">
                <?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=salvar">
            <p>
                <label>Nome:</label>
                <input type="text" name="nome" required placeholder="Ex.: Brasil">
            </p>
            <p>
                <label>Grupo:</label>
                <input type="text" name="grupo" required placeholder="Ex.: Série A">
            </p>
            <p>
                <label>Títulos:</label>
                <input type="text" name="titulos" placeholder="Ex.: 5 Copas, 2 Libertadores">
            </p>
                
            <div class="acoes">
                <a href="index.php" class="btn">Voltar</a>
                <button type="submit" class="btn">Salvar Time</button>
            </div>
        </form>
    </div>
</body>
</html>