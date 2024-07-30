<?php
require_once "conexao.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatos</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="functions.js"></script>
</head>
<body>
    
    <header>
        <h1>Fatos</h1>
        <div class="userBox">
            <p id="user">???</p>
        </div>
    </header>

    <script>
        // Função para obter os parâmetros de consulta da URL
        function getQueryParams() {
            var params = {};
            var queryString = window.location.search.substring(1);
            var regex = /([^&=]+)=([^&]*)/g;
            var m;

            while (m = regex.exec(queryString)) {
                params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }

            return params;
        }

        

        // Obter os parâmetros de consulta da URL
        var queryParams = getQueryParams();
        var usuario = queryParams['nome'] || 'Visitante';

        // Exibir o valor ou fazer algo com ele
        console.log("Usuário logado:", usuario);
        document.getElementById("user").innerHTML=usuario;
   
        

        
    </script>



<?php
$nome=$_GET['nome'];
?>


    <div class="container">
        

        <?php
            // Exibir fatos do banco de dados
            $fatos = selectDados($connect, "fatos");
            foreach($fatos as $f) {
        ?>
         <div class="fato">
            <a href="comentFato.php?desc=<?php echo $f['Descricao'];?>&autor=<?php echo $f['Autor']; ?>&usuario=<?php echo $nome ?>">
            <p>
                <?php echo $f['Descricao']; ?>
            </p>
            <p class="autor">- By <?php echo $f['Autor']; ?></p>
            </a>
                        
        </div>
        <?php
            }
        ?>



        
        
    </div>
       
    <div class="fatoForm">
        <input type="button" onclick="cadFatoMode(usuario)" class="btFatoForm" value="<" />
        <form>
            <label for="inputFato">Escreva seu fato, <script>document.write(usuario)</script>:</label><br>
            <textarea id="inputFato" name="inputFato" maxlength="440" required></textarea><br>
            <input type="button" onclick="cadFato(usuario)" class="cadFatoBtn" value="Postar Fato" />
        </form>
    </div>

</body>
</html>