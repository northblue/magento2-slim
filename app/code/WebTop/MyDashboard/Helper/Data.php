<?php

namespace WebTop\MyDashboard\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
use QL\QueryList;
use DOMDocument;

class Data extends AbstractHelper
{
        private $baseurl = 'https://www.domain.com.au/auction-results/sydney/';

        public function getStoreConfig()
        {
                return $this->baseurl;
        }

        public function getWeeklyAuctionSummary($date){
                return QueryList::get('https://www.domain.com.au/auction-results/sydney/'.$date)->find('.css-hcuym table')->html();
        }

        public function getAuctionSummaryDataByDate($date){
                
                $dateArray ['Date'] = $date;
                return array_merge($dateArray, $this->fetchWeeklyAuctionDataInArray($this->getWeeklyAuctionSummary($date)));
        }

        public function getAuctionSummaryData($numberOfWeeks = 0){

                $returnArray = [];
                $lastSaturday;
                for($i = 0; $i<= $numberOfWeeks; $i++) {
                        // echo $i * 7;
                        // exit;
                        if($i == 0) {
                                $lastSaturday =  date('Y-m-d', strtotime("last Saturday"));
                        } 
                        // echo $lastSaturday.' '.($i * 7).' days';
                        // exit;
                        $returnArray[] = $this->getAuctionSummaryDataByDate(date('Y-m-d', strtotime($lastSaturday.' -'.($i * 7).' days')));
                }
                return $returnArray;
                // print_r($returnArray);
                // exit;
                // return $this->getAuctionSummaryDataByDate(date('Y-m-d', strtotime("last Saturday")));    
        }

        public function fetchWeeklyAuctionDataInArray($data){
                $DOM = new DOMDocument();
                $DOM->loadHTML($data);

                $Header = $DOM->getElementsByTagName('th');
                $Detail = $DOM->getElementsByTagName('td');

                foreach($Header as $NodeHeader) 
                {
                        $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
                }

                //#Get header name of the table
                foreach($Detail as $NodeDetail) 
                {
                        // format data to get number value only
                        $aDataTableDetailHTML[] = (int) filter_var(trim($NodeDetail->textContent), FILTER_SANITIZE_NUMBER_INT);
                }
                $returnCombine = array_combine($aDataTableHeaderHTML, $aDataTableDetailHTML);

                return $returnCombine;
        }
}