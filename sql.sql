drop database matchup;
CREATE DATABASE matchup CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

use matchup;

create table player
(
  player_id varchar(20) primary key not null,
  password varchar(20) not null,
  name varchar(50),
  elo int not null default 100
);

CREATE TABLE matches
(
  match_id int NOT NULL AUTO_INCREMENT,
  title varchar (255),
  kind int default 5,
  startTime datetime,
  createdTime datetime,
  scoreA int default 0,
  scoreB int default 0,
  status int default 0,
  loc varchar (255),
  player_id varchar (20),
  primary key (match_id)
);

  create table detail
  (
    team int not null,
    player_id varchar(20),
    foreign key (player_id) references player (player_id),
    match_id int,
    foreign key (match_id) references matches (match_id) on delete cascade,
    primary key(player_id, match_id)
);

    /* Add data */
    insert into player(player_id,password,name,elo) values ('vntdinh', '123', 'Thien Dinh', 100);
    insert into player(player_id,password,name,elo) values ('htran', '123', 'Hiep T', 100);
    insert into player(player_id,password,name,elo) values ('ptran', '123', 'Hiep P', 100);
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('1', 'Friendly 1','2019-11-05 12:30:00', 'Chi Lang', 5, 0, 1, 2, current_timestamp, 'vntdinh');
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('2', 'Friendly 2', '2019-11-05 12:31:00', 'Chi Lang', 5, 0, 2, 1, current_timestamp, 'ptran');
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('3', 'Friendly 3', '2019-11-05 12:32:00', 'Chi Lang', 5, 0, 3, 4, current_timestamp, 'ptran');
    
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('4', 'Friendly 4', '2019-05-06 12:31:00', 'Chi Lang', 5, 1, 1, 2, current_timestamp, 'ptran');
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('5', 'Friendly 5', '2019-05-06 12:31:10', 'Chi Lang', 5, 1, 0, 0, current_timestamp, 'ptran');
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('6', 'Friendly 6', '2019-05-06 12:33:00', 'Chi Lang', 5, 1, 3, 0, current_timestamp, 'ptran');
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('7', 'Friendly 7', '2019-05-06 12:34:00', 'Chi Lang', 5, 1, 2, 0, current_timestamp, 'ptran');
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('8', 'Friendly 8', '2019-05-06 12:35:00', 'Chi Lang', 5, 1, 2, 0, current_timestamp, 'ptran');
    INSERT INTO matches(match_id, title, startTime, loc, kind, status, scoreA, scoreB, createdTime, player_id)
    VALUES ('9', 'Friendly 9','2019-11-06 12:30:00', 'Chi Lang', 5, 1, 1, 2, current_timestamp, 'vntdinh');
	
    insert into detail (team,player_id,match_id) values( '1', 'vntdinh', '1');
    insert into detail (team,player_id,match_id) values( '1', 'ptran', '1'); 
    insert into detail (team,player_id,match_id) values( '2', 'htran', '1');

    set global event_scheduler = ON;
    drop event if exists `check_match`;
    create event `check_match`
    on schedule every 1 minute
    do 
    delete from matches where startTime < current_timestamp and status = 0;

DROP TRIGGER IF EXISTS update_elo;

DELIMITER //
CREATE TRIGGER update_elo AFTER UPDATE ON matches
FOR EACH ROW
BEGIN
  IF (NEW.status = 2) 
  THEN
    CASE 
      WHEN NEW.scoreA > NEW.scoreB THEN -- Case 1: Team 1 wins
      BEGIN
        UPDATE player INNER JOIN detail ON player.player_id = detail.player_id AND match_id = NEW.match_id
        SET elo = IF (team = 1, elo + 3, elo - 3);
      END; -- End case 1

      WHEN NEW.scoreA < NEW.scoreB THEN -- Case 2: Team 2 wins
      BEGIN
        UPDATE player INNER JOIN detail ON player.player_id = detail.player_id AND match_id = NEW.match_id
        SET elo = IF (team = 1, elo - 3, elo + 3);
      END; -- End case 2

      ELSE -- Case 3: Draw
      BEGIN
        UPDATE player INNER JOIN detail ON player.player_id = detail.player_id AND match_id = NEW.match_id
        SET elo = elo + 1;
      END; -- End case 3

    END CASE; -- End case
  END IF; -- End if
END; // -- End trigger
DELIMITER ;