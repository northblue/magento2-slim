<?php
namespace WebTop\MyDashboard\Model;
class WeeklySummary extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'webtop_mydashboard_weekly_summary';

	protected $_cacheTag = 'webtop_mydashboard_weekly_summary';

	protected $_eventPrefix = 'webtop_mydashboard_weekly_summary';

	protected function _construct()
	{
		$this->_init('WebTop\MyDashboard\Model\ResourceModel\WeeklySummary');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}