<?php
require_once('../config.php');  // correto, porque config.php está na raiz
require_once(DBAPI);

$compras = null;
$compra = null;

/**
 *  Listagem de Compras com pesquisa
 */
function index() {
    global $compras;
    if (!empty($_GET['search'])) {
        $search = $_GET['search'];
        $compras = find_search_compras($search);
    } else {
        $compras = find_all('compras');
    }
}

/**
 *  Pesquisa de Compras por ID, Forma de Pagamento e Produto
 */
function find_search_compras($search) {
    $database = open_database();
    $search = $database->real_escape_string($search);
    
    $sql = "SELECT * FROM compras 
            WHERE id LIKE '%$search%' 
               OR formaPgto LIKE '%$search%' 
               OR produto LIKE '%$search%' 
            ORDER BY dataCompras DESC";
    
    try {
        $result = $database->query($sql);
        $compras = array();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($compras, $row);
            }
        }
        return $compras;
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
        return array();
    } finally {
        close_database($database);
    }
}


function add() {
    if (!empty($_POST['compra'])) {
        $compra = $_POST['compra'];

        // Upload da imagem
        if (!empty($_FILES['imagem']['name'])) {
            $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $novoNome = uniqid() . "." . $ext;
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagens/" . $novoNome)) {
                $compra['imagemProduto'] = $novoNome;
            } else {
                $compra['imagemProduto'] = "semimagem.png";
            }
        } else {
            $compra['imagemProduto'] = "semimagem.png";
        }

        save('compras', $compra);
        header('location: index.php');
    }
}

/**
 *  Atualização/Edição de Compras
 */
function edit() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['compra'])) {
            $compra = $_POST['compra'];

            // Upload da imagem (mantém se não trocar)
            if (!empty($_FILES['imagem']['name'])) {
                $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                $novoNome = uniqid() . "." . $ext;
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagens/" . $novoNome)) {
                    $compra['imagemProduto'] = $novoNome;
                }
            }

            update('compras', $id, $compra);
            header('location: index.php');
        } else {
            global $compra;
            $compra = find('compras', $id);
        }
    } else {
        header('location: index.php');
    }
}

/**
 *  Visualização de uma Compra
 */
function view($id = null) {
    global $compra;
    $compra = find('compras', $id);
}

/**
 *  Exclusão de uma Compra
 */
/**
 *  Exclusão de uma Compra
 */
function formataData($data, $formato){
        $novadata = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
        return $novadata->format($formato);
        
    }