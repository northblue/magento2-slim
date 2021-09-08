<?php
namespace WebTop\MyDashboard\Model\ResourceModel\WeeklySummary;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'entity_id';
	protected $_eventPrefix = 'webtop_mydashboard_weekly_summary_collection';
	protected $_eventObject = 'weekly_summary_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('WebTop\MyDashboard\Model\WeeklySummary', 'WebTop\MyDashboard\Model\ResourceModel\WeeklySummary');
	}

}