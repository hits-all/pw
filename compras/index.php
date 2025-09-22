<?php
    require_once('functions.php');
    index();
?>
<?php include(HEADER_TEMPLATE); ?>

<header class="mt-5 pt-2">
    <div class="row">
        <div class="col-sm-6">
            <h2>Compras</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-cart-plus"></i> Nova Compra</a>
            <a class="btn btn-light" href="index.php"><i class="fa-solid fa-arrows-rotate"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<!-- Barra de Pesquisa - Estilo Plantas -->
<div class="row mb-3">
    <div class="col-md-12">
        <form method="get" action="index.php" class="form-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Pesquisar por ID, produto ou forma de pagamento..." 
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-dark">
                        <i class="fa-solid fa-search"></i> Pesquisar
                    </button>
                    <?php if (!empty($_GET['search'])) : ?>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fa-solid fa-times"></i> Limpar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
        <?php if (!empty($_GET['search'])) : ?>
            <small class="text-muted">
                Resultados para: "<?php echo htmlspecialchars($_GET['search']); ?>"
                <?php if ($compras) : ?>
                    - <?php echo count($compras); ?> registro(s) encontrado(s)
                <?php endif; ?>
            </small>
        <?php endif; ?>
    </div>
</div>

<hr>

<table class="table table-hover">
<thead>
    <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Forma Pgto</th>
        <th>Data Compra</th>
        <th>Recebimento</th>
        <th>Imagem</th>
        <th>Opções</th>
    </tr>
</thead>
<tbody>
<?php if ($compras) : ?>
<?php foreach ($compras as $compra) : ?>
    <tr>
        <td><?php echo $compra['id']; ?></td>
        <td><?php echo $compra['produto']; ?></td>
        <td><?php echo $compra['formaPgto']; ?></td>
        <td><?php echo formataData($compra['dataCompras'], "d/m/Y H:i"); ?></td>
        <td><?php echo formataData($compra['dataRecebto'], "d/m/Y H:i"); ?></td>
        <td>
            <?php if (!empty($compra['imagemProduto']) && $compra['imagemProduto'] != 'semimagem.png') : ?>
                <img src="../imagens/<?php echo $compra['imagemProduto']; ?>" width="60" class="img-thumbnail">
            <?php else : ?>
                <span class="text-muted">Sem imagem</span>
            <?php endif; ?>
        </td>
        <td class="actions text-right">
            <a href="view.php?id=<?php echo $compra['id']; ?>" class="btn btn-sm btn-dark"><i class="fa-solid fa-eye"></i> Visualizar</a>
            <a href="edit.php?id=<?php echo $compra['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
            <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-compra-modal" data-id="<?php echo $compra['id']; ?>">
                <i class="fa-solid fa-eraser"></i> Excluir
            </a>
        </td>
    </tr>
<?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="7">
            <?php if (!empty($_GET['search'])) : ?>
                Nenhum registro encontrado para "<?php echo htmlspecialchars($_GET['search']); ?>"
            <?php else : ?>
                Nenhum registro encontrado.
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>
</tbody>
</table>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>