<?php
include('conexoes/conexao.php');


$consulta = "select * from vw_tbprodutos where disponivel_produto = 'Sim' order by descri_produto";
$lista = $conexao->query($consulta);
$linha = $lista->fetch_assoc();
$totalLinhas = ($lista)->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/meu_estilo.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">
    <title>Produtos Em geral</title>
</head>

<body class="fundofixo">
    
    <!--teste se a consulta retornar vazia-->
    <main class="container">
        
            <h2 class="breadcrumb alert-danger">
             
                Produtos
            </h2>
        

        <div class="row">
            <!--Linha de produto-->
            <!--inicio estrutura de repetição-->
            <?php do {?>
                <!--Abre o Thumbnail/card-->
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="produto_detalhe.php?id_produto=<?php echo $linha['id_produto'] ?>">
                            <img src="images/<?php echo $linha['imagem_produto']?>" alt="" class="img-responsive img-rounded">
                        </a>
                        <div class="caption text-right">
                            <h3 class="text-danger">
                                <strong><?php echo $linha['descri_produto']?></strong>
                            </h3>
                            <p class="text-warning">
                            <?php echo $linha['rotulo_tipo']?>
                            </p>
                            <p class="text-left">
                            <?php echo mb_strimwidth($linha['resumo_produto'],0,42, '...');?>
                            </p>

                            <p>
                                <button class="btn btn-default disabled" role="button" style="cursor: default;">
                                    <?php echo number_format($linha['valor_produto'],2,',',',');?>
                                </button>
                                <a href="produto_detalhe.php?id_produto=<?php echo $linha['id_produto'];?>" class="btn btn-danger" role="button">
                            <span class="hidden-xs">Saiba mais...</span>
                        <span class="visible-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                            </p>
                        </div> <!--Final caption-->
                    </div>
                </div>
                <!--Fecha o Thumbnail/card-->
            <?php } while ($linha = $lista->fetch_assoc()); ?>
            <!--Final estrutura de repetição-->

        </div>
        <!--Final linha de produto-->
        
    </main>     

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>