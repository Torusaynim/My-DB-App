CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
);

-- -----------------------------------------------------
-- Table `Institutes`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `Institutes`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `InstituteName` VARCHAR(50) NOT NULL,
  `InstituteHeadName` VARCHAR(50) NOT NULL,
  `InstituteOffice` INTEGER(10) NOT NULL,
  PRIMARY KEY (`id`)
);

-- -----------------------------------------------------
-- Table `Departments`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `Departments`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `DepartmentName` VARCHAR(50) NOT NULL,
  `DepartmentHeadName` VARCHAR(50) NOT NULL,
  `DepartmentOffice` INTEGER(10) NOT NULL,
  `InstituteID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`id`, `InstituteID`),
  FOREIGN KEY (`InstituteID`) REFERENCES `Institutes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------
-- Table `StudyGroups`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `StudyGroups`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `GroupName` VARCHAR(50) NOT NULL,
  `GroupTerm` INTEGER(2) NOT NULL,
  `GroupDepartmentID` INTEGER(10) NOT NULL,
  `GroupInstituteID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`id`, `GroupDepartmentID`, `GroupInstituteID`),
  FOREIGN KEY (`GroupDepartmentID`, `GroupInstituteID`) REFERENCES `Departments` (`id`, `InstituteID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------
-- Table `Subjects`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `Subjects`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `SubjectName` VARCHAR(50) NOT NULL,
  `SubjectFinals` VARCHAR(20) NULL,
  `SubjectDepartmentID` INTEGER(10) NOT NULL,
  `SubjectInstituteID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`id`, `SubjectDepartmentID`, `SubjectInstituteID`),
  FOREIGN KEY (`SubjectDepartmentID`, `SubjectInstituteID`) REFERENCES `Departments` (`id`, `InstituteID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------
-- Table `Classes`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `Classes`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `ClassDate` DATE NOT NULL,
  `ClassTime` TIME NOT NULL,
  `ClassRoom` INTEGER(10) NOT NULL,
  `ClassForm` BOOLEAN NOT NULL,
  `GroupID` INTEGER(10) NOT NULL,
  `GroupDepartmentID` INTEGER(10) NOT NULL,
  `GroupInstituteID` INTEGER(10) NOT NULL,
  `SubjectID` INTEGER(10) NOT NULL,
  `SubjectDepartmentID` INTEGER(10) NOT NULL,
  `SubjectInstituteID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`id`,`GroupID`,`SubjectID`,`GroupDepartmentID`,`SubjectDepartmentID`,`GroupInstituteID`,`SubjectInstituteID`),
  FOREIGN KEY (`GroupID`, `GroupDepartmentID`, `GroupInstituteID`) REFERENCES `StudyGroups` (`id`, `GroupDepartmentID`, `GroupInstituteID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`SubjectID`, `SubjectDepartmentID`, `SubjectInstituteID`) REFERENCES `Subjects` (`id`, `SubjectDepartmentID`, `SubjectInstituteID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------
-- Table `Students`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `Students`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `StudentName` VARCHAR(50) NOT NULL,
  `StudentBirthday` DATE NULL,
  `Dorminory` BOOLEAN NOT NULL,
  `StudentEmail` VARCHAR(50) NULL,
  `StudentPhoneNum` VARCHAR(11) NULL,
  `GroupID` INTEGER(10) NOT NULL,
  `GroupDepartmentID` INTEGER(10) NOT NULL,
  `GroupInstituteID` INTEGER(10) NOT NULL,
  `IsHeadman` BOOLEAN NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`GroupID`, `GroupDepartmentID`, `GroupInstituteID`) REFERENCES `StudyGroups` (`id`, `GroupDepartmentID`, `GroupInstituteID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------
-- Table `Teachers`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `Teachers`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `TeacherName` VARCHAR(50) NOT NULL,
  `TeacherTitle` VARCHAR(50) NOT NULL,
  `TeacherEmail` VARCHAR(50) NULL,
  `SubjectID` INTEGER(10) NOT NULL,
  `SubjectDepartmentID` INTEGER(10) NOT NULL,
  `SubjectInstituteID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`SubjectID`, `SubjectDepartmentID`, `SubjectInstituteID`) REFERENCES `Subjects` (`id`, `SubjectDepartmentID`, `SubjectInstituteID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- -----------------------------------------------------
-- Triggers
-- -----------------------------------------------------

DELIMITER //
CREATE TRIGGER headman_update_check
BEFORE UPDATE
ON Students
FOR EACH ROW
IF NEW.IsHeadman=1 AND NEW.StudentEmail IS NULL AND NEW.StudentPhoneNum IS NULL THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Can not promote student without any contacts to a headman';
END IF//
DELIMITER ;

DELIMITER //
CREATE TRIGGER headman_insert_check
BEFORE INSERT
ON Students
FOR EACH ROW
IF NEW.IsHeadman=1 AND NEW.StudentEmail IS NULL AND NEW.StudentPhoneNum IS NULL THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Can not create a new student without any contacts as headman';
END IF//
DELIMITER ;

-- -----------------------------------------------------
-- Demonstrational Data
-- -----------------------------------------------------

USE appDB;

INSERT INTO Institutes VALUES
('1', 'Institute of Technical Studies', 'A. N. Nikolayevich', '301'),
('2', 'Institute of Informational Technologies', 'I. M. Viktorovich', '577'),
('3', 'Institute of Applied Chemistry', 'N. K. Konovalov', '350');

INSERT INTO Departments VALUES
('1', 'Applied Math', 'A. N. Jurchenko', '351', '1'),
('2', 'Hardware Development', 'I. N. Vorobyev', '452', '2'),
('3', 'Organic Chemistry', 'B. I. Palkin', '323', '3'),
('4', 'Web Development', 'A. L. Lidina', '461', '2');

INSERT INTO StudyGroups VALUES
('1', 'OC-05-19', '3', '3', '3'),
('2', 'HD-01-19', '3', '2', '2'),
('3', 'HD-02-19', '3', '2', '2'),
('4', 'WD-04-19', '3', '4', '2');

INSERT INTO Subjects VALUES
('1', 'Linear Algebra', 'Exam', '1', '1'),
('2', 'Data Structures', 'Zach', '2', '2'),
('3', 'Pharmacy', 'Exam', '3', '3');

INSERT INTO Classes VALUES
('1', '2021-10-21', '14:40:00', '301', '0', '4', '4', '2', '1', '1', '1'),
('2', '2021-10-21', '12:00:00', '112', '1', '1', '3', '3', '3', '3', '3'),
('3', '2021-10-21', '09:00:00', '255', '1', '3', '2', '2', '2', '2', '2');

INSERT INTO Students VALUES
('1', 'V. A. Demidov', '2000-09-14', '0', NULL, '79159871234', '1', '3', '3', '0'),
('2', 'K. Z. Zubanchinko', '2000-06-05', '0', 'Kzub@gmail.net', NULL, '3', '2', '2', '1'),
('3', 'V. V. Viktorovich', '2001-01-10', '1', NULL, NULL, '4', '4', '2', '0');

INSERT INTO Teachers VALUES
('1', 'A. V. Petrovna', 'Senior Lecturer', NULL, '3', '3', '3'),
('2', 'A. N. Kuprina', 'Senior Lecturer', 'Kuporos@voprosov.net', '2', '2', '2'),
('3', 'V. N. Potemkin', 'Professor', NULL, '1', '1', '1');

-- -----------------------------------------------------
-- Make sure to delete this ;)
-- -----------------------------------------------------
