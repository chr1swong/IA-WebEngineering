-- Table for account

DROP TABLE IF EXISTS account;
CREATE TABLE IF NOT EXISTS account (
	accountID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	matricNumber varchar(12) NOT NULL,
	accountEmail varchar(128) NOT NULL UNIQUE,
	accountPwd varchar(255) NOT NULL,
	accountRoles int NOT NULL DEFAULT 2 COMMENT '1 - Admin, 2 - User',
	registrationDate date NOT NULL DEFAULT CURRENT_DATE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table for profile 

DROP TABLE IF EXISTS profile;
CREATE TABLE IF NOT EXISTS profile (
	profileID int PRIMARY KEY AUTO_INCREMENT,
	username varchar(255),
	program varchar(4),
	intakeBatch int,
	phoneNumber varchar(20),
	mentor varchar(255),
	profileState varchar(64),
	profileAddress varchar(255),
	motto varchar(255),
	profileImagePath varchar(255),
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table for challenge

DROP TABLE IF EXISTS challenge;
CREATE TABLE IF NOT EXISTS challenge (
	challengeID int PRIMARY KEY AUTO_INCREMENT,
	challengeSem int,
	challengeYear varchar(16),
	challengeDetails varchar(255),
	challengeFuturePlan varchar(255),
	challengeRemark varchar(255),
	challengeImagePath varchar(255),
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- table for activity

DROP TABLE IF EXISTS activity;
CREATE TABLE IF NOT EXISTS activity (
	activityID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	activitySem int,
	activityYear int,
	activityType varchar(4) COMMENT '1 - Activity, 2 - Club, 3 - Association, 4 - Competition',
	activityLevel varchar(4) COMMENT '1 - Faculty, 2 - University, 3 - National, 4 - International',
	activityDetails varchar(255),
	activityRemarks varchar(255),
    activityImagePath varchar(255),
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- table for KPI indicator

DROP TABLE IF EXISTS indicator;
CREATE TABLE IF NOT EXISTS indicator (
	indicatorID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	indicatorSem int,
	indicatorYear int,
	indicatorCGPA float,
	indicatorLeadership int,
	indicatorGraduateAim varchar(32), /* as in On Time, or Delayed, or Ahead of Schedule */
	indicatorProfCert int,
	indicatorEmployability int, /* as in months after industrial training */
	indicatorMobProg int,
	accountID int,
	FOREIGN KEY (accountID) REFERENCES account(accountID) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;