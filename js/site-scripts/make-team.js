var mysql = require('../player-data/node_modules/mysql');
//Require config file to log in to DB
var config = require('../config.json');

var con = mysql.createConnection({
    host: config.host,
    user: config.user,
    password: config.password,
    database: config.database
  });

//TODO: generate random team when user clicks button
var team = [];

let lwQuery = 'SELECT lw.name, lw.number, lw.currentTeam, lw.position FROM lwing AS lw ORDER BY rand() LIMIT 4';
let cQuery = 'SELECT c.name, c.number, c.currentTeam, c.position FROM center AS c ORDER BY rand() LIMIT 4';
let rwQuery = 'SELECT rw.name, rw.number, rw.currentTeam, rw.position FROM rwing AS rw ORDER BY rand() LIMIT 4';
let dQuery = 'SELECT d.name, d.number, d.currentTeam, d.position FROM defenseman AS d ORDER BY rand() LIMIT 6';
let gQuery = 'SELECT g.name, g.number, g.currentTeam, g.position FROM goalie AS g ORDER BY rand() LIMIT 2';

con.query(lwQuery, function (err, result) {
    if (err) throw err;
    team.push(result);
});

con.query(cQuery, function (err, result) {
    if (err) throw err;
    team.push(result);
});

con.query(rwQuery, function (err, result) {
    if (err) throw err;
    team.push(result);
});

con.query(dQuery, function (err, result) {
    if (err) throw err;
    team.push(result);
});

con.query(gQuery, function (err, result) {
    if (err) throw err;
    team.push(result);
    console.log(team);
});


//TODO: prevent spam requests

//TODO: save team as image