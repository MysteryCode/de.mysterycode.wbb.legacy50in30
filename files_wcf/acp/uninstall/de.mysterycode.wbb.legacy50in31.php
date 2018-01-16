<?php

use wcf\system\WCF;

// remove existing excludes
$sql = "INSERT INTO     wcf".WCF_N."_package_update_exclusion
	(packageUpdateVersionID, excludedPackage, excludedPackageVersion)
	VALUES (
		SELECT  packageUpdateVersionID, ?, ?
		FROM    wcf".WCF_N."_package_update_version
		WHERE   packageVersion LIKE ?
			AND packageUpdateID = (
				SELECT  packageUpdateID
				FROM    wcf".WCF_N."_package_update
				WHERE   package = ?
			)
	)";
$statement = WCF::getDB()->prepareStatement($sql);
$statement->execute(['com.woltlab.wcf', '3.1.0 Alpha 1', '5.0.%', 'com.woltlab.wbb']);

$sql = "INSERT INTO     wcf".WCF_N."_package_exclusion
	(packageID, excludedPackage, excludedPackageVersion)
	VALUES (
		SELECT  packageID, ?, ?
		FROM    wcf".WCF_N."_package
		WHERE   packageVersion LIKE ?
			AND package = ?
	)";
$statement = WCF::getDB()->prepareStatement($sql);
$statement->execute(['com.woltlab.wcf', '3.1.0 Alpha 1', '5.0.%', 'com.woltlab.wbb']);

//TODO dumo board icon data into JSON file
//TODO dump moderation actions
