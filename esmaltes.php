<?php
// Começar a sessão
session_start();

// Se não está logado, vai para o login
if (!isset($_SESSION['usuario'])) { 
    header('Location: login.php'); 
    exit(); 
}

// Conectar no banco
include 'config.php';
include 'funcoes_estoque.php';

// Pegar o que o usuário digitou na busca
$texto_busca = $_GET['busca'] ?? '';

// Se o usuário clicou em "Cadastrar"
if ($_POST['add'] ?? false) {
    $nome_esmalte = $_POST['nome'];
    $cores_esmalte = $_POST['cores'];
    $preco_esmalte = $_POST['preco'];
    $categorias_esmalte = $_POST['categorias'];
    $marcas_esmalte = $_POST['marcas'];
    $estoque_minimo_esmalte = $_POST['estoque_minimo'];
    
    // Inserir novo esmalte no banco
    $sql = "INSERT INTO esmaltes (nome, cores, preco, categorias, marcas, estoque_minimo) 
            VALUES ('$nome_esmalte', '$cores_esmalte', $preco_esmalte, '$categorias_esmalte', '$marcas_esmalte', $estoque_minimo_esmalte)";
    $conn->query($sql);
    
    // Voltar para a mesma página
    header("Location: esmalte.php");
    exit();
}

// Buscar esmaltes no banco
if ($texto_busca) {
    $sql = "SELECT * FROM esmaltes WHERE nome LIKE '%$texto_busca%' OR cores LIKE '%$texto_busca%' ORDER BY nome";
} else {
    $sql = "SELECT * FROM esmaltes ORDER BY nome";
}
$resultado_esmaltes = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Catálogo - Sistema Studio D.I.Y</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Catálogo</h1>

        <div style="background: #f9f9f9; padding: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
            <form method="get" style="display: flex; gap: 10px;">
                <input name="busca" placeholder="Buscar..." value="<?= htmlspecialchars($texto_busca) ?>" style="flex: 1; padding: 8px;">
                <button type="submit" class="btn">Buscar</button>
                <a href="index.php" class="btn">Voltar</a>
            </form>
        </div>

        <table>
            <tr><th>Nome</th><th>Cores</th><th>Preço</th><th>Categorias</th><th>Marcas</th><th>Estoque</th><th>Ações</th></tr>
            <?php 
            // Mostrar cada esmalte na tabela
            while($esmalte = $resultado_esmaltes->fetch_assoc()): 
                $esmalte_id = $esmalte['id'];
                
                // Calcular estoque atual deste esmalte
                $sql_entradas = "SELECT SUM(quantidade) as total FROM movimentacoes WHERE esmalte_id = $esmalte_id AND tipo = 'entrada'";
                $entradas = $conn->query($sql_entradas)->fetch_assoc();
                $total_entradas = $entradas['total'] ? $entradas['total'] : 0;
                
                $sql_saidas = "SELECT SUM(quantidade) as total FROM movimentacoes WHERE esmalte_id = $esmalte_id AND tipo = 'saida'";
                $saidas = $conn->query($sql_saidas)->fetch_assoc();
                $total_saidas = $saidas['total'] ? $saidas['total'] : 0;
                
                $estoque_atual = $total_entradas - $total_saidas;
                $estoque_minimo = $esmalte['estoque_minimo'];
                
                // Verificar se estoque está baixo
                $estoque_baixo = $estoque_atual <= $estoque_minimo;
            ?>
                <tr class="<?= $estoque_baixo ? 'estoque-baixo' : 'estoque-ok' ?>">
                    <td><span class="status-indicator <?= $estoque_baixo ? 'status-baixo' : 'status-ok' ?>"></span><?= htmlspecialchars($esmalte['nome']) ?></td>
                    <td><?= htmlspecialchars($esmalte['cores']) ?></td>
                    <td>R$ <?= number_format($esmalte['preco'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($esmalte['categorias']) ?></td>
                    <td><?= htmlspecialchars($esmalte['marcas']) ?></td>
                    <td><strong><?= $estoque_atual ?></strong>/<?= $estoque_minimo ?><?= $estoque_baixo ? '<br><small>⚠️ Baixo!</small>' : '' ?></td>
                    <td>
                        <a href="editar_esmalte.php?id=<?= $esmalte['id'] ?>" class="btn" style="padding: 3px 8px; font-size: 11px;">Editar</a>
                        <a href="deletar_esmalte.php?id=<?= $esmalte['id'] ?>" class="btn" style="padding: 3px 8px; font-size: 11px;" onclick="return confirm('Excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div style="background: #f9f9f9; padding: 15px; border: 1px solid #ddd;">
            <h3>Adicionar Esmalte</h3>
            <form method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Preço:</label>
                        <input type="number" name="preco" step="0.01" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Categorias:</label>
                        <select name="categorias" required>
                            <option value="">Selecione</option>
                            <option value="Pequena">Cremoso</option>
                            <option value="Media">Metálico</option>
                            <option value="Grande">Glitter</option>
                            <option value="Grande">Perolado</option>
                            <option value="Grande">Fosco</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Marcas:</label>
                        <input type="text" name="marcas" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Estoque Mínimo:</label>
                        <input type="number" name="estoque_minimo" min="0" value="5" required>
                    </div>
                    <div class="form-group">
                        <label>Cores:</label>
                        <textarea name="cores" required></textarea>
                    </div>
                </div>
                <button type="submit" name="add" class="btn">Cadastrar</button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 15px;">
            <a href="movimentacoes.php" class="btn">Movimentações</a>
        </div>
    </div>
</body>
</html>