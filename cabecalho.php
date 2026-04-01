<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Produtos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Georgia, 'Times New Roman', serif;
            background: #f5f0eb;
            color: #2c2c2c;
            min-height: 100vh;
        }

        header {
            background: #1a1a2e;
            color: #e8d5b0;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #c9a84c;
        }

        header h1 {
            font-size: 1.6rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        header nav a {
            color: #e8d5b0;
            text-decoration: none;
            margin-left: 24px;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: color 0.2s;
        }

        header nav a:hover {
            color: #c9a84c;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 24px;
        }

        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-top: 4px solid #c9a84c;
            border-radius: 2px;
            padding: 36px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }

        h2 {
            font-size: 1.3rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #1a1a2e;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e0d8cc;
        }

        .msg-erro {
            background: #fdecea;
            color: #b00020;
            border: 1px solid #f5c6cb;
            padding: 10px 16px;
            border-radius: 2px;
            margin-bottom: 16px;
            font-size: 0.9rem;
        }

        .msg-sucesso {
            background: #eaf7ea;
            color: #1a7a2e;
            border: 1px solid #b8ddb8;
            padding: 10px 16px;
            border-radius: 2px;
            margin-bottom: 16px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<header>
    <h1>&#9670; Loja</h1>
    <nav>
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="produtos.php">Produtos</a>
            <a href="logout.php">Sair (<?php echo htmlspecialchars($_SESSION['usuario']); ?>)</a>
        <?php else: ?>
            <a href="index.php">Login</a>
        <?php endif; ?>
    </nav>
</header>
<main>
