var mysql = require('mysql');
//Require config file to log in to DB
var config = require('../config.json');

var con = mysql.createConnection({
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database
});

//Connect to DB
con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");

  //Create tables for each player position
  var sql = "CREATE TABLE lwing (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255))";

  var sql2 = "CREATE TABLE center (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255))";

  var sql3 = "CREATE TABLE rwing (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255))";

  var sql4 = "CREATE TABLE defenseman (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255))";

  var sql5 = "CREATE TABLE goalie (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), currentTeam VARCHAR(255))";

  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Table lwing created");
  });

  con.query(sql2, function (err, result) {
    if (err) throw err;
    console.log("Table center created");
  });

  con.query(sql3, function (err, result) {
    if (err) throw err;
    console.log("Table rwing created");
  });

  con.query(sql4, function (err, result) {
    if (err) throw err;
    console.log("Table defenseman created");
  });

  con.query(sql5, function (err, result) {
    if (err) throw err;
    console.log("Table goalie created");
  });
});



