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
        var usuario = queryParams['usuario'];

        // Exibir o valor ou fazer algo com ele
        console.log(usuario);
        document.getElementById("user").innerHTML=usuario;
    
    </script>

    
        <?php
            $usuario=$_GET['usuario'];

            $usuarios=selectDados($connect,"usuarios");
            foreach($usuarios as $u){
                if($u['Nome']==$usuario){
                    $idUsuario=$u['id'];

                    //echo $idUsuario;
                }
            }
            

            $fatos=selectDados($connect,"fatos");
            foreach($fatos as $f){
                if($f['Descricao']==$_GET['desc']){
                    $idFato=$f['id'];
                    
        ?>
        
        <div class="fato">
            <p style="font-size:30px";>
                <?php echo $f['Descricao']; ?>
            </p>
            <p class="autor" style="font-size:20;">- By <?php echo $f['Autor']; ?></p>
            
            
        </div>
        <?php
                }
            }
            //echo $idFato;
            
        ?>
        <form class="comentForm">
            <label for="coment"></label>
            <input type="text" name="inputComent" id="inputComent" required>
            <input type="button" onclick="cadComent(<?php echo $idUsuario; ?>,<?php echo $idFato; ?>)" class="btnComent" value="Postar Comentário(Pressionar enter da erro, clique aqui)"/>
        </form>
        <!-- <script>
            // Fetch fatos and display
            fetch('/fatos')
              .then(response => response.json())
              .then(data => {
                const fatosContainer = document.getElementById('fatos-container');
                data.forEach(fato => {
                  const fatoDiv = document.createElement('div');
                  fatosDiv.innerHTML = '<hr><p>Descrição ${fato.Descricao} = Autor: ${fato.Autor}</p>';
                  fatosContainer.appendChild(fatosDiv);
                });
              })
              .catch(error => console.error('Error fetching fatos:', error));
            
            // Fetch cidades and populate select
                        
        </script> -->

    </div>
    <?php
        $comentarios=selectDados($connect,'comentarios');
        foreach($comentarios as $c){
            if($c['idFato']==$idFato){
            $usuarios=selectDados($connect,'usuarios');
            foreach($usuarios as $u){
                if($u['id']==$c['idUsuario']){
                    $autor=$u['Nome'];
                }
            }
    ?>
        <div class="comentario">
            <p style="font-size:20px;"><?php echo $autor; ?>:</p>
            <p><?php echo $c['texto']; ?></p>
        </div>
    <?php
            }
        }
    ?>
    

    
</body>
</html>