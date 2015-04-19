#Still may need some "Unique" tags candidate keys
#Has not been run yet!!
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
  Email VARCHAR(255) NOT NULL,
  FirstName VARCHAR(255) NOT NULL,
  LastName VARCHAR(255) NOT NULL,
  PhoneNumber VARCHAR(20) NOT NULL,
  StudentFlag ENUM('T', 'F') NOT NULL,
  AdminFlag ENUM('T', 'F') NOT NULL,
  PasswordHash TEXT NOT NULL, 
  PRIMARY KEY (Email) );
  
CREATE TABLE PROJECT(
  CreatorEmail VARCHAR(255) NOT NULL,
  ProjectName VARCHAR(255) NOT NULL,
  ProjectLink TEXT,
  Picture LONGBLOB,
  PRIMARY KEY (CreatorEmail, ProjectName),
  FOREIGN KEY (CreatorEmail) REFERENCES USER(Email) );
  
CREATE TABLE PRINTER(
  PrinterId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Location VARCHAR(255) NOT NULL,
  MaximumLength DECIMAL,
  MaximumWidth DECIMAL,
  MaximumHeight DECIMAL,
  PRIMARY KEY (PrinterId) );

CREATE TABLE FILAMENT(
  Color VARCHAR(255) NOT NULL,
  Type VARCHAR(255) NOT NULL,
  PricePerPound DECIMAL NOT NULL, 
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
  PrinterId INTEGER UNSIGNED NOT NULL,
  PrinterEmail VARCHAR(255) NOT NULL,
  CreatorEmail VARCHAR(255) NOT NULL,
  ProjectName VARCHAR(255) NOT NULL,
  Status ENUM('Waiting', 'Printing', 'On Hold', 'Complete', 'Rejected') NOT NULL,
  StartTime DATETIME,
  StopTime DATETIME,
  Length DECIMAL,
  Width DECIMAL,
  Height DECIMAL,
  Color VARCHAR(255) NOT NULL,
  ChargedPrice DECIMAL,
  Comment TEXT,
  Weight DECIMAL,
  MaterialType VARCHAR(255) NOT NULL,
  PRIMARY KEY (JobId),
  FOREIGN KEY (Color, MaterialType, PrinterId) REFERENCES CAN_PRINT(Color, Type, PrinterId),
  FOREIGN KEY (PrinterEmail) REFERENCES USER(Email),
  FOREIGN KEY (CreatorEmail, ProjectName) REFERENCES PROJECT(CreatorEmail, ProjectName) );

insert into USER(Email, FirstName, LastName, PhoneNumber, StudentFlag, AdminFlag, PasswordHash) VALUES('hello@gmail.com', 'Samuel', 'Livingston', '8165880680', 'T', 'T', '$osiehjf9pa8w37r893nhfui3y287');

