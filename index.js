var knex = require("knex")
const restify = require("restify")
const errors = require("restify-errors")

const server = restify.createServer({
    name : 'lojinha' ,
    version : '1.0.0'
})

const corsMiddleware = require("restify-cors-middleware2");

const cors = corsMiddleware({
    origins : ['*']
});

server.use( restify.plugins.acceptParser(server.acceptable) )
server.use( restify.plugins.queryParser() )
server.use( restify.plugins.bodyParser() )

server.pre(cors.preflight);
server.use(cors.actual);


server.listen( 8001 , function() {
    console.log("%s executando em %s", server.name, server.url)
})

knex = require('knex')({
    client : 'mysql' ,
    connection : {
        host : 'localhost' ,
        user : 'root' ,
        password : '' ,
        database : 'lojinha_2024_1'
    }
})



server.get( '/categoria' , (req, res, next) => {//NECESSARIO
    knex('categoria').then( (dados) => {
        res.send( dados )
    }, next)
})


server.post( '/categoria' , (req, res, next) => {//NECESSARIO
    knex('categoria')
    .insert( req.body )
    .then( (dados) => {
        res.send( dados )
    }, next)
})

