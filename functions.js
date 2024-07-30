function cadUsuario(){
    nome = document.getElementById("register-username").value; //register-username é o id do input
    senha = document.getElementById("register-password").value;
    if( nome.length == 0 ){
        alert("O nome deve ser preenchido");
    }else{
        ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200){
                alert("Usuário "+nome+" cadastrado!");
            }else if(this.readyState == 4){
                alert( this.status +"\n"+this.responseText );
            }
        };

        ajax.open("POST", "http://localhost:8001/usuarios", true);
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send("nome=" + nome+"&senha="+senha);
        
    }

}

//função pra cadastrar fato
function cadFato(n){
    nome = n
    fato = document.getElementById("inputFato").value;
    //console.log(fato)
    if( nome.length == 0 ){
        alert("O nome deve ser preenchido");
    }else{
        ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200){
                alert("Fato cadastrado!");
            }else if(this.readyState == 4){
                alert( this.status +"\n"+this.responseText );
            }
        };

        ajax.open("POST", "http://localhost:8001/fatos", true);
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send("descricao=" + fato+"&autor="+nome);
        
    }

}


// função para efetuar login

function login() {
    var username = document.getElementById("login-username").value;
    var password = document.getElementById("login-password").value;

    if (!username || !password) {
        alert("Nome de usuário e senha são obrigatórios.");
        return;
    }

    fetch('http://localhost:8001/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username, password: password })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro de rede ao tentar fazer login');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Login bem-sucedido!");
            window.location.href = "fatos.php?nome="+encodeURIComponent(username); 
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert("Erro ao tentar fazer login. Tente novamente mais tarde.");
    });
}


// função para remover conta

function removeConta() {
    const username = document.getElementById("remove-username").value;

    if (username.length === 0) {
        alert("O nome de usuário deve ser preenchido");
        return;
    }

    fetch('http://localhost:8001/usuarios', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Conta removida com sucesso!");
            document.getElementById("remove-username").value = ''; // Limpar o campo após sucesso
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Erro ao remover conta:', error);
        alert('Erro ao tentar remover conta. Verifique o console para mais detalhes.');
    });
}

function cadFatoMode() {
	var element = document.body;
	element.classList.toggle("fatoInput");
}







// Função para carregar fatos
function carregarFatos() {
    fetch('http://localhost:8001/fatos')
        .then(response => response.json())
        .then(data => {
            const factsContainer = document.getElementById('facts-container');
            factsContainer.innerHTML = ''; 
            data.forEach(fact => {
                const factDiv = document.createElement('div');
                factDiv.innerHTML = `<p>${fact.Descricao}</p><p class="autor">- By ${fact.Autor}</p>`;
                factsContainer.appendChild(factDiv);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar fatos:', error);
        });
}



// função sistema de comentários
function cadComent(idUser, idFato) {
    coment = document.getElementById("inputComent").value;
    fato = idFato;
    user = idUser;
    
    if (coment.length == 0) {
        alert("O comentário deve ser preenchido");
    } else {
        ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert("Comentário postado!");
            } else if (this.readyState == 4) {
                alert(this.status + "\n" + this.responseText);
            }
        };

        ajax.open("POST", "http://localhost:8001/comentarios", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("texto=" + coment + "&idfato=" + fato + "&idusuario=" + user);
    }
}

