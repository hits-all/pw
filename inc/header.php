<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>CRUD com Bootstrap</title>
        <meta name="description" content="">
        <meta name="keyword" content="">
        <meta name="author" content="Heitor e Théo">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <style>
            .btn-light {
                background-color: #CCCCCC;
                color: #ffffff;
                border-color: #CCCCCC;
            }
            .btn-light:hover {
                background-color: #999999;
                color: #ffffff;
                border-color: #999999;
            }
        </style>       
    </head>
    <body>

        <nav class="navbar navbar-expand-md bg-body-tertiary fixed-top" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php"><i class="fa-solid fa-house"></i> CRUD </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               <i class="fa-solid fa-users"></i> Clientes
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>customers">
                                        <i class="fa-solid fa-users"></i> Gerenciar Clientes
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php">
                                        <i class="fa-solid fa-user-plus"></i> Novo Cliente
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               <i class="fa-solid fa-basket-shopping"></i> Compras
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>compras">
                                        <i class="fa-solid fa-basket-shopping"></i> Gerenciar Compras
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASEURL; ?>compras/add.php">
                                        <i class="fa-solid fa-cart-plus"></i> Nova Compra
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>

        <main class="container">