<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            background-size: cover;
            background-position: center;
            margin-top: 220px;
        }

        body::before{
            content: "";
            position: fixed;
            inset: 0;
            background-image: url(assets/fundo.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(1px);
            z-index: -1;
            transform: scale(1.05);
        }

        .container{
            max-width: 700px;
            margin: 0 auto;
            background: #304d6d;
            padding: 20px;
            border-radius: 16px;
        }

        h1{
            text-align: center;
            color: #d9e2ec;
            margin-bottom: 20px;
        }

        .dashboard-tabela{
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-tabela th,
        .dashboard-tabela td{
            padding: 12px;
            border: 1px solid #545e75;
            text-align: left;
        }

        .dashboard-tabela th{
            background: #304d6d;
            color: #d9e2ec;
            width: 50%;
        }

        .dashboard-tabela td{
            background: #304d6d;
            color: #d9e2ec;
        }

        .btn-voltar{
            text-decoration: none;
            padding: 8px 14px;
            background: #1e3a5f;
            height: 30px;
            width: 90px;
            color: #d9e2ec;
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
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
    </div>
    <div class="btn-voltar">
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>