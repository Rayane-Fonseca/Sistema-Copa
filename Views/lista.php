<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Seleções - Copa do Mundo</title>
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
            background-image: url(assets/fundo.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(2px);
            z-index: -1;
            transform: scale(1.05);
        }

        h1{
            display: flex;
            justify-content: center;
            color: white;
            margin-bottom: 30px;
        }

        .acoes {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn,
        .btn-dashboard {
            padding: 12px 20px;
            background: #304d6d;
            color: #f0f3f5;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn:hover,
        .btn-dashboard:hover {
            background: #1e3a5f;
        }

        .top-bar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 25px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filtro-grupo select{
            padding: 12px 16px;
            background: #304d6d;
            color: #f0f3f5;
            border: 2px solid #304d6d;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            min-width: 180px;
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
        
        .bandeira{ 
            border: 1px solid #545e75; 
            padding: 12px 10px; 
            background-color: #304d6d;
            color: #f0f3f5;
            text-align: left;
        }
        tr:hover td {
            background-color: #3a5a7a;
        }

        .paginacao {
            margin-top: 25px;
            text-align: center;
        }

        .paginacao a {
            display: inline-block;
            padding: 12px 24px;
            background: #304d6d;
            color: #f0f3f5;
            text-decoration: none;
            border-radius: 25px;
            margin: 0 5px;
        }

        .paginacao a:hover {
            background: #1e3a5f;
        }
    </style>
</head>
<body>
    <h1>Seleções Cadastradas</h1>
    
    <div class="acoes">
        <a href="index.php?action=novo" class="btn">+ Cadastrar Nova Seleção</a>
    </div>

    <div class="top-bar">
        <div class="dashboard">
            <a href="index.php?action=dashboard" class="btn-dashboard">Ver Dashboard</a>
        </div>

        <div class="filtro-grupo">
            <select onchange="window.location='?grupo='+encodeURIComponent(this.value)">
                <option value="">Todos os Grupos</option>
                <?php foreach ($grupos as $g): ?>
                    <option value="<?= htmlspecialchars($g) ?>" <?= $grupo == $g ? 'selected' : '' ?>>
                        Grupo <?= htmlspecialchars($g) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <?php if (empty($times)): ?>
        <p style="text-align: center; color: #f0f3f5; font-size: 18px;">Nenhuma seleção cadastrada ainda.
            <a href="index.php?action=novo" style="color: #60a5fa;">Cadastre a primeira!</a>
        </p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Grupo</th>
                    <th>Títulos</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead> 
            <tbody>
                <?php foreach ($times as $time): ?>
                <tr>
                    <td class="bandeira">
                        <?php if (!empty($time['bandeira'])): ?>
                            <img src="<?= htmlspecialchars($time['bandeira']) ?>" alt="Bandeira" style="width: 28px; height: 20px; vertical-align: middle; margin-right: 8px; border-radius: 2px; align-items: left;">
                        <?php endif; ?>
                        <?= htmlspecialchars($time['nome']) ?>
                    </td>
                    <td><?= htmlspecialchars($time['grupo']) ?></td>
                    <td><?= htmlspecialchars($time['titulos']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($time['criado_em'])) ?></td>
                    <td>
                        <a href="index.php?action=editar&id=<?= $time['id'] ?>" class="btn" style="padding: 8px 16px; font-size: 14px;">Editar</a>
                        <a href="index.php?action=deletar&id=<?= $time['id'] ?>" class="btn" style="background: #dc2626; padding: 8px 16px; font-size: 14px;"onclick="return confirm('Tem certeza que deseja excluir <?= htmlspecialchars($time['nome']) ?>?')">Excluir</a>
                        <a href="index.php?action=elenco&id=<?= $time['id'] ?>" class="btn" style="padding: 8px 16px; font-size: 14px;">Ver Elenco</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <?php 
        $mostraProxima = count($times) == 6 && $pagina < $totalPaginas;
        $mostraAnterior = $pagina > 1;
    ?>

    <?php if ($mostraProxima || $mostraAnterior): ?>
        <div class="paginacao">
            <?php if ($mostraAnterior): ?>
                <a href="?p=<?= $pagina - 1 ?>&grupo=<?= urlencode($grupo) ?>">Anterior</a>
            <?php endif; ?>
            
            <?php if ($mostraProxima): ?>
                <a href="?p=<?= $pagina + 1 ?>&grupo=<?= urlencode($grupo) ?>">Próxima</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>