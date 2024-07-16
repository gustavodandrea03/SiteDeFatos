<?php
$server="localhost";
$fatoDb="root";
$passDb="";
$database="sitefatos";
$connect=mysqli_connect($server,$fatoDb,$passDb,$database);

function insertUser($connect){
    if(isset($_POST['cadastro'])){ /*cadastro é o nome do input submit*/
        $nome=mysqli_real_escape_string($connect,$_POST['inputNome']);//função pra evitar SQL Injection
        $alt=mysqli_real_escape_string($connect,$_POST['inputAlt']);
        $nasc=mysqli_real_escape_string($connect,$_POST['inputNasc']);
        $cidade=mysqli_real_escape_string($connect,$_POST['inputCid']);
        
        
        if(!empty($nome) && !empty($alt) && !empty($nasc) && !empty($cidade)){
            $alt=$alt/100;
            $query="INSERT INTO clientes(nome,altura,nascimento,cidade_id) VALUES ('$nome','$alt','$nasc','$cidade')";
            $execute=mysqli_query($connect,$query);
            if($execute){
                echo"usuário inserido com sucesso";
            }else{
                echo"Erro ao inserir dados";
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "Nome:",$nome," | Altura: ",$alt," | Nascimento: ",$nasc,"| Cidade: ",$cidade;


        }
        voltar();
    }
}


function insertProd($connect){
    if(isset($_POST['cadastroProd'])){ /*cadastroProd é o nome do input submit*/
        $nome=mysqli_real_escape_string($connect,$_POST['inputNome']);
        $preco=mysqli_real_escape_string($connect,$_POST['inputPreco']);
        $quant=mysqli_real_escape_string($connect,$_POST['inputQuant']);
        $categoria=mysqli_real_escape_string($connect,$_POST['inputCat']);
        if(!empty($nome) and !empty($preco) and !empty($quant) and !empty($categoria)){
            
            $query="INSERT INTO produtos(nome,preco,quantidade,categoria_id) VALUES ('$nome','$preco','$quant','$categoria')";
            /*echo $query;*/
            $execute=mysqli_query($connect,$query);
            if($execute){
                echo"Produto inserido com sucesso";
            }else{
                echo"Erro ao inserir dados";
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "Nome: ",$nome," | Preço: ",$preco," | Quantidade: ",$quant," | Categoria: ",$categoria;


        }
        voltar();
    }
}


function atualizarProd($connect){
    if(isset($_POST['atlProd'])){ 
        $id=mysqli_real_escape_string($connect,$_POST['inputId']);
        $nome=mysqli_real_escape_string($connect,$_POST['inputNome']);
        $preco=mysqli_real_escape_string($connect,$_POST['inputPreco']);
        $quant=mysqli_real_escape_string($connect,$_POST['inputQuant']);
        
        if(isset($nome) and isset($preco) and isset($quant)){
            
            $query="UPDATE produtos SET nome='$nome',preco='$preco',quantidade='$quant' WHERE id='$id'";
            /*echo $query;*/
            $execute=mysqli_query($connect,$query);
            if($execute){
                echo"Produto atualizado com sucesso";
            }else{
                echo"Erro ao atualizar dados";
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "Nome: ",$nome," | Preço: ",$preco," | Quantidade: ",$quant," | ID: ",$id;


        }
        voltar();
    }
}


function insertCat($connect){
    if(isset($_POST['cadastroCat'])){ /*cadastroCat é o nome do input submit*/
        $nome=mysqli_real_escape_string($connect,$_POST['inputNome']);
        
        if(!empty($nome)){
            
            $query="INSERT INTO categorias(nome) VALUES ('$nome')";
            echo $query;
            $execute=mysqli_query($connect,$query);
            if($execute){
                echo"Categoria inserida com sucesso";
            }else{
                echo"Erro ao inserir dados";
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "Nome: ",$nome;


        }
        voltar();
    }
}


function deleteProd($connect){
    if(isset($_POST['removeProd'])){
        $id=mysqli_real_escape_string($connect,$_POST['inputProd']);
        if(!empty($id)){
            $query="DELETE FROM produtos WHERE id='$id'";
            echo $query;
            $execute=mysqli_query($connect,$query);
            if($execute){
                echo"Produto removido com sucesso";
            }else{
                echo"Erro ao remover dados";
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "ID: ",$id;
        }
    }
}

function cadastrarPed($connect,$cliID){
    if(isset($_POST['fazerPedido'])){ /*cadastroPedido é o nome do input submit*/
        $horario=mysqli_real_escape_string($connect,$_POST['inputHora']);
        $endereco=mysqli_real_escape_string($connect,$_POST['inputEnd']);
        /*$cliID=mysqli_real_escape_string($connect,$_POST['inputQuant']);*/
        $prodID=mysqli_real_escape_string($connect,$_POST['inputProd']);
        $quant=mysqli_real_escape_string($connect,$_POST['inputQuant']);
        

        if(!empty($horario) and !empty($endereco) and !empty($cliID) and !empty($prodID)){
            
            $query="INSERT INTO pedidos(horario,endereco,cliente_id) VALUES ('$horario','$endereco','$cliID')";
            
            $getPreco=selectDados($connect,'produtos','id='.$prodID,'preco');
            $getP= $getPreco[0];
            $getPreco=$getP['preco'];
            $precoTotal=$getPreco*$quant;
            
            $execute=mysqli_query($connect,$query);
            
            $getpedidoID=selectDados($connect,'pedidos','1','MAX(id)');
            $getPed = $getpedidoID[0];
            $pedidoID = $getPed['MAX(id)'];
            echo "Horario: ",$horario," | endereço: ",$endereco," | ClienteID: ",$cliID," | prodID: ",$prodID," | Quantidade: ",$quant," | PedidoID: ",$pedidoID,"| Total: ",$precoTotal;
            
            $query2="INSERT INTO pedidos_produtos(pedido_id,produto_id,preco,quantidade) VALUES ('$pedidoID','$prodID','$precoTotal','$quant')";
            
            /*echo $query;*/
            $execute2=mysqli_query($connect,$query2);
            
            if($execute){
                echo"<br>Pedido realizado com sucesso";
            }else{
                echo"Erro ao inserir dados";
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "Horario: ",$horario," | endereço: ",$endereco," | ClienteID: ",$cliID," | prodID: ",$prodID;


        }
        voltar();
    }
}


function administrarPedidos($connect){
    if(isset($_POST['atlPed'])){ 
        $id=mysqli_real_escape_string($connect,$_POST['inputId']);
        $hora=mysqli_real_escape_string($connect,$_POST['inputHora']);
        $endereco=mysqli_real_escape_string($connect,$_POST['inputEnd']);
        $cliID=mysqli_real_escape_string($connect,$_POST['inputCliID']);
        
        if(isset($id) and isset($hora) and isset($endereco) and isset($cliID)){
            
            $query="UPDATE pedidos SET id='$id',endereco='$endereco',cliente_id='$cliID' WHERE id='$id'";
            /*echo $query;*/
            $execute=mysqli_query($connect,$query);
            if($execute){
                echo"Pedido atualizado com sucesso";
            }else{
                echo"Erro ao atualizar dados. Você preencheu:<br>";
                echo "Nome: ",$nome," | Preço: ",$preco," | Quantidade: ",$quant," | ID: ",$id;
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "Nome: ",$nome," | Preço: ",$preco," | Quantidade: ",$quant," | ID: ",$id;


        }
        voltar();
    }else if(isset($_POST['delPed'])){
        $id=mysqli_real_escape_string($connect,$_POST['inputId']);
        if(!empty($id)){
            $query="DELETE FROM pedidos WHERE id='$id'";
            /*echo $query;*/
            $query2="DELETE FROM pedidos_produtos WHERE pedido_id='$id'";
            $execute2=mysqli_query($connect,$query2);
            $execute=mysqli_query($connect,$query);
            
            
            if($execute and $execute2){
                echo"Pedido removido com sucesso";
            }else{
                echo"Erro ao remover dados";
            }
        }else{
            echo"Preencha todos os dados corretamente. Dados preenchidos -->";
            echo "ID: ",$id;
        }
    }
}

function selectDados($connect,$tabela,$where = "1",$what="*"){
    $query="SELECT $what FROM $tabela WHERE $where";
    /*echo $query;*/
    $execute=mysqli_query($connect,$query);
    //traz os dados do SELECT do banco
    //MYSQLI_NUM - MYSQLI_BOTH - MYSQLI_ASSOC
    $result=mysqli_fetch_all($execute, MYSQLI_ASSOC);
    #echo 'RESULTADO: ',$result,"<br>";
    return $result;
}

function login($connect){
    if(isset($_POST['logon'])){
        $chave=false;
        $name=mysqli_real_escape_string($connect,$_POST['inputNome']);
        $id=mysqli_real_escape_string($connect,$_POST['inputId']);
        $client = selectDados($connect,"clientes");
        foreach($client as $c){
            #echo $c['nome'];
            if($c['nome']==$name and $c['id']==$id){
                $chave=true;
                criarPagina($connect,$name,$id);
                break;
                
            }
            
        }
        if(!$chave){
            /*echo 'USUÁRIO NÃO ENCONTRADO';*/
            echo 'Nome de usuário ou ID inválido';
            voltar();
        }

    }
}

function criarPagina($connect,$n,$id){
    echo '<h1>Bem-vindo ',$n,'</h1>';
    if($n!='admin'){
        header("location:pgClient.php?n=".urlencode($n)."&id=".urlencode($id));
        exit;
           
    }else{
        header("location:pgAdmin.php?n=".urlencode($n));
        exit;
    }
}

function voltar(){
    ?>
        <br><br>
        <a href="index.php" style="padding:4px; background:gray; border:2px solid blue;">Voltar</a>
    <?php
}


if (isset($_REQUEST['cadastrar']) && $connect){ /*cadastrar é o nome do item após a ? no action do form */
    insertUser($connect);
}else if (isset($_REQUEST['login']) && $connect){
    login($connect);
}else if (isset($_REQUEST['cadProd']) && $connect){
    insertProd($connect);
}else if (isset($_REQUEST['admPed']) && $connect){
    administrarPedidos($connect);
}else if (isset($_REQUEST['cadPed']) && $connect){
    $cliID=$_GET['id'];
    cadastrarPed($connect,$cliID);
}else if (isset($_REQUEST['atProd']) && $connect){
    atualizarProd($connect);
}else if (isset($_REQUEST['cadCat']) && $connect){
    insertCat($connect);
}else if (isset($_REQUEST['remProd']) && $connect){
    deleteProd($connect);
}

?>