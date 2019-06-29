var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "roster-admin",
  password: "c6tT48KAC1v2TtqX",
  database: "hockey-players"
});

  con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");

    //Create tables for each position
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


