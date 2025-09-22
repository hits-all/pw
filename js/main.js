// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function () {
  const deleteModal = document.getElementById('delete-modal');

  if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget; // Botão que abriu o modal
      const id = button.getAttribute('data-customer'); // Pega o ID do cliente

      // Seleciona elementos dentro do modal
      const modalTitle = deleteModal.querySelector('.modal-title');
      const modalBody = deleteModal.querySelector('.modal-body');
      const confirmButton = deleteModal.querySelector('#confirm');

      // Atualiza conteúdo do modal
      modalTitle.textContent = 'Excluir Cliente: ' + id;
      modalBody.textContent = 'Deseja realmente excluir o cliente ' + id + '?';
      confirmButton.setAttribute('href', 'delete.php?id=' + id);
    });
  }
});
