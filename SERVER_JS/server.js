var socket      = require('socket.io'),
    express     = require('express'),
    https       = require('https'),
    http        = require('http'),
    logger      = require('winston');

logger.remove(new logger.transports.Console);
logger.add(new logger.transports.Console, { colorize: true, timestamp: true });
logger.info('SocketIO > Listening on port 3001');

// https_server= https.createServer({
//     key: fs.readFileSync(''),
//     cert: fs.readFileSync(''),
// }, app).listen(3000),

var app         = express();
var http_server = http.createServer(app).listen(3001);
function emitNewOrder(http_server) {
    var io  = socket(http_server);

    io.sockets.on('connection', function(socket){
        socket.on("pengerjaan", function(data){
            io.emit("pengerjaan", data);
            console.log(data);
        })
        socket.on("selesai", function(data){
            io.emit("selesai", data);
            console.log(data);
        })
        socket.on("selesai_kategori", function(data){
            io.emit("selesai_kategori", data);
            console.log(data);
        })
        socket.on("progress", function(data){
            io.emit("progress", data);
            console.log(data);
        })
        socket.on("hasil_jawab", function(data){
            io.emit("hasil_jawab", data);
            console.log(data);
        })
        socket.on("undo_jawab", function(data){
            io.emit("undo_jawab", data);
            console.log(data);
        })
        socket.on("hasil_Tjawab", function(data){
            io.emit("hasil_Tjawab", data);
            console.log(data);
        })
        socket.on("add_user", function(data){
            io.emit("add_user", data);
            console.log(data);
        })
        socket.on("delete_user", function(data){
            io.emit("delete_user", data);
            console.log(data);
        })
        socket.on("add_kategori", function(data){
            io.emit("add_kategori", data);
            console.log(data);
        })
        socket.on("delete_kategori", function(data){
            io.emit("delete_kategori", data);
            console.log(data);
        })
        socket.on("add_soal", function(data){
            io.emit("add_soal", data);
            console.log(data);
        })
        socket.on("delete_soal", function(data){
            io.emit("delete_soal", data);
            console.log(data);
        })
        socket.on("edit_user", function(data){
            io.emit("edit_user", data);
            console.log(data);
        })
        socket.on("edit_soal", function(data){
            io.emit("edit_soal", data);
            console.log(data);
        })
        socket.on("edit_kategori", function(data){
            io.emit("edit_kategori", data);
            console.log(data);
        })
    });
}

emitNewOrder(http_server);