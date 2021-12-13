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
  FOREIGN KEY (`InstituteID`) REFERENCES `Institutes` (`id`) ON DELETE CASCADE
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
  FOREIGN KEY (`GroupDepartmentID`, `GroupInstituteID`) REFERENCES `Departments` (`id`, `InstituteID`) ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `Subjects`
-- -----------------------------------------------------

USE appDB;
CREATE TABLE `Subjects`
(
  `id` INTEGER(10) NOT NULL AUTO_INCREMENT,
  `SubjectName` VARCHAR(50) NOT NULL,
  `SubjectFinals` VARCHAR(10) NULL,
  `SubjectDepartmentID` INTEGER(10) NOT NULL,
  `SubjectInstituteID` INTEGER(10) NOT NULL,
  PRIMARY KEY (`id`, `SubjectDepartmentID`, `SubjectInstituteID`),
  FOREIGN KEY (`SubjectDepartmentID`, `SubjectInstituteID`) REFERENCES `Departments` (`id`, `InstituteID`) ON DELETE CASCADE
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
  FOREIGN KEY (`GroupID`, `GroupDepartmentID`, `GroupInstituteID`) REFERENCES `StudyGroups` (`id`, `GroupDepartmentID`, `GroupInstituteID`) ON DELETE CASCADE,
  FOREIGN KEY (`SubjectID`, `SubjectDepartmentID`, `SubjectInstituteID`) REFERENCES `Subjects` (`id`, `SubjectDepartmentID`, `SubjectInstituteID`) ON DELETE CASCADE
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
  FOREIGN KEY (`GroupID`, `GroupDepartmentID`, `GroupInstituteID`) REFERENCES `StudyGroups` (`id`, `GroupDepartmentID`, `GroupInstituteID`) ON DELETE SET NULL
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
  PRIMARY KEY (`TeacherID`),
  FOREIGN KEY (`SubjectID`, `SubjectDepartmentID`, `SubjectInstituteID`) REFERENCES `Subjects` (`id`, `SubjectDepartmentID`, `SubjectInstituteID`) ON DELETE SET NULL
);
