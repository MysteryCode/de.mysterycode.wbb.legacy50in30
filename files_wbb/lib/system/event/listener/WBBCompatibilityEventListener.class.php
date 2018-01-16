<?php

namespace wcf\system\event\listener;

class WBBCompatibilityEventListener implements IParameterizedEventListener {
	/**
	 * @inheritDoc
	 */
	public function execute($eventObj, $className, $eventName, array &$parameters) {
		// only wsc 3.1
		if (substr(WCF_VERSION, 0, 3) != '3.1') return;
		
		if ($eventName == 'saved') {
			/** @var \wcf\acp\form\PackageStartInstallForm $eventObj */
			if ($eventObj->queue->package != 'com.woltlab.wbb') return;
		}
		else if ($eventName == 'saved') {
		
		}
	}
}
