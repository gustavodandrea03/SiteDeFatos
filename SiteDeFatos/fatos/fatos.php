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
    <script src="scripts.js"></script>
</head>
<body>
    <header>
        <h1>Fatos</h1>
    </header>
    <div class="container">
        <div class="fato">
            <p>
                exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo
                 de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato
                  exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato
            </p>
            <p class="autor">Nome Nome</p>
        </div>
        <div class="fato">
            <p>
                exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo
                 de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato
                  exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato
            </p>
            <p class="autor">Nome Nome</p>
        </div>
        <div class="fato">
            <p>
                exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo
                de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato
                 exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato exemplo de fato
            </p>
            <p class="autor">Nome Nome</p>
        </div>
        <?php
            $fatos=selectDados($connect,"fatos");
            foreach($fatos as $f){
        ?>
        <div class="fato">
            <p>
                <?php echo $f['Descricao']; ?>
            </p>
            <p class="autor">- By <?php echo $f['Autor']; ?></p>
        </div>
        <?php
            }
        ?>

        <script>
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
                        
        </script>

    </div>
</body>
</html>