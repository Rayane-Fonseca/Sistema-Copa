<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            border-radius: 25px;
            overflow: hidden;
        }

        h1{
            text-align: center;
            color: #d9e2ec;
            margin-bottom: 20px;
        }

        .dashboard-tabela{
            width: 100%;
            border-collapse: collapse;
            border-radius: 25px;
        }

        .dashboard-tabela th,
        .dashboard-tabela td{
            padding: 12px;
            border: 1px solid #545e75;
            text-align: center;
        }

        .dashboard-tabela th{
            background: #1e3a5f;
            color: #d9e2ec;
            width: 50%;
        }

        .dashboard-tabela td{
            background: #304d6d;
            color: #d9e2ec;
        }

        .acoes {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            gap: 10px;
        }

        a {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 16px;
            background: #1e3a5f;
            color: #f0f3f5;
            width: 70px;
            height: 20px;
            text-decoration: none;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        a:hover {
            background: #304d6d;
        }

    </style>
</head>
<body>
    <h1>Dashboard</h1>

    <div class="container">
        


        <table class="dashboard-tabela">
            <tr>
                <th>Total de Seleções</th>
                <td><?= $dashboardTotalSelecoes ?></td>
            </tr>
            <tr>
                <th>Total de Títulos</th>
                <td><?= $dashboardTotalTitulos ?></td>
            </tr>

            <?php foreach ($dashboardPorGrupo as $item): ?>
                <tr>
                    <th>Grupo <?= htmlspecialchars($item['grupo']) ?></th>
                    <td><?= $item['total'] ?> seleções</td>
                </tr>
            <?php endforeach; ?>

        </table>

        <div class="acoes">
            <a href="index.php">Voltar</a>
        </div>
    </div>

</body>
</html>