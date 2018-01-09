<?php

namespace wbb\system\sitemap\object;

use wbb\data\board\Board;
use wcf\data\DatabaseObject;
use wcf\system\sitemap\object\AbstractSitemapObjectObjectType;

class MBoardSitemapObject extends AbstractSitemapObjectObjectType {
	/**
	 * @inheritdoc
	 */
	public function getObjectClass() {
		return Board::class;
	}
	
	/**
	 * @inheritdoc
	 */
	public function getLastModifiedColumn() {
		return parent::getLastModifiedColumn();
	}
	
	/**
	 * @inheritdoc
	 */
	public function canView(DatabaseObject $object) {
		/** @var Board $object */
		return $object->canEnter();
	}
}
