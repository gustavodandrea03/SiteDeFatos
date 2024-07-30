var knex = require("knex")
const restify = require("restify")
const errors = require("restify-errors")

const server = restify.createServer({
    name: 'fatos',
    version: '1.0.0'
})

const corsMiddleware = require("restify-cors-middleware2");

const cors = corsMiddleware({
    origins: ['*'],
    allowHeaders: ['Content-Type']
});

server.use(restify.plugins.acceptParser(server.acceptable))
server.use(restify.plugins.queryParser())
server.use(restify.plugins.bodyParser())

server.pre(cors.preflight);
server.use(cors.actual);

server.listen(8001, function() {
    console.log("%s executando em %s", server.name, server.url)
})

const db = knex({
    client: 'mysql',
    connection: {
        host: 'localhost',
        user: 'root',
        password: '',
        database: 'sitefatos'
    }
})


server.get('/', (req, res, next) => {
    res.send("Bem-vindo(a) à API")
    return next();
})

//endpoint pra cadastrar usuario

server.post('/usuarios', (req, res, next) => {
    db('usuarios')
        .insert(req.body)
        .then((dados) => {
            res.send(dados)
            return next();
        })
        .catch(error => {
            console.error("Erro ao inserir usuário:", error);
            res.send(500, new errors.InternalServerError("Erro ao inserir usuário"));
            return next();
        });
})

//endpoint pra cadastrar fato

server.post('/fatos', (req, res, next) => {
    db('fatos')
        .insert(req.body)
        .then((dados) => {
            res.send(dados)
            return next();
        })
        .catch(error => {
            console.error("Erro ao inserir fato:", error);
            res.send(500, new errors.InternalServerError("Erro ao inserir fato"));
            return next();
        });
})





// endpoint efetuar login

server.post('/login', (req, res, next) => {
    const { username, password } = req.body;

    console.log("Tentativa de login com:", username, password);

    if (!username || !password) {
        res.send(400, { message: 'Nome de usuário e senha são obrigatórios.' });
        return next();
    }

    db('usuarios')
        .where({ Nome: username })
        .first()
        .then(user => {
            if (user) {
                console.log("Usuário encontrado:", user);
                if (password === user.Senha) {
                    res.send({ message: 'Login bem-sucedido!', success: true });
                    console.log("Login bem-sucedido!");
                } else {
                    res.send({ message: 'Senha incorreta.', success: false });
                }
            } else {
                res.send({ message: 'Usuário não encontrado.', success: false });
            }
        })
        .catch(error => {
            console.error("Erro ao processar login:", error);
            res.send(500, { message: 'Erro ao processar login', error });
        });

});

// endpoint remover conta

server.del('/usuarios', (req, res, next) => {
    const { username } = req.body;

    console.log("Tentativa de remoção de conta para:", username);

    if (!username) {
        res.send(400, { message: 'Nome de usuário é obrigatório.' });
        return next();
    }

    db('usuarios')
        .where({ Nome: username })
        .del()
        .then(count => {
            if (count > 0) {
                res.send({ message: 'Conta removida com sucesso!', success: true });
                console.log("Usuário", username, "removido com sucesso!");
            } else {
                res.send({ message: 'Usuário não encontrado.', success: false });
                console.log("Usuário", username, "não encontrado.");
            }
        })
        .catch(error => {
            console.error("Erro ao remover conta:", error);
            res.send(500, { message: 'Erro ao remover conta', error });
        });
});


// endpoint para cadastrar comentário
server.post('/comentarios', (req, res, next) => {
    db('comentarios')
        .insert(req.body)
        .then((dados) => {
            res.send(dados);
            return next();
        })
        .catch(error => {
            console.error("Erro ao inserir comentário:", error);
            res.send(500, new errors.InternalServerError("Erro ao inserir comentário"));
            return next();
        });
});



db.raw('SELECT 1')
    .then(() => console.log('Conexão com o banco de dados bem-sucedida'))
    .catch(err => console.error('Erro na conexão com o banco de dados:', err));
