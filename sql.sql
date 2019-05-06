CREATE DATABASE matchup
CHARACTER
SET utf8mb4
COLLATE utf8mb4_unicode_ci;

use matchup;

CREATE TABLE matches
(
  id int NOT NULL
  AUTO_INCREMENT,
  title varchar
  (255),
  kind int default 0,
  startTime datetime,
  scoreA int,
  scoreB int,
  status int,
  loc varchar
  (255),
  size INT,
  PRIMARY KEY
  (id)
);

  INSERT INTO matches
    (title, startTime, loc, size)
  VALUES
    ('Friendly', Now(), 'Chi Lang', 10)

