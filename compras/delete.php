<?php
require_once('../config.php');
require_once(DBAPI);

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Buscar a compra para obter informações da imagem
        $compra = find('compras', $id);
        
        if ($compra) {
            // Excluir a imagem se não for a imagem padrão
            if ($compra['imagemProduto'] != 'semimagem.png') {
                $caminho_imagem = '../imagens/' . $compra['imagemProduto'];
                if (file_exists($caminho_imagem)) {
                    unlink($caminho_imagem);
                }
            }
            
            // Excluir o registro do banco de dados
            $deleted = remove('compras', $id);
            
            if ($deleted) {
                $_SESSION['message'] = 'Compra excluída com sucesso!';
                $_SESSION['type'] = 'success';
            } else {
                throw new Exception('Erro ao excluir registro do banco de dados');
            }
        } else {
            throw new Exception('Compra não encontrada');
        }
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao excluir compra: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'ID não especificado';
    $_SESSION['type'] = 'danger';
}

// Redirecionar de volta para a lista
header('location: index.php');
exit;
?>