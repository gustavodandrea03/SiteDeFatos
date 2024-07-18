const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true }));

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

app.get('/projeto', (req, res) => {
    res.send('Página do projeto');
});

function cadUsuario(req, res) {
    const nome = db.escape(req.body.username);
    const senha = db.escape(req.body.password);

    if (nome && senha) {
        const query = `INSERT INTO usuarios (Nome, Senha) VALUES (${nome}, ${senha})`;
        console.log(query);

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

app.post('/cadUsuario', cadUsuario);

app.listen(port, () => {
    console.log(`Servidor rodando na porta ${port}`);
});
