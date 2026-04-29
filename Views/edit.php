<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Seleção</title>
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
            cursor: pointer;
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
            width: min(980px, calc(100% - 32px));
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
            color: var(--text-light);
            font-size: 0.92rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 6vw, 4.2rem);
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

        .form-card { 
            background: rgba(7, 20, 38, 0.40); 
            border: 1px solid var(--card-border); 
            border-radius: 28px; 
            padding: 32px; }

        .card-header {
            margin-bottom: 24px;
        }

        .card-header h3 {
            font-size: 1.4rem;
            color: var(--text-light);
            margin-bottom: 6px;
        }

        .card-header p {
            color: var(--text-soft);
            font-size: 0.95rem;
        }

        .info {
            background: rgba(8, 24, 44, 0.72);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 18px;
            margin-bottom: 22px;
        }

        .info strong {
            display: block;
            color: var(--text-light);
            font-size: 1.05rem;
            margin-bottom: 6px;
        }

        .info small {
            color: var(--text-soft);
            font-size: 0.9rem;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            color: var(--text-light);
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            height: 52px;
            padding: 0 16px;
            border: 1px solid var(--card-border);
            border-radius: 14px;
            font-size: 15px;
            outline: none;
            background: rgba(234, 242, 255, 0.96);
            color: var(--bg-dark-2);
            transition: 0.25s;
        }

        input:focus {
            border-color: var(--accent-blue-light);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.20);
        }

        .acoes {
            grid-column: 1 / -1;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        @media (max-width: 980px) {
            .site-header {
                padding: 0 16px;
            }

            .header-actions {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
        }

        @media (max-width: 768px) {
            .site-header {
                height: auto;
                padding: 14px 16px;
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .page {
                width: min(100% - 20px, 1000px);
                padding-top: 130px;
            }

            .form-card {
                padding: 20px;
                border-radius: 22px;
            }

            form {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .acoes {
                grid-column: auto;
                flex-direction: column;
            }

            .acoes .btn {
                width: 100%;
            }

            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="brand">
            <div class="brand-text">
                <strong>SISTEMA COPA</strong>
                <span>Editar Seleção</span>
            </div>
        </div>

        <div class="header-actions">
            <a href="index.php" class="btn">Ver Seleções</a>
        </div>
    </header>

    <main class="page">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-badge">Copa do Mundo 2026</div>
                <h1>Editar Seleção</h1>
                <p>Atualize os dados da equipe.</p>
            </div>
        </section>

        <section class="form-card">
            <div class="card-header">
                <h3>Alteração de Dados</h3>
            </div>

            <div class="info">
                <strong><?= htmlspecialchars($time['nome']) ?></strong>
                <small>Criado em <?= date('d/m/Y H:i', strtotime($time['criado_em'])) ?></small>
            </div>

            <form method="POST" action="index.php?action=atualizar">
                <input type="hidden" name="id" value="<?= htmlspecialchars($time['id']) ?>">

                <p>
                    <label for="nome">Nome</label>
                    <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($time['nome']) ?>" required>
                </p>

                <p>
                    <label for="grupo">Grupo</label>
                    <input id="grupo" type="text" name="grupo" value="<?= htmlspecialchars($time['grupo']) ?>" required>
                </p>

                <p class="full">
                    <label for="titulos">Títulos</label>
                    <input id="titulos" type="text" name="titulos" value="<?= htmlspecialchars($time['titulos']) ?>" required>
                </p>

                <div class="acoes">
                    <a href="index.php" class="btn">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </section>
    </main>

</body>
</html>