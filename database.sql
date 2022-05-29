create database string;
use string;

CREATE TABLE USERS(
	Id integer primary key auto_increment,
	Username VARCHAR(50) unique,
	Email VARCHAR(255),
	Nome VARCHAR(20),
	Cognome VARCHAR(20),
	Nposts integer default 0,
	Password VARCHAR(50)
)Engine = InnoDB;


CREATE TABLE POSTS (
    Id integer primary key auto_increment,
    User integer not null,
    Title VARCHAR(25),
	Text VARCHAR(255),
	Time timestamp not null default current_timestamp,
    foreign key(user) references USERS(Id) on delete cascade on update cascade
) Engine = InnoDB;



DELIMITER //
CREATE TRIGGER numPostsTrigger
AFTER INSERT ON POSTS
FOR EACH ROW
BEGIN
UPDATE USERS 
SET Nposts = Nposts + 1
WHERE id = new.User;          
END //
DELIMITER ;
