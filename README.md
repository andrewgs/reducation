RosCentrDPO
=================
------------------------------------------------------------------------------------------------------------------------------------
Update DB to 01.09.2013

UPDATE `fizcourseorder` SET `price` = 6000 WHERE `course`=13
UPDATE `fizcourseorder` SET `price`= 1000 WHERE `course`IN (45,46,47)
UPDATE `fizcourseorder` SET `price`= 5000
ALTER TABLE `fizcourseorder` ADD `price` INT UNSIGNED NOT NULL ;

UPDATE `courseorder` SET `price` = 6000 WHERE `course`=13
UPDATE `courseorder` SET `price`= 1000 WHERE `course`IN (45,46,47)
UPDATE `courseorder` SET `price`= 5000
UPDATE `courses` SET `price`= 5000 WHERE `price` = 6000
UPDATE `courses` SET `price`= 4000 WHERE `price` = 5000
ALTER TABLE `trends` ADD `number` INT UNSIGNED NOT NULL AFTER `title` ;
ALTER TABLE `courseorder` ADD `price` INT UNSIGNED NOT NULL ;