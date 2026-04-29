<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        .brand-text strong {
            display: block;
            font-size: 1.05rem;
            line-height: 1.1;
            color: var(--text-light);
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
            color: var(--text-light);
        }

        .hero h1 .destaque {
            color: var(--accent-blue-light);
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
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 22px;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card strong {
            font-size: 2rem;
            line-height: 1;
            margin-bottom: 8px;
            color: var(--text-light);
        }

        .stat-card span {
            color: var(--text-soft);
            font-size: 0.95rem;
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

        .table-label {
            color: var(--text-light);
            font-weight: 600;
        }

        .table-value {
            color: var(--accent-blue-soft);
            font-weight: 700;
        }

        .footer-actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        @media (max-width: 980px) {
            .stats-grid {
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
            .dashboard-panel {
                padding: 16px;
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
                min-width: 600px;
            }

            .footer-actions {
                justify-content: stretch;
            }

            .footer-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="brand">
            <div class="brand-text">
                <strong>SISTEMA COPA</strong>
                <span>Painel Dashboard</span>
            </div>
        </div>

        <div class="header-actions">
            <a href="index.php" class="btn">Ver Seleções</a>
            <a href="index.php?action=novo" class="btn btn-primary">Nova Seleção</a>
        </div>
    </header>

    <main class="page">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-badge">Copa do Mundo 2026</div>
                <h1>Painel Dashboard</h1>
                <p>Acompanhe os principais números e a distribuição das seleções cadastradas.</p>
            </div>
        </section>

        <section class="dashboard-panel">
            <div class="stats-grid">
                <div class="stat-card">
                    <strong><?= htmlspecialchars($dashboardTotalSelecoes) ?></strong>
                    <span>Total de Seleções</span>
                </div>

                <div class="stat-card">
                    <strong><?= htmlspecialchars($dashboardTotalTitulos) ?></strong>
                    <span>Total de Títulos</span>
                </div>
            </div>

            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>Indicador</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($dashboardPorGrupo as $item): ?>
                            <tr>
                                <td class="table-label">Grupo <?= htmlspecialchars($item['grupo']) ?></td>
                                <td class="table-value"><?= htmlspecialchars($item['total']) ?> seleções</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="footer-actions">
                <a href="index.php" class="btn">Voltar</a>
            </div>
        </section>
    </main>
</body>
</html>