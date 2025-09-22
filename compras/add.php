<?php 
    require_once('functions.php'); 
    add(); 
?>
<?php include(HEADER_TEMPLATE); ?>

<h2>Nova Compra</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
  <hr />
  <div class="row">
    <div class="form-group col-md-6">
      <label for="name">Produto *</label>
      <input type="text" class="form-control" name="compra[produto]" required>
    </div>

    <div class="form-group col-md-6">
      <label for="campo2">Forma de Pagamento *</label>
      <select class="form-control" name="compra[formaPgto]" required>
        <option value="">Selecione...</option>
        <option value="Dinheiro">Dinheiro</option>
        <option value="Cartão de Crédito">Cartão de Crédito</option>
        <option value="Cartão de Débito">Cartão de Débito</option>
        <option value="PIX">PIX</option>
        <option value="Transferência Bancária">Transferência Bancária</option>
        <option value="Boleto">Boleto</option>
        <option value="Outro">Outro</option>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-6">
      <label>Data da Compra *</label>
      <input type="datetime-local" class="form-control" name="compra[dataCompras]" 
             id="dataCompras" required 
             onchange="validarData(this, 'dataCompras')">
      <small class="text-muted">Formato: DD/MM/AAAA HH:MM</small>
    </div>
    <div class="form-group col-md-6">
      <label>Data de Recebimento</label>
      <input type="datetime-local" class="form-control" name="compra[dataRecebto]" 
             id="dataRecebto" 
             onchange="validarData(this, 'dataRecebto')">
      <small class="text-muted">Formato: DD/MM/AAAA HH:MM</small>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-12">
      <label>Observações</label>
      <textarea class="form-control" name="compra[obs]" rows="3"></textarea>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-12">
      <label>Imagem do Produto</label>
      <input type="file" class="form-control" name="imagem" accept="image/*">
      <small class="text-muted">Formatos aceitos: JPG, PNG, GIF (opcional)</small>
    </div>
  </div>

  <div id="actions" class="row mt-3">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
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