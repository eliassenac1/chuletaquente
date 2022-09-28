<?php
//Incluindo variaveis do sistema
include('../../config.php');

//Incluindo o sistema de autenticação
include('../acesso_com.php');

//Incluindo o Arquivo de conexão
include('../../conexoes/conexao.php');


if ($_POST) {


    $numero_da_mesa = $_POST['numero_da_mesa'];
    $capcid_mesa = $_POST['capcid_mesa'];

    $campos_insert = "numero_da_mesa,capcid_mesa";
    $values = "$numero_da_mesa, $capcid_mesa";

    $query = "insert into tbmesa ($campos_insert) values ($values);";
    $resultado = $conexao->query($query);

    // var_dump($$query);

    //Após o insert direciona a pagina
    if (mysqli_insert_id($conexao)) {
        header("location: mesa_lista.php");
    } else {
        header("location: mesa_lista.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo SYS_NAME; ?> - Inserir Mesas </title>
            <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link href="../../css/meu_estilo.css" rel="stylesheet" type="text/css">
</head>

<body class="fundofixo">
    <?php include('index.php'); ?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-8">
                <h2 class="breadcrumb tex-danger">
                    <a href="mesa_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo Mesas
                </h2>
                <div class="thumbnail">
                    <!-- Abre thumbnail -->
                    <div class="alert alert-danger" role="alert">
                        <form action="nova_mesa.php" method="post" id="form_nova_mesa" name="form_nova_mesa" enctype="multipart/form-data">
                            <!--Inserir o campo id_mesa oculto para uso no filtro -->
                            <input type="hidden" name="id_mesa" id="id_mesa">   
                            <!-- Text numero_da_mesa -->
                            <label for="numero_da_mesa">Número da mesa:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </span>
                                <input type="number" class="form-control" id="numero_da_mesa" name="numero_da_mesa" min="1" step="1" required>
                            </div> 
                            <br>                         
                            <!-- Text capcid_mesa -->
                            <label for="capcid_mesa">Capacidade da mesa(Num Pessoas):</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </span>
                                <input type="number" class="form-control" id="capcid_mesa" name="capcid_mesa" min="1" step="1" required>
                            </div>   
                            <br>                         
                            <!-- Botão Enviar -->
                            <input type="submit" value="Cadastrar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Script para a imagem -->
    <script>
        document.getElementById("imagem_produto").onchange = function() {
            var reader = new FileReader();
            if (this.files[0].size > 528385) {
                alert("A imagem deve ter no máximo 500KB");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;

            }
            // Verifica se o input do titpo file possui dado
            if (this.files[0].type.indexOf("image") == -1) {
                alert("Formato inválido, escolha uma imagem!");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;
            };
            reader.onload = function(e) {
                //Obter dados  carregados e renderizar a miniatura
                document.getElementById("imagem").src = e.target.result;
                $("#imagem").show();
            };
            reader.readAsDataURL(this.files[0]);
        };
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>