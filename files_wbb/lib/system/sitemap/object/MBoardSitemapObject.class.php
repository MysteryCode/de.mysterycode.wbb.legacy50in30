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
	public function getObjectList() {
		$objectList = parent::getObjectList();
		$objectList->sqlJoins .= ' LEFT JOIN wbb' . WCF_N . '_thread thread_table ON thread_table.boardID = board.boardID';
		$objectList->sqlConditionJoins .= ' LEFT JOIN wbb' . WCF_N . '_thread thread_table ON thread_table.boardID = board.boardID';
		$objectList->sqlSelects .= (!empty($objectList->sqlSelects) ? ', ' : '') . 'MAX(thread_table.lastPostTime)';
		
		return $objectList;
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
		/** @var Board $object */
		return $object->canEnter();
	}
}
