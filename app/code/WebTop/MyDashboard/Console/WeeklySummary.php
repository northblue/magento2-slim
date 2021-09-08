<?php
namespace WebTop\MyDashboard\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class WeeklySummary extends Command
{

    const WEEKS = 'weeks';
    protected function configure()
    {
        $options = [
            new InputOption(
                self::WEEKS,
                null,
                InputOption::VALUE_REQUIRED,
                'Weeks'
            )
        ];

        $this->setName('mydashboard:weeklysummary')
            ->setDescription('Get Weekly Auction Summary')
            ->setDefinition($options);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get(\WebTop\MyDashboard\Helper\Data::class);

        if ($weeks = $input->getOption(self::WEEKS)) {
            $result = $helper->getAuctionSummaryData($weeks-1);
        } else {
            $result = $helper->getAuctionSummaryData();
        }

        if(count($result) > 0) {
            $output->writeln("Updating weekly summary for last ".count($result).' weeks');
            $this->SaveWeeklySummary($result);
            $output->writeln("Data has been saved");
        } else {
            $output->writeln("No available data");
        }
        return $this;
    }

    protected function SaveWeeklySummary($data) {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        
        //TODO need to fetch area from request
        foreach ($data as $summary) {
            $model = $objectManager->create('WebTop\MyDashboard\Model\WeeklySummary');
            $model->setDate($summary['Date'])
                ->setArea('Sydney')
                ->setClearanceRate($summary['Clearance rate'])
                ->setAuctionsScheduled($summary['Auctions scheduled'])
                ->setAuctionsReported($summary['Auctions reported'])
                ->setSold($summary['Sold'])
                ->setWithdrawn($summary['Withdrawn'])
                ->setPassedIn($summary['Passed in'])
                ->setTotalSales($summary['Total sales'])
                ->setMedian($summary['Median'])
                ->save(); 
            echo 'Saved for '.$summary['Date'].PHP_EOL;
        }
    }
}