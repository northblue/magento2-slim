<?php
namespace WebTop\MyDashboard\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('webtop_mydashboard_auction_summary')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('webtop_mydashboard_auction_summary')
			)
				->addColumn(
					'entity_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Entity ID'
				)
                ->addColumn(
                    'date',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                    null,
                    ['nullable' => false,],
                    'Date'
                )
				->addColumn(
					'area',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable' => false],
					'Area'
				)
				->addColumn(
					'clearance_rate',
					\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					255,
					[],
					'Clearance Rate'
				)
				->addColumn(
					'auctions_scheduled',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
					'Auctions Scheduled'
				)
                ->addColumn(
					'auctions_reported',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
					'Auctions Reported'
				)
                ->addColumn(
					'sold',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
					'Sold'
				)
                ->addColumn(
					'withdrawn',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
					'Withdrawn'
				)
                ->addColumn(
					'passed_in',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
					'Passed In'
				)
                ->addColumn(
					'total_sales',
					\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					21,
					[],
					'Total Sales'
				)
                ->addColumn(
					'median',
					\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					11,
					[],
					'Median'
				)
				->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
				)->addColumn(
					'updated_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
					'Updated At')
				->setComment('Updated At');
			$installer->getConnection()->createTable($table);

			// $installer->getConnection()->addIndex(
			// 	$installer->getTable('webtop_mydashboard_auction_summary'),
			// 	$setup->getIdxName(
			// 		$installer->getTable('webtop_mydashboard_auction_summary'),
			// 		['date','area'],
			// 		\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			// 	),
			// 	['date','area'],
			// 	\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			// );
		}
		$installer->endSetup();
	}
}
