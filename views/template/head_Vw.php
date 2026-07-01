<!-- 
============================================================
ARQUIVO: head_Vw.php
FUNÇÃO: Template do cabeçalho HTML (<head>)
DESCRIÇÃO: Contém DOCTYPE, meta tags, links CSS e fontes.
           Este arquivo é incluído no início de todas as páginas.
           Usa as variáveis PHP $pageTitle e $meta_description
           que devem ser definidas ANTES de incluir este template.
============================================================
-->

<!-- Declara o tipo de documento como HTML5 -->
<!DOCTYPE html>

<!-- Elemento raiz do HTML com idioma definido como português brasileiro -->
<html lang="pt-br">

<!-- ============================================================
     CABEÇALHO DO DOCUMENTO (<head>)
     Contém metadados, configurações e links para recursos
     ============================================================= -->
<head>
    <!-- Define a codificação de caracteres como UTF-8
         Necessário para suportar acentos e caracteres especiais do português -->
    <meta charset="UTF-8">
    
    <!-- Configura a visualização responsiva para dispositivos móveis
         width=device-width = largura igual à da tela do dispositivo
         initial-scale=1.0 = zoom inicial padrão (sem ampliação) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Descrição da página para mecanismos de busca (SEO)
         Usa operador de coalescência (??) para valor padrão caso
         a variável $meta_description não esteja definida -->
    <meta name="description" content="<?php echo $meta_description ?? 'Barbearia Premium - Cortes modernos e atendimento de qualidade'; ?>">
    
    <!-- Título da página exibido na aba do navegador e nos resultados de busca
         Usa operador de coalescência (??) para valor padrão caso
         a variável $pageTitle não esteja definida -->
    <title><?php echo $pageTitle ?? 'Barber Book'; ?></title>
    
    <!-- Link para o arquivo de estilos CSS externo
         Usa a constante BASE_URL para caminho absoluto -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    
    <!-- Preconecta ao servidor de fontes do Google para carregamento mais rápido
         Reduz a latência na primeira visita ao site -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <!-- Preconecta ao CDN de fontes do Google com permissão cross-origin
         Necessário para carregar fontes de domínio diferente -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Carrega a fonte Josefin Sans do Google Fonts
         Pesos: 300 (light), 400 (regular), 600 (semi-bold), 700 (bold)
         display=swap = mostra texto com fonte padrão até carregar -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<!-- ============================================================
     CORPO DO DOCUMENTO (<body>)
     Início do conteúdo visível da página
     ============================================================= -->
<body>
