<?php
namespace WebTop\MyDashboard\Model\ResourceModel;


class WeeklySummary extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('webtop_mydashboard_auction_summary', 'entity_id');
	}
	
}