<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copa do Mundo</title>
    <link rel="shortcut icon" href="../assets/soccer-ball.png" type="image/x-icon">
    <style>
        :root {
            --bg-dark: #061120;
            --bg-dark-2: #0b1f3a;
            --card-bg: rgba(20, 52, 92, 0.72);
            --card-border: rgba(147, 197, 253, 0.14);
            --accent-blue: #2563eb;
            --accent-blue-light: #60a5fa;
            --accent-blue-soft: #93c5fd;
            --text-light: #eaf2ff;
            --text-soft: #b6c6e3;
            --btn-dark: #102a4d;
            --btn-dark-hover: #163763;
            --danger: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg-dark);
            color: var(--text-light);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                linear-gradient(rgba(6, 17, 32, 0.22), rgba(6, 17, 32, 0.30)),
                url('assets/fundo.png') center/cover no-repeat;
            filter: brightness(0.95);
            z-index: -2;
        }
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            backdrop-filter: blur(1px);
            z-index: -1;
        }

        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 84px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            background: rgba(5, 16, 32, 0.88);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            backdrop-filter: blur(12px);
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--accent-yellow);
            color: #071426;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
        }

        .brand-text strong {
            display: block;
            font-size: 1.05rem;
            line-height: 1.1;
        }

        .brand-text span {
            font-size: 0.78rem;
            color: var(--accent-blue-soft);
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .page {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding-top: 120px;
            padding-bottom: 40px;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .hero-content {
            max-width: 900px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            background: var(--btn-dark);
            border: 1px solid var(--btn-dark-hover);
            color: var(--accent-yellow);
            font-size: 0.92rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: 65px;
            line-height: 0.95;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .hero h1 .destaque {
            color: var(--accent-yellow);
        }

        .hero p {
            color: var(--text-soft);
            font-size: 1.05rem;
        }

        .dashboard-panel {
            margin-top: 10px;
            background: rgba(7, 20, 38, 0.40);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.22);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 22px;
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card strong {
            font-size: 2rem;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-card span {
            color: var(--text-soft);
            font-size: 0.95rem;
        }

        .toolbar {
            display: grid;
            grid-template-columns: 1fr 240px;
            gap: 14px;
            margin-bottom: 20px;
        }

        .toolbar input,
        .toolbar select {
            width: 100%;
            height: 52px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(16, 39, 68, 0.82);
            color: var(--text-light);
            padding: 0 16px;
            outline: none;
        }

        .table-card {
            overflow: hidden;
            border-radius: 22px;
            border: 1px solid var(--card-border);
            background: rgba(8, 24, 44, 0.72);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(255,255,255,0.04);
        }

        th {
            text-align: center;
            padding: 18px 16px;
            color: #9fb0c0;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        td {
            text-align: center;
            padding: 18px 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
            color: var(--text-light);
            vertical-align: middle;
        }

        tbody tr:hover td {
            background: rgba(255,255,255,0.03);
        }

        .nome-time {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nome-time img {
            width: 28px;
            height: 20px;
            object-fit: cover;
            border-radius: 4px;
        }

        .acoes-tabela {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 10px 16px;
            border-radius: 12px;
            background: var(--btn-dark);
            color: #fff;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.08);
            font-size: 0.92rem;
            font-weight: 600;
            transition: 0.25s;
        }

        .btn:hover {
            background: var(--btn-dark-hover);
        }

        .btn-primary {
            background: var(--accent-blue-light);
            color: #071426;
            border: none;
        }

        .btn-primary:hover {
            background: var(--accent-blue-soft);
        }

        .btn-danger {
            background: rgba(220, 38, 38, 0.88);
            border: none;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .paginacao {
            margin-top: 24px;
            display: flex;
            justify-content: end;
            gap: 10px;
        }

        @media (max-width: 980px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .toolbar {
                grid-template-columns: 1fr;
            }

            .site-header {
                padding: 0 16px;
            }

            .header-actions {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
        }

        @media (max-width: 768px) {
            .hero {
                min-height: 260px;
            }

            .dashboard-panel {
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .site-header {
                height: auto;
                padding: 14px 16px;
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .page {
                padding-top: 130px;
            }

            .table-card {
                overflow-x: auto;
            }

            table {
                min-width: 900px;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="brand">
            <div class="brand-text">
                <strong>SISTEMA COPA</strong>
                <span>Por Rayane Fonseca</span>
            </div>
        </div>

        <div class="header-actions">
            <a href="index.php?action=dashboard" class="btn">Ver Dashboard</a>
            <a href="index.php?action=novo" class="btn btn-primary">Nova Seleção</a>
        </div>
    </header>

    <main class="page">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-badge">Copa do Mundo 2026</div>
                <h1>Seleções <span class="destaque">Cadastradas</span></h1>
                <p>Gerencie todas as seleções participantes da Copa do Mundo.</p>
            </div>
        </section>

        <section class="dashboard-panel">

            <div class="toolbar">
                <input type="text" placeholder="Buscar seleção..." />
                <select onchange="window.location='?grupo='+encodeURIComponent(this.value)">
                    <option value="">Todos os Grupos</option>
                    <?php foreach ($grupos as $g): ?>
                        <option value="<?= htmlspecialchars($g) ?>" <?= $grupo == $g ? 'selected' : '' ?>>
                            Grupo <?= htmlspecialchars($g) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if (empty($times)): ?>
                <p style="text-align:center; color:#f0f3f5; padding: 30px 0;">
                    Nenhuma seleção cadastrada.
                </p>
            <?php else: ?>
                <div class="table-card">
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
                                    <td>
                                        <div class="nome-time">
                                            <?php if (!empty($time['bandeira'])): ?>
                                                <img src="<?= htmlspecialchars($time['bandeira']) ?>" alt="Bandeira de <?= htmlspecialchars($time['nome']) ?>">
                                            <?php endif; ?>
                                            <span><?= htmlspecialchars($time['nome']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($time['grupo']) ?></td>
                                    <td><?= htmlspecialchars($time['titulos']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($time['criado_em'])) ?></td>
                                    <td>
                                        <div class="acoes-tabela">
                                            <a href="index.php?action=editar&id=<?= $time['id'] ?>" class="btn">Editar</a>
                                            <a href="index.php?action=deletar&id=<?= $time['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir <?= htmlspecialchars($time['nome']) ?>?')">Excluir</a>
                                            <a href="index.php?action=elenco&selecao_id=<?= $time['id'] ?>" class="btn">Elenco</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php
                $mostraProxima = count($times) == 4 && $pagina < $totalPaginas;
                $mostraAnterior = $pagina > 1;
            ?>

            <?php if ($mostraProxima || $mostraAnterior): ?>
                <div class="paginacao">
                    <?php if ($mostraAnterior): ?>
                        <a href="?p=<?= $pagina - 1 ?>&grupo=<?= urlencode($grupo) ?>" class="btn">Anterior</a>
                    <?php endif; ?>

                    <?php if ($mostraProxima): ?>
                        <a href="?p=<?= $pagina + 1 ?>&grupo=<?= urlencode($grupo) ?>" class="btn">Próxima</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>