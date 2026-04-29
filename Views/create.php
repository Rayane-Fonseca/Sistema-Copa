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

        .brand-text strong { 
            display: block; 
            font-size: 1.05rem; 
        }
        .brand-text span { 
            font-size: 0.78rem; 
            color: var(--accent-blue-soft); 
            font-weight: 700; 
            text-transform: uppercase; 
        }

        .page { 
            width: min(900px, calc(100% - 32px)); 
            margin: 0 auto; padding-top: 130px; 
            padding-bottom: 40px; 
        }

        .hero { 
            text-align: center; 
            margin-bottom: 28px; 
        }

        .hero-badge { 
            display: inline-flex; 
            padding: 8px 18px; 
            border-radius: 999px; 
            background: var(--btn-dark); 
            border: 1px solid var(--btn-dark-hover); 
            color: var(--text-light); 
            font-size: 0.92rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            margin-bottom: 16px; 
        }

        .hero h2 { 
            font-size: 65px; 
            text-transform: uppercase; 
            line-height: 1; 
            margin-bottom: 10px; 
        }

        .hero h2 span { 
            color: var(--accent-blue-light); 
        }

        .hero p { 
            color: var(--text-soft); 
            font-size: 1.05rem; 
        }

        .form-card { 
            background: rgba(7, 20, 38, 0.40); 
            border: 1px solid var(--card-border); 
            border-radius: 28px; padding: 32px; 
        }

        .card-header { 
            margin-bottom: 24px; 
        }

        .card-header h3 { 
            font-size: 1.4rem; 
            margin-bottom: 6px; 
        }

        .card-header p { 
            color: var(--text-soft); 
        }

        .mensagem { 
            margin-bottom: 20px; 
            padding: 14px 18px; 
            border-radius: 14px; 
            color: #fff; 
            font-weight: bold; 
            border: 1px solid var(--card-border); 
        }

        .mensagem.erro { 
            background: rgba(220, 38, 38, 0.88); 
        }

        .mensagem.sucesso { 
            background: rgba(37, 99, 235, 0.88); 
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
            font-weight: bold; 
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
        }

        .btn { 
            display: inline-flex; 
            align-items: center; 
            padding: 12px 18px; 
            border-radius: 12px; 
            text-decoration: none; 
            border: 1px solid var(--card-border); 
            font-size: 0.92rem; 
            font-weight: 600; 
            cursor: pointer; 
            transition: 0.25s; 
        }

        .btn-secondary { 
            background: var(--btn-dark); 
            color: #fff; 
        }

        .btn-primary { 
            background: var(--accent-blue-light); 
            color: var(--bg-dark); 
            border: none; 
            font-weight: 700; 
        }

        .btn:hover { 
            background: var(--btn-dark-hover); 
        }

        @media (max-width: 768px) {
            form { grid-template-columns: 1fr; }
            .acoes { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="brand-text">
            <strong>SISTEMA COPA</strong>
            <span>Cadastrar Seleção</span>
        </div>
        <a href="index.php" class="btn btn-secondary">Voltar ao painel</a>
    </header>

    <main class="page">
        <section class="hero">
            <div class="hero-badge">Copa do Mundo 2026</div>
            <h2>Nova Seleção</h2>
            <p>Adicione um novo time participante ao sistema.</p>
        </section>

        <section class="form-card">
            <div class="card-header">
                <h3>Dados da Nova Seleção</h3>
            </div>

            <?php if (!empty($msg)): ?>
                <div class="mensagem <?= $status === 'sucesso' ? 'sucesso' : 'erro' ?>">
                    <?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=salvar">
                <p>
                    <label for="nome">Nome</label>
                    <input id="nome" type="text" name="nome" required placeholder="Ex.: Brasil">
                </p>
                <p>
                    <label for="grupo">Grupo</label>
                    <input id="grupo" type="text" name="grupo" required placeholder="Ex.: Série A">
                </p>
                <p class="full">
                    <label for="titulos">Títulos</label>
                    <input id="titulos" type="text" name="titulos" placeholder="Ex.: 5">
                </p>
                <div class="acoes">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Seleção</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>