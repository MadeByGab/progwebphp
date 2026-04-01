<?php
session_start();

// Se já estiver logado, redireciona para produtos
if (isset($_SESSION['usuario'])) {
    header("Location: produtos.php");
    exit;
}

include 'includes/conexao.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password  = $_POST['password'];

    // Busca o usuário no banco
    $query = pg_query($conn, "SELECT * FROM usuario WHERE username = '" . pg_escape_string($username) . "' AND status = true");

    if ($query && pg_num_rows($query) > 0) {
        $usuario = pg_fetch_assoc($query);

        // Compara senha (md5 conforme README usa varchar(32), típico de md5)
        if ($usuario['password'] === md5($password) || $usuario['password'] === $password) {
            $_SESSION['usuario'] = $usuario['username'];
            $_SESSION['idusuario'] = $usuario['idusuario'];
            header("Location: produtos.php");
            exit;
        } else {
            $erro = "Usuário ou senha inválidos.";
        }
    } else {
        $erro = "Usuário ou senha inválidos.";
    }

    pg_close($conn);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Loja</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Georgia, 'Times New Roman', serif;
            background: #1a1a2e;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: #fff;
            width: 100%;
            max-width: 380px;
            padding: 48px 40px;
            border-top: 5px solid #c9a84c;
            box-shadow: 0 8px 40px rgba(0,0,0,0.4);
        }

        .login-box h1 {
            font-size: 1.5rem;
            color: #1a1a2e;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .login-box p.sub {
            color: #888;
            font-size: 0.85rem;
            margin-bottom: 32px;
        }

        label {
            display: block;
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 2px;
            font-size: 1rem;
            font-family: inherit;
            margin-bottom: 20px;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #c9a84c;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #1a1a2e;
            color: #e8d5b0;
            border: none;
            font-family: inherit;
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s;
        }

        button[type="submit"]:hover {
            background: #c9a84c;
            color: #1a1a2e;
        }

        .erro {
            background: #fdecea;
            color: #b00020;
            border: 1px solid #f5c6cb;
            padding: 10px 14px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>&#9670; Loja</h1>
        <p class="sub">Acesse sua conta para continuar</p>

        <?php if ($erro): ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <label for="username">Usuário</label>
            <input type="text" id="username" name="username" required autofocus
                   value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
