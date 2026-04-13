<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Time</title>
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
    </style>
</head>
<body>
    <h1>Novo Time</h1>
    <form method="POST" action="index.php?action=salvar">
        <p>
            <label>Nome:</label>
            <input type="text" name="nome" required placeholder="Ex: Brasil">
        </p>
        <p>
            <label>Grupo:</label>
            <input type="text" name="grupo" required placeholder="Ex: Série A">
        </p>
        <p>
            <label>Títulos:</label>
            <input type="text" name="titulos" placeholder="Ex: 5 Copas, 2 Libertadores">
        </p>
        
        <div class="acoes">
            <a href="index.php" class="btn">Voltar</a>
            <button type="submit" class="btn">Salvar Time</button>
        </div>
    </form>
</body>
</html>