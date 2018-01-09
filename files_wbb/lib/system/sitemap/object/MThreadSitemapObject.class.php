<?php

namespace wbb\system\sitemap\object;

use wbb\data\thread\Thread;
use wcf\data\DatabaseObject;
use wcf\system\sitemap\object\AbstractSitemapObjectObjectType;

class MThreadSitemapObject extends AbstractSitemapObjectObjectType {
	/**
	 * @inheritdoc
	 */
	public function getObjectClass() {
		return Thread::class;
	}
	
	/**
	 * @inheritdoc
	 */
	public function getLastModifiedColumn() {
		return 'lastPostTime';
	}
	
	/**
	 * @inheritdoc
	 */
	public function canView(DatabaseObject $object) {
		/** @var Thread $object */
		return $object->canRead();
	}
}
