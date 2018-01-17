<?php

namespace wbb\system\cronjob;

use wcf\data\cronjob\Cronjob;
use wcf\system\cronjob\AbstractCronjob;
use wcf\system\WCF;

class WBBCompatibilityCronjob extends AbstractCronjob {
	/**
	 * @inheritDoc
	 */
	public function execute(Cronjob $cronjob) {
		parent::execute($cronjob);
		
		$sql = "DELETE FROM     wcf".WCF_N."_package_update_exclusion
			WHERE           excludedPackageVersion = ?
					AND excludedPackage = ?
					AND packageUpdateVersionID IN (
						SELECT  packageUpdateVersionID
						FROM    wcf".WCF_N."_package_update_version
						WHERE   packageVersion LIKE ?
							AND packageUpdateID = (
							SELECT  packageUpdateID
							FROM    wcf".WCF_N."_package_update
							WHERE   package = ?
						)
					)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(['3.1.0 Alpha 1', 'com.woltlab.wcf', '5.0.%', 'com.woltlab.wbb']);
		
		$sql = "DELETE FROM     wcf".WCF_N."_package_exclusion
			WHERE           excludedPackageVersion = ?
					AND excludedPackage = ?
					AND packageID = (
						SELECT  packageID
						FROM    wcf".WCF_N."_package
						WHERE   packageVersion LIKE ?
							AND package = ?
					)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(['3.1.0 Alpha 1', 'com.woltlab.wcf', '5.0.%', 'com.woltlab.wbb']);
	}
}
