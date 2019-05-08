drop database matchup;
CREATE DATABASE matchup CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

use matchup;

CREATE TABLE matches
(
  match_id int NOT NULL AUTO_INCREMENT,
  title varchar (255),
  kind int default 5,
  startTime datetime,
  scoreA int default 0,
  scoreB int default 0,
  status int default 0,
  loc varchar(255),
  PRIMARY KEY (match_id)
);

create table player
(
player_id varchar(20) primary key not null,
password varchar(20) not null,
name varchar(50),
elo int not null default 100
);

create table detail (
detail_id int AUTO_INCREMENT not null primary key,
team int not null,
player_id varchar(20),
foreign key(player_id) references player(player_id),
match_id int unique,
foreign key(match_id) references matches(match_id)
);
  
insert into player (player_id,password,name,elo) values ('vntdinh','123','ThienDinh', 100);
INSERT INTO matches
    (match_id, title, startTime, loc, kind, status, scoreA, scoreB)
  VALUES
    ('1','Friendly', Now(), 'Chi Lang', 5, 0,0,0);
insert into detail (detail_id,team,player_id,match_id) values ('1','1','vntdinh','1');

