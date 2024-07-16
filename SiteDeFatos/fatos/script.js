const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Configuração do middleware body-parser
app.use(bodyParser.urlencoded({ extended: true }));

// Configuração da conexão com o banco de dados
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'sitefatos'
});

db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log('Conectado ao banco de dados MySQL');
});

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

// Função para atualizar produto
function atualizarProd(req, res) {
    if (req.body.atlProd) {
        const id = db.escape(req.body.inputId);
        const nome = db.escape(req.body.inputNome);
        const preco = db.escape(req.body.inputPreco);
        const quant = db.escape(req.body.inputQuant);

        if (nome && preco && quant) {
            const query = `UPDATE produtos SET nome=${nome}, preco=${preco}, quantidade=${quant} WHERE id=${id}`;
            console.log(query); // Para depuração

            db.query(query, (err, result) => {
                if (err) {
                    console.error('Erro ao atualizar dados:', err);
                    res.send('Erro ao atualizar dados');
                } else {
                    console.log('Produto atualizado com sucesso');
                    res.send('Produto atualizado com sucesso');
                }
            });
        } else {
            console.log('Preencha todos os dados corretamente. Dados preenchidos -->');
            console.log(`Nome: ${nome} | Preço: ${preco} | Quantidade: ${quant} | ID: ${id}`);
            res.send('Preencha todos os dados corretamente.');
        }
    }
}

// Endpoint para a atualização de produto
app.post('/atualizarProd', atualizarProd);




function cadUsuario(req, res) {
    if (req.body.atlProd) {
        
        const nome = db.escape(req.body.username);
        const senha = db.escape(req.body.password);
        

        if (nome && preco && quant) {
            const query = `INSERT INTO usuarios (Nome,Senha) VALUES (${nome}, ${senha})`;
            console.log(query); // Para depuração

            db.query(query, (err, result) => {
                if (err) {
                    console.error('Erro ao cadastrar usuario:', err);
                    res.send('Erro ao cadastrar usuario');
                } else {
                    console.log('Usuário cadastrado com sucesso');
                    res.send('Usuário cadastrado com sucesso');
                }
            });
        } else {
            console.log('Preencha todos os dados corretamente. Dados preenchidos -->');
            console.log(`Nome: ${nome} | senha: ${senha}`);
            res.send('Preencha todos os dados corretamente.');
        }
    }
}
// Endpoint para a atualização de usuario
app.post('/cadUsuario', cadUsuario);

// Inicia o servidor
app.listen(port, () => {
    console.log(`Servidor rodando na porta ${port}`);
});
