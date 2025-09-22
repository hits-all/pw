<?php 
    require_once('functions.php'); 
    if (isset($_GET['id'])) view($_GET['id']); 
?>
<?php include(HEADER_TEMPLATE); ?>

<h2>Detalhes da Compra</h2>
<hr>

<dl class="dl-horizontal">
    <dt>ID:</dt>
    <dd><?php echo $compra['id']; ?></dd>

    <dt>Produto:</dt>
    <dd><?php echo $compra['produto']; ?></dd>

    <dt>Forma de Pagamento:</dt>
    <dd><?php echo $compra['formaPgto']; ?></dd>

    <dt>Data da Compra:</dt>
    <dd><?php echo formataData($compra['dataCompras'], "d/m/Y H:i"); ?></dd>

    <dt>Data de Recebimento:</dt>
    <dd><?php echo $compra['dataRecebto'] ? formataData($compra['dataRecebto'], "d/m/Y H:i") : "-"; ?></dd>

    <dt>Observações:</dt>
    <dd><?php echo $compra['obs']; ?></dd>

    <dt>Imagem:</dt>
    <dd><img src="../imagens/<?php echo $compra['imagemProduto']; ?>" width="200"></dd>
</dl>

<div id="actions" class="row">
    <div class="col-md-12">
        <a href="edit.php?id=<?php echo $compra['id']; ?>" class="btn btn-dark">Editar</a>
        <a href="index.php" class="btn btn-light">Voltar</a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
