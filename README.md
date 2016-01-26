`````
#DATABASE
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `erp`.`branch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`branch` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fio` VARCHAR(200) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `image` VARCHAR(450) NULL,
  `hour_price` INT(11) NOT NULL DEFAULT 0,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` INT NOT NULL,
  `role` ENUM('admin','worker','manager') NULL DEFAULT 'admin',
  PRIMARY KEY (`id`),
  INDEX `fk_user_branch_idx` (`branch_id` ASC),
  CONSTRAINT `fk_user_branch`
    FOREIGN KEY (`branch_id`)
    REFERENCES `erp`.`branch` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`product` (
  `id` INT NOT NULL,
  `name` VARCHAR(450) NOT NULL,
  `description` TEXT NULL,
  `customer_info` TEXT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`project` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(450) NOT NULL,
  `active` TINYINT NOT NULL DEFAULT 1,
  `estimate_url` VARCHAR(400) NULL,
  `hourly_payment` TINYINT NOT NULL DEFAULT 0,
  `budget` BIGINT NULL,
  `description` TEXT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_info` TEXT NULL,
  `archive` TINYINT NOT NULL DEFAULT 0,
  `product_id` INT NOT NULL,
  `total_amount` BIGINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_project_product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_project_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `erp`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`project_branch_plan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`project_branch_plan` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `branch_id` INT NOT NULL,
  `project_id` INT NOT NULL,
  `budget` BIGINT NULL,
  `hours` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_project_branch_plan_branch1_idx` (`branch_id` ASC),
  INDEX `fk_project_branch_plan_project1_idx` (`project_id` ASC),
  CONSTRAINT `fk_project_branch_plan_branch1`
    FOREIGN KEY (`branch_id`)
    REFERENCES `erp`.`branch` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_project_branch_plan_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `erp`.`project` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`task` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(450) NOT NULL,
  `description` TEXT NOT NULL,
  `link` VARCHAR(450) NULL,
  `hours` INT(11) NOT NULL DEFAULT 0,
  `datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` INT NOT NULL,
  `project_id` INT NOT NULL,
  `amount` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_task_user1_idx` (`user_id` ASC),
  INDEX `fk_task_project1_idx` (`project_id` ASC),
  CONSTRAINT `fk_task_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `erp`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_task_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `erp`.`project` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`payment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(450) NOT NULL,
  `description` TEXT NULL,
  `datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` BIGINT NOT NULL DEFAULT 0,
  `project_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_payment_project1_idx` (`project_id` ASC),
  CONSTRAINT `fk_payment_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `erp`.`project` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`expense`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`expense` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(450) NOT NULL,
  `amount` BIGINT NOT NULL DEFAULT 0,
  `description` TEXT NULL,
  `datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_expense_project1_idx` (`project_id` ASC),
  CONSTRAINT `fk_expense_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `erp`.`project` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`chat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` TEXT NOT NULL,
  `update_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_chat_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_chat_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `erp`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`notification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`notification` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notification_branch1_idx` (`branch_id` ASC),
  CONSTRAINT `fk_notification_branch1`
    FOREIGN KEY (`branch_id`)
    REFERENCES `erp`.`branch` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`project_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`project_info` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_project_info_project1_idx` (`project_id` ASC),
  CONSTRAINT `fk_project_info_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `erp`.`project` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erp`.`project_info_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erp`.`project_info_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `project_info_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_project_info_user_project_info1_idx` (`project_info_id` ASC),
  INDEX `fk_project_info_user_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_project_info_user_project_info1`
    FOREIGN KEY (`project_info_id`)
    REFERENCES `erp`.`project_info` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_project_info_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `erp`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

`````