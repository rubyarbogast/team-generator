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

  var players = "CREATE TABLE rma_all_players (nhl_id INT PRIMARY KEY, name VARCHAR(255), number INT(2), position VARCHAR(255), current_team VARCHAR(255), team_abbr VARCHAR(255), active BOOLEAN)";

  createTable(players);

  var teams = "CREATE TABLE rma_team (team_id INT PRIMARY KEY, user INT(11), date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

  createTable(teams);

  var lines = "CREATE TABLE rma_line (line_id INT PRIMARY KEY, team_id INT(11), FOREIGN KEY (team_id) REFERENCES rma_team(team_id), lw_id INT(11), FOREIGN KEY (lw_id) REFERENCES rma_all_players(nhl_id), c_id INT(11), FOREIGN KEY (c_id) REFERENCES rma_all_players(nhl_id), rw_id INT(11), FOREIGN KEY (rw_id) REFERENCES rma_all_players(nhl_id))";

  createTable(lines);

  var pairs = "CREATE TABLE rma_pair (id INT PRIMARY KEY, team_id INT(11), FOREIGN KEY (team_id) REFERENCES rma_team(team_id), ld_id INT(11), FOREIGN KEY (ld_id) REFERENCES rma_all_players(nhl_id), rd_id INT(11), FOREIGN KEY (rd_id) REFERENCES rma_all_players(nhl_id))";

  createTable(pairs);

  var tandems = "CREATE TABLE rma_tandem (id INT PRIMARY KEY, team_id INT(11), FOREIGN KEY (team_id) REFERENCES rma_team(team_id), g1_id INT(11), FOREIGN KEY (g1_id) REFERENCES rma_all_players(nhl_id), g2_id INT(11), FOREIGN KEY (g2_id) REFERENCES rma_all_players(nhl_id))";

  createTable(tandems);

})



