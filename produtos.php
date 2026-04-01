<?php
session_start();

// Protege a página — só acessa quem está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

include 'includes/conexao.php';
include 'includes/cabecalho.php';
?>

<div class="card">
    <h2>Lista de Produtos</h2>

    <?php
    $resultado = pg_query($conn, "SELECT * FROM produto ORDER BY idproduto");

    if (!$resultado || pg_num_rows($resultado) === 0):
    ?>
        <p style="color:#888; font-size:0.95rem;">Nenhum produto cadastrado.</p>
    <?php else: ?>

    <style>
        .tabela-produtos {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .tabela-produtos thead tr {
            background: #1a1a2e;
            color: #e8d5b0;
        }

        .tabela-produtos th {
            padding: 12px 16px;
            text-align: left;
            letter-spacing: 1px;
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: normal;
        }

        .tabela-produtos td {
            padding: 11px 16px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .tabela-produtos tbody tr:hover {
            background: #faf7f2;
        }

        .tabela-produtos tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
        }

        .badge.ativo {
            background: #eaf7ea;
            color: #1a7a2e;
            border: 1px solid #b8ddb8;
        }

        .badge.inativo {
            background: #f5f5f5;
            color: #888;
            border: 1px solid #ddd;
        }

        .produto-foto {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 2px;
            border: 1px solid #ddd;
        }

        .sem-foto {
            width: 50px;
            height: 50px;
            background: #f0ebe3;
            border: 1px solid #ddd;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #bbb;
            font-size: 1.2rem;
            border-radius: 2px;
        }

        .total-info {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 16px;
        }
    </style>

    <p class="total-info"><?php echo pg_num_rows($resultado); ?> produto(s) encontrado(s)</p>

    <table class="tabela-produtos">
        <thead>
            <tr>
                <th><input type="checkbox" name="todos" id="chkTodos"></th>
                <th>ID</th>
                <th>Foto</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($linha = pg_fetch_assoc($resultado)): ?>
            <tr>
                <td><input type="checkbox" name="selecionado[]" value="<?php echo $linha['idproduto']; ?>"></td>
                <td style="color:#aaa; font-size:0.85rem;">#<?php echo $linha['idproduto']; ?></td>
                <td>
                    <?php if (!empty($linha['produtofoto'])): ?>
                        <img src="<?php echo htmlspecialchars($linha['produtofoto']); ?>"
                             alt="Foto" class="produto-foto">
                    <?php else: ?>
                        <span class="sem-foto">&#9670;</span>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($linha['produtonome']); ?></td>
                <td>R$ <?php echo number_format((float)$linha['produtopreco'], 2, ',', '.'); ?></td>
                <td>
                    <?php if ($linha['produtostatus'] === 't'): ?>
                        <span class="badge ativo">Ativo</span>
                    <?php else: ?>
                        <span class="badge inativo">Desativado</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        // Marcar/desmarcar todos os checkboxes
        document.getElementById('chkTodos').addEventListener('change', function() {
            var checks = document.querySelectorAll('input[name="selecionado[]"]');
            checks.forEach(function(c) { c.checked = this.checked; }, this);
        });
    </script>

    <?php endif; ?>
</div>

<?php
pg_close($conn);
include 'includes/rodape.php';
?>
