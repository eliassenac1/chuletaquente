<?php
include('conexoes/conexao.php');

$busca_user = $_GET['buscar'];

$consulta = "select * from vw_tbprodutos where descri_produto like '%" . $busca_user . "%' and disponivel_produto = 'Sim' order by descri_produto asc";
$lista = $conexao->query($consulta);
$linha = $lista->fetch_assoc();
$totalLinhas = $lista->num_rows;

/* <table>
    <?php do { ?>
    <tr>
    <td> <?php echo $linha['descri_produto']?></td>
    <td> <?php echo $linha['valor_produto']?></td>
    </tr>
     <?php } while($linha = $lista->fetch_assoc())?>
</table> */

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./css/meu_estilo.css">
    <title>Busca de produtos</title>
</head>

<body class="fundofixo">

    <?php include('menu_publico.php'); ?>
    <main class="container">
        <!-- Mostra se a conuslta retornar vazio -->
        <?php if ($linha == null) { ?>

            <h2 class="breadcrumb alert-danger">
                <a href="javascript: window.history.go(-1)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                Você pesquisou:
                <strong>
                    <i>
                        <?php echo $busca_user; ?>
                    </i>
                </strong>
                <br>
                A busca não retornou nenhum produto. Em breve atualizaremos!
            </h2>
        <?php } ?>
        <!--Fecha se a consulta retornar vazio -->
        <!--Mostra registros se a consulta retornar dados -->
        <?php if ($linha > 0 && $linha != null) { ?>
            <h2 class="breadcrumb alert-danger">
                <a href="javascript: window.history.go(-1)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                Você pesquisou:
                <strong><i><?php echo $busca_user; ?></i></strong>

            </h2>
            <div class="row">
                <!-- Manter os elementos na linha -->
                <!-- Abre uma estrutura de repetição -->
                <?php do {?>
                    <!-- Abre thumnail/card -->

                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a href="produto_detalhe.php?id_produto=<?php echo $linha['id_produto']; ?>">
                                <img src="images/<?php echo $linha['imagem_produto']; ?>" alt="" class="img-responsive img-rounder">
                            </a>
                            <div class="caption text-right">
                                <h3 class="text-danger">
                                    <strong><?php echo $linha['descri_produto']; ?></strong>
                                </h3>
                                <p class="text-warning">
                                    <strong>
                                        <?php echo $linha['rotulo_tipo']; ?>
                                    </strong>
                                </p>
                                <p class="text-left">
                                    <?php echo mb_strimwidth($linha['resumo_produto'], 0, 42, '...'); ?>
                                </p>
                                <p>
                                    <button class="btn btn-default disabled" style="cursor:default" role="button">
                                        <?php echo number_format($linha['valor_produto'], 2, ',', '.'); ?>
                                    </button>
                                    <a href="produto_detalhe.php?id_produto=<?php echo $linha['id_produto']; ?>">
                                        <span class="hidden-xs">Saiba mais...</span>
                                        <span class="visible-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div><!-- fecha o thumbnail -->
                <?php } while ($linha = $lista->fetch_assoc()); ?>
            </div><!-- fecha manter os elementos na linha -->

        <?php } ?>
        <footer>
            <?php include('rodape.php'); ?>
        </footer>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

</body>

</html>