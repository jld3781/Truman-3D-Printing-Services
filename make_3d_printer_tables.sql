use sjl6333;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE if EXISTS USER;
DROP TABLE if EXISTS PROJECT;
DROP TABLE if EXISTS PRINTER;
DROP TABLE if EXISTS PRINT_JOB;
DROP TABLE if EXISTS FILAMENT;
DROP TABLE if EXISTS CAN_PRINT;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE USER(
  Username VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  FirstName VARCHAR(255) NOT NULL,
  LastName VARCHAR(255) NOT NULL,
  PhoneNumber VARCHAR(20) NOT NULL,
  FacultyFlag ENUM('T', 'F') NOT NULL,
  AdminFlag ENUM('T', 'F') NOT NULL,
  StudentId VARCHAR(255) NOT NULL,
  PasswordHash TEXT NOT NULL, 
  PRIMARY KEY (Username) );
  
CREATE TABLE PROJECT(
  CreatorUsername VARCHAR(255) NOT NULL,
  ProjectName VARCHAR(255) NOT NULL,
  ProjectLink TEXT,
  Picture LONGBLOB,
  PRIMARY KEY (CreatorUsername, ProjectName),
  FOREIGN KEY (CreatorUsername) REFERENCES USER(Username) );
  
CREATE TABLE PRINTER(
  PrinterId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Location VARCHAR(255) NOT NULL,
  MaximumLength FLOAT,
  MaximumWidth FLOAT,
  MaximumHeight FLOAT,
  PRIMARY KEY (PrinterId) );

CREATE TABLE FILAMENT(
  Color VARCHAR(255) NOT NULL,
  Type VARCHAR(255) NOT NULL,
  PricePerPound DECIMAL(5,2) NOT NULL, 
  PRIMARY KEY (Color, Type) );
  
CREATE TABLE CAN_PRINT(
  Color VARCHAR(255) NOT NULL,
  Type VARCHAR(255) NOT NULL,
  PrinterId INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (Color, Type, PrinterId),
  FOREIGN KEY (Color, Type) REFERENCES FILAMENT(Color, Type),
  FOREIGN KEY (PrinterId) REFERENCES PRINTER(PrinterId) );

CREATE TABLE PRINT_JOB(
  JobId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  PrinterId INTEGER UNSIGNED,
  PrinterUsername VARCHAR(255) NOT NULL,
  CreatorUsername VARCHAR(255) NOT NULL,
  ProjectName VARCHAR(255) NOT NULL,
  Status ENUM('Waiting', 'Printing', 'On Hold', 'Completed', 'Rejected') NOT NULL,
  StartTime DATETIME,
  StopTime DATETIME,
  SubmittedTime DATETIME,
  Length FLOAT,
  Width FLOAT,
  Height FLOAT,
  Color VARCHAR(255) NOT NULL,
  ChargedPrice DECIMAL(5,2),
  Comment TEXT,
  Weight FLOAT,
  MaterialType VARCHAR(255) NOT NULL,
  PRIMARY KEY (JobId),
  FOREIGN KEY (Color, MaterialType, PrinterId) REFERENCES CAN_PRINT(Color, Type, PrinterId),
  FOREIGN KEY (PrinterUsername) REFERENCES USER(Username),
  FOREIGN KEY (CreatorUsername, ProjectName) REFERENCES PROJECT(CreatorUsername, ProjectName) );

insert into USER(Username, Email, FirstName, LastName, PhoneNumber, FacultyFlag, AdminFlag, StudentId, PasswordHash) VALUES('sjl6333', 'sjl6333@truman.edu', 'Samuel', 'Livingston', '8165880680', 'F', 'T', '000850633', '$2y$10$zfbz2zZAfjKU.VojcOBS8Orig2IOrrk.OV4daS0Nc3bhB6i9PxHN6');

insert into USER(Username, Email, FirstName, LastName, PhoneNumber, FacultyFlag, AdminFlag, StudentId, PasswordHash) VALUES('jbeck1', 'jbeck1@truman.edu', 'John', 'Beck', '5555555555', 'T', 'T', '000555555', '$2y$10$KeZ7BWHavInV1d0UG4IvwO.THREl7fYr4oLwz.d.WgSD5FaOLKFnu');

insert into USER(Username, Email, FirstName, LastName, PhoneNumber, FacultyFlag, AdminFlag, StudentId, PasswordHash) VALUES('jbeck2', 'jbeck2@truman.edu', 'John', 'Beck', '5555555555', 'T', 'F', '000555555', '$2y$10$rKQ0RH/tNEJDz.kzRi9Z4.Jlxk.SFHKO3zcFSXfig1TcUacQSSn9m');

insert into USER(Username, Email, FirstName, LastName, PhoneNumber, FacultyFlag, AdminFlag, StudentId, PasswordHash) VALUES('jfs1744', 'jfs1744@truman.edu', 'Jimmy', 'Sorsen', '3144880298', 'F', 'T', '000755259', '$2y$10$ASSTqS0yged.srk8ESwzmu8RjI7cmezFBF083a3mwOaQwDLI.hxLy');

insert into USER(Username, Email, FirstName, LastName, PhoneNumber, FacultyFlag, AdminFlag, StudentId, PasswordHash) VALUES('jld3781', 'jld3781@truman.edu', 'Jessica', 'DiMariano', '3145935436', 'F', 'T', '000713731', '$2y$10$ASSTqS0yged.srk8ESwzmu8RjI7cmezFBF083a3mwOaQwDLI.hxLy');

insert into PROJECT(CreatorUsername, ProjectName, ProjectLink, Picture) VALUES('sjl6333','Arc Reactor', 'http://www.thingiverse.com/thing:32274', 'http://thingiverse-production.s3.amazonaws.com/renders/17/f3/3a/ac/e5/IMG_20121027_120437_preview_featured.jpg');

insert into PROJECT(CreatorUsername, ProjectName, ProjectLink, Picture) VALUES('jld3781','Star-Lord Elemental Gun', 'http://www.thingiverse.com/thing:525787', 'http://thingiverse-production.s3.amazonaws.com/renders/96/f2/c0/dc/91/20141026_205240_preview_featured.jpg');

insert into PROJECT(CreatorUsername, ProjectName, ProjectLink, Picture) VALUES('jfs1744','Robots vs Wizards Chess Set', 'http://www.thingiverse.com/thing:351119', 'http://thingiverse-production.s3.amazonaws.com/renders/50/a1/0f/d7/f1/photo_13__preview_featured.jpg');

insert into PROJECT(CreatorUsername, ProjectName, ProjectLink, Picture) VALUES('sjl6333','Skeletal Dragon', 'http://www.thingiverse.com/thing:488887', 'http://thingiverse-production.s3.amazonaws.com/renders/f8/70/06/2c/fe/IMG_0276_preview_featured.jpg');

insert into PROJECT(CreatorUsername, ProjectName, ProjectLink, Picture) VALUES('sjl6333','Rhino', 'http://www.thingiverse.com/thing:761744', 'http://thingiverse-production-new.s3.amazonaws.com/renders/47/86/89/68/5d/IMG_8890_preview_featured.JPG');

insert into PROJECT(CreatorUsername, ProjectName, ProjectLink, Picture) VALUES('sjl6333','Elephant', 'http://www.thingiverse.com/thing:257911', 'http://thingiverse-production.s3.amazonaws.com/renders/de/9f/5b/a0/a6/elephant1_preview_featured.jpg');

insert into PROJECT(CreatorUsername, ProjectName, ProjectLink, Picture) VALUES('sjl6333','Swiss Army Style SD Holder', 'http://www.thingiverse.com/thing:633436', 'http://thingiverse-production.s3.amazonaws.com/renders/97/a9/be/6b/16/DSC_2273_preview_featured.JPG');

insert into PRINTER(Location, MaximumLength, MaximumWidth, MaximumHeight) VALUES('Pickler', '9.9', '7.8', '5.9');
insert into PRINTER(Location, MaximumLength, MaximumWidth, MaximumHeight) VALUES('Pickler', '9.9', '7.8', '5.9'); 
insert into PRINTER(Location, MaximumLength, MaximumWidth, MaximumHeight) VALUES('Violette', '9.9', '7.8', '5.9');
insert into PRINTER(Location, MaximumLength, MaximumWidth, MaximumHeight) VALUES('Magruder', '9.9', '7.8', '5.9');
insert into PRINTER(Location, MaximumLength, MaximumWidth, MaximumHeight) VALUES('SUB', '9.9', '7.8', '5.9');
insert into PRINTER(Location, MaximumLength, MaximumWidth, MaximumHeight) VALUES('Magruder', '9.9', '7.8', '5.9');

insert into FILAMENT(Color, Type, PricePerPound) VALUES('Red', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Purple', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Green', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Orange', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Blue', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Gold', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Gray', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('White', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Black', 'ABS', '11.34');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Red', 'PLA', '12.25');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Purple', 'PLA', '12.25');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Green', 'PLA', '12.25');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Blue', 'PLA', '12.25');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('Gray', 'PLA', '12.25');
insert into FILAMENT(Color, Type, PricePerPound) VALUES('White', 'PLA', '12.25');

insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Orange', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gold', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Black', 'ABS', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'PLA', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'PLA', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'PLA', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'PLA', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'PLA', '1');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'PLA', '1');

insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Orange', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gold', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Black', 'ABS', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'PLA', '2');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'PLA', '2');

insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Orange', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gold', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Black', 'ABS', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'PLA', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'PLA', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'PLA', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'PLA', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'PLA', '3');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'PLA', '3');

insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Orange', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gold', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Black', 'ABS', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'PLA', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'PLA', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'PLA', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'PLA', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'PLA', '4');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'PLA', '4');

insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Orange', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gold', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Black', 'ABS', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'PLA', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'PLA', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'PLA', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'PLA', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'PLA', '5');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'PLA', '5');

insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Red', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Purple', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Green', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Orange', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Blue', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gold', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Black', 'ABS', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('White', 'PLA', '6');
insert into CAN_PRINT(Color, Type, PrinterId) VALUES('Gray', 'PLA', '6');

insert into PRINT_JOB(PrinterId, PrinterUsername, CreatorUsername, ProjectName, Status, StartTime, SubmittedTime, Length, Width, Height, Color, ChargedPrice, Comment, Weight, MaterialType) VALUES('1', 'sjl6333', 'sjl6333', 'Arc Reactor', 'Waiting', '2015-03-22 10:34:09 PM', '2015-03-18 04:56:49 PM', '3.2', '3.2', '3.2', 'White', '8.34', 'Please fast please', '.5', 'ABS');

insert into PRINT_JOB(PrinterId, PrinterUsername, CreatorUsername, ProjectName, Status, StartTime, SubmittedTime, Length, Width, Height, Color, ChargedPrice, Comment, Weight, MaterialType) VALUES('1', 'jld3781', 'jld3781', 'Star-Lord Elemental Gun', 'Waiting', '2015-03-24 11:45:14 AM', '2015-03-19 11:42:30 AM', '5.3', '3.5', '3.8', 'Blue', '15.64', 'Make as large as possible', '.5', 'ABS');

insert into PRINT_JOB(PrinterId, PrinterUsername, CreatorUsername, ProjectName, Status, StartTime, SubmittedTime, Length, Width, Height, Color, ChargedPrice, Comment, Weight, MaterialType) VALUES('2', 'jfs1744', 'jfs1744', 'Robots vs Wizards Chess Set', 'Waiting', '2015-04-16 02:55:06 AM', '2015-04-14 6:17:22 PM', '8.1', '8.1', '3.1', 'Gray', '12.05', 'No Comment', '.5', 'PLA');

insert into PRINT_JOB(PrinterId, PrinterUsername, CreatorUsername, ProjectName, Status, StartTime, SubmittedTime, Length, Width, Height, Color, ChargedPrice, Comment, Weight, MaterialType) VALUES('4', 'jbeck1', 'jfs1744', 'Robots vs Wizards Chess Set', 'Printing', '2015-04-16 09:53:10 AM', '2015-04-15 10:54:56 AM', '8.1', '8.1', '3.1', 'White', '12.05', 'No Comment', '.5', 'ABS');

insert into PRINT_JOB(PrinterId, PrinterUsername, CreatorUsername, ProjectName, Status, StartTime, StopTime, SubmittedTime, Length, Width, Height, Color, ChargedPrice, Comment, Weight, MaterialType) VALUES('4', 'jbeck1', 'jfs1744', 'Robots vs Wizards Chess Set', 'Completed', '2015-04-16 09:53:10 AM', '2015-04-16 02:53:10 PM', '2015-04-15 08:05:00 PM', '8.1', '8.1', '3.1', 'White', '12.05', 'No Comment', '.5', 'ABS');

insert into PRINT_JOB(PrinterId, PrinterUsername, CreatorUsername, ProjectName, Status, StartTime, StopTime, SubmittedTime, Length, Width, Height, Color, ChargedPrice, Comment, Weight, MaterialType) VALUES('1', 'sjl6333', 'sjl6333', 'Arc Reactor', 'Completed', '2015-04-19 10:34:09 AM', '2015-04-19 11:20:043 AM', '2015-04-18 09:33:26 PM', '3.5', '3.5', '3.5', 'White', '8.34', 'Please fast please', '.5', 'ABS');
