<!-- Modal de Exclusão -->
<div class="modal fade" id="delete-compra-modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Excluir Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir esta compra?</p>
                <p><strong>Esta ação não pode ser desfeita.</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a id="confirm-delete-button" href="#" class="btn btn-dark">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script>
// Configuração do modal de exclusão
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('delete-compra-modal');
    
    deleteModal.addEventListener('show.bs.modal', function(event) {
        // Botão que acionou o modal
        var button = event.relatedTarget;
        
        // Extrai o ID do atributo data-id
        var id = button.getAttribute('data-id');
        console.log('ID para exclusão:', id); // Para debug
        
        // Atualiza o link de confirmação com o ID correto
        var confirmButton = document.getElementById('confirm-delete-button');
        confirmButton.href = 'delete.php?id=' + id;
    });
});
</script>