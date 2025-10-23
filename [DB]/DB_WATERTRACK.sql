
# ------------------------------------PERFIL UTILIZADOR------------------------------------
CREATE TABLE `userProfile` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `birthDate` DATE NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `userID` INT NOT NULL UNIQUE,
  
  CONSTRAINT `fk_userprofile_user`
    FOREIGN KEY (`userID`) REFERENCES `user`(`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

  INDEX `idx_user_id` (`userID`) VISIBLE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
#--------------------------------------------------------------------------------------

# ------------------------------------EMPRESAS------------------------------------
CREATE TABLE `enterprise` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `contactNumber` VARCHAR(100),
  `contactEmail` VARCHAR(100),
  `website` VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
#--------------------------------------------------------------------------------------

# ------------------------------------TIPO CONTADOR------------------------------------
CREATE TABLE `meterType` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `description` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
#--------------------------------------------------------------------------------------

# ------------------------------------TECNICO INFO------------------------------------
CREATE TABLE `technicianInfo` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`userID` INT NOT NULL,
	`enterpriseID` INT NOT NULL,
	`profissionalCertificateNumber` VARCHAR(100) NOT NULL,
  
  
	CONSTRAINT `fk_technicianinfo_user`
    FOREIGN KEY (`userID`) REFERENCES `user`(`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    
    CONSTRAINT `fk_technicianinfo_enterprise`
    FOREIGN KEY (`enterpriseID`) REFERENCES `enterprise`(`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
	
    INDEX `idx_user_id` (`userID`) VISIBLE,
	INDEX `idx_enterprise_id` (`enterpriseID`) VISIBLE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
#--------------------------------------------------------------------------------------

# ------------------------------------CONTADOR------------------------------------
CREATE TABLE `meter` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `address` VARCHAR(100) NOT NULL,
  `userID` INT NOT NULL,
  `meterTypeID` INT NOT NULL,
  `enterpriseID` INT NOT NULL,
  `class` VARCHAR(10) NOT NULL,
  `instalationDate` DATE NOT NULL,
  `shutdownDate` DATE DEFAULT NULL,
  `maxCapacity` DECIMAL(10,2) NOT NULL,
  `measureUnity` VARCHAR(10) NOT NULL,
  `supportedTemperature` DECIMAL(5,2) NOT NULL,
  `state` TINYINT(1) NOT NULL,
  
  
  CONSTRAINT `fk_meter_user`
  FOREIGN KEY (`userID`) REFERENCES `user`(`id`)
  ON UPDATE CASCADE ON DELETE RESTRICT,
  
  CONSTRAINT `fk_meter_metertype`
  FOREIGN KEY (`meterTypeID`) REFERENCES `meterType`(`id`)
  ON UPDATE CASCADE ON DELETE RESTRICT,

  CONSTRAINT `fk_meter_enterprise`
  FOREIGN KEY (`enterpriseID`) REFERENCES `enterprise`(`id`)
  ON UPDATE CASCADE ON DELETE RESTRICT,

  INDEX `idx_user_id` (`userID`) VISIBLE,
  INDEX `idx_meter_type_id` (`meterTypeID`) VISIBLE,
  INDEX `idx_enterprise_id` (`enterpriseID`) VISIBLE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
#--------------------------------------------------------------------------------------

# ------------------------------------AVARIA CONTADOR------------------------------------
CREATE TABLE `meterProblem` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`meterID` INT NOT NULL,
	`userID` INT NOT NULL,
	`problemType` VARCHAR(100) NOT NULL,
	`desc` VARCHAR(100) NOT NULL,
  
	CONSTRAINT `fk_meterProblem_meter`
    FOREIGN KEY (`meterID`) REFERENCES `meter`(`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    
    CONSTRAINT `fk_meterProblem_user`
    FOREIGN KEY (`userID`) REFERENCES `user`(`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

	INDEX `idx_meter_id` (`meterID`) VISIBLE,
	INDEX `idx_user_id` (`userID`) VISIBLE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
#--------------------------------------------------------------------------------------


# ------------------------------------LEITURAS CONTADOR------------------------------------
CREATE TABLE `meterReading` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
    `meterID` INT NOT NULL,
	`reading` VARCHAR(100) NOT NULL,
	`accumulatedConsumption` VARCHAR(100) NOT NULL,
	`date` DATE NOT NULL,
    `waterPressure` VARCHAR(100) NOT NULL,
    `desc` VARCHAR(100) NOT NULL,
    `problemState` TINYINT(1) NOT NULL,
  
	CONSTRAINT `fk_meterReading_meter`
    FOREIGN KEY (`meterID`) REFERENCES `meter`(`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

	INDEX `idx_meter_id` (`meterID`) VISIBLE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
#--------------------------------------------------------------------------------------