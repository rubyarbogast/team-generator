var mysql = require('mysql');
//Require config file to log in to DB
var config = require('../config.json');

var con = mysql.createConnection({
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database
});

function createTable(statement) {
  con.query(statement, function (err, result) {
    if (err) throw err;
    console.log("Table created");
  });
}

//Connect to DB
con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");

  //Create tables for each player position
/*   var lWing = "CREATE TABLE lwing (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255), teamAbbr VARCHAR(255))";
  var center = "CREATE TABLE center (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255), teamAbbr VARCHAR(255))";
  var rWing = "CREATE TABLE rwing (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255), teamAbbr VARCHAR(255))";
  var defenseman = "CREATE TABLE defenseman (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255), teamAbbr VARCHAR(255))";
  var goalie = "CREATE TABLE goalie (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255), teamAbbr VARCHAR(255))";

  createTable(lWing);
  createTable(center);
  createTable(rWing);
  createTable(defenseman);
  createTable(goalie); */

  var players = "CREATE TABLE rma_all_players (nhlId INT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255), teamAbbr VARCHAR(255), active BOOLEAN)";

  createTable(players);
});



