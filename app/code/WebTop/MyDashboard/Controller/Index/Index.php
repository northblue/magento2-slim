<?php

namespace WebTop\MyDashboard\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
use QL\QueryList;
use DOMDocument;
use WebTop\MyDashboard\Helper\Data as MyDashboardHelper;


class Index extends \Magento\Framework\App\Action\Action

{
    protected $_pageFactory;

	protected $_weeklySummaryFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\WebTop\MyDashboard\Model\WeeklySummaryFactory $weeklySummaryFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_weeklySummaryFactory = $weeklySummaryFactory;
		return parent::__construct($context);
	}

    public function execute()
    {

        $returnArray = [];
        //$returnArray['dimensions'] = ['Date','Clearance rate','Auctions scheduled','Auctions reported','Sold','Withdrawn','Passed in','Total sales','Median'];
        //$returnArray['dimensions'] = ['date','clearance_rate','auctions_scheduled','auctions_reported','sold','withdrawn','passed_in','total_sales','median'];
        $weeklySummary = $this->_weeklySummaryFactory->create();
		$collection = $weeklySummary->getCollection()
            //->addFieldToSelect(array('date','clearance_rate','auctions_scheduled','auctions_reported','sold','withdrawn','passed_in','total_sales','median'))
            ->addFieldToSelect('date')
            ->addFieldToSelect('clearance_rate')
            ->addFieldToSelect('auctions_scheduled')
            ->addFieldToSelect('auctions_reported')
            ->addFieldToSelect('sold')
            ->addFieldToSelect('withdrawn')
            ->addFieldToSelect('passed_in')
            ->addFieldToSelect('total_sales')
            ->addFieldToSelect('median')
            ->setOrder('date', 'asc')
            ;
		foreach($collection as $key => $item){
            $returnArray['dimensions'] = array_keys($item->getData());
            $returnArray['source'][] = $item->getData();
		}


        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        /** @var Template $block */
        //WebTop\MyDashboard\Block\Index
        $block = $page->getLayout()->getBlock('mydashboard_index_index');

        $block->setData('dataSet',json_encode($returnArray));
        return $page;
    }
}
