<?php 
    require_once('functions.php'); 
    edit(); 
?>
<?php include(HEADER_TEMPLATE); ?>

<h2>Atualizar Compra</h2>

<form action="edit.php?id=<?php echo $compra['id']; ?>" method="post" enctype="multipart/form-data">
  <hr />
  <input type="hidden" name="compra[id]" value="<?php echo $compra['id']; ?>">

  <div class="row">
    <div class="form-group col-md-6">
      <label>Produto *</label>
      <input type="text" class="form-control" name="compra[produto]" value="<?php echo $compra['produto']; ?>" required>
    </div>

    <div class="form-group col-md-6">
      <label>Forma de Pagamento *</label>
      <select class="form-control" name="compra[formaPgto]" required>
        <option value="">Selecione...</option>
        <option value="Dinheiro" <?php echo ($compra['formaPgto'] == 'Dinheiro') ? 'selected' : ''; ?>>Dinheiro</option>
        <option value="Cartão de Crédito" <?php echo ($compra['formaPgto'] == 'Cartão de Crédito') ? 'selected' : ''; ?>>Cartão de Crédito</option>
        <option value="Cartão de Débito" <?php echo ($compra['formaPgto'] == 'Cartão de Débito') ? 'selected' : ''; ?>>Cartão de Débito</option>
        <option value="PIX" <?php echo ($compra['formaPgto'] == 'PIX') ? 'selected' : ''; ?>>PIX</option>
        <option value="Transferência Bancária" <?php echo ($compra['formaPgto'] == 'Transferência Bancária') ? 'selected' : ''; ?>>Transferência Bancária</option>
        <option value="Boleto" <?php echo ($compra['formaPgto'] == 'Boleto') ? 'selected' : ''; ?>>Boleto</option>
        <option value="Outro" <?php echo ($compra['formaPgto'] == 'Outro') ? 'selected' : ''; ?>>Outro</option>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-6">
      <label>Data da Compra *</label>
      <input type="datetime-local" class="form-control" name="compra[dataCompras]" 
             id="dataCompras" value="<?php echo date('Y-m-d\TH:i', strtotime($compra['dataCompras'])); ?>" required
             onchange="validarData(this, 'dataCompras')">
      <small class="text-muted">Formato: DD/MM/AAAA HH:MM</small>
    </div>
    <div class="form-group col-md-6">
      <label>Data de Recebimento</label>
      <input type="datetime-local" class="form-control" name="compra[dataRecebto]" 
             id="dataRecebto" value="<?php echo $compra['dataRecebto'] ? date('Y-m-d\TH:i', strtotime($compra['dataRecebto'])) : ''; ?>"
             onchange="validarData(this, 'dataRecebto')">
      <small class="text-muted">Formato: DD/MM/AAAA HH:MM</small>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-12">
      <label>Observações</label>
      <textarea class="form-control" name="compra[obs]" rows="3"><?php echo $compra['obs']; ?></textarea>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-12">
      <label>Imagem do Produto</label><br>
      <?php if (!empty($compra['imagemProduto']) && $compra['imagemProduto'] != 'semimagem.png') : ?>
        <img src="../imagens/<?php echo $compra['imagemProduto']; ?>" width="120" class="img-thumbnail mb-2"><br>
      <?php else : ?>
        <span class="text-muted">Sem imagem</span><br>
      <?php endif; ?>
      <input type="file" class="form-control mt-2" name="imagem" accept="image/*">
      <small class="text-muted">Deixe em branco para manter a imagem atual</small>
    </div>
  </div>

  <div id="actions" class="row mt-3">
    <div class="col-md-12">
      <button type="submit" class="btn btn-dark">Salvar</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
  </div>
</form>

<script>
function validarData(input, campo) {
    const dataValue = input.value;
    if (!dataValue) return true;
    
    const data = new Date(dataValue);
    const agora = new Date();
    
    // Validar se é uma data válida
    if (isNaN(data.getTime())) {
        alert('Por favor, insira uma data válida.');
        input.value = '';
        return false;
    }
    
    // Validar se a data não é futura (para compras)
    if (campo === 'dataCompras' && data > agora) {
        if (!confirm('A data da compra é futura. Deseja continuar?')) {
            input.value = '';
            return false;
        }
    }
    
    // Validar se data de recebimento é anterior à data de compra
    if (campo === 'dataRecebto' && dataValue) {
        const dataCompra = document.getElementById('dataCompras').value;
        if (dataCompra && new Date(dataValue) < new Date(dataCompra)) {
            if (!confirm('A data de recebimento é anterior à data da compra. Deseja continuar?')) {
                input.value = '';
                return false;
            }
        }
    }
    
    return true;
}

// Formatação automática para campos de data
document.addEventListener('DOMContentLoaded', function() {
    const dataInputs = document.querySelectorAll('input[type="datetime-local"]');
    dataInputs.forEach(input => {
        input.addEventListener('blur', function() {
            validarData(this, this.id);
        });
    });
});
</script>

<?php include(FOOTER_TEMPLATE); ?>