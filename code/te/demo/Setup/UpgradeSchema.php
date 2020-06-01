<?php
namespace te\demo\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		if(version_compare($context->getVersion(), '2.0.3', '<')) {
			if (!$installer->tableExists('te_demo_productDetails')) {
				$table = $installer->getConnection()->newTable(
					$installer->getTable('te_demo_productDetails')
				)
					->addColumn(
						'product_id',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						[
							'identity' => true,
							'nullable' => false,
							'primary'  => true,
							'unsigned' => true,
						],
						'Product ID'
					)
					->addColumn(
						'product_price',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						1,
						[],
						'Price'
					)
					->addColumn(
						'product_description',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						25,
						[],
						'Product description'
					)
					->addColumn(
						'sizes',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						[],
						'Sizes'
					)
					->addColumn(
						'colours',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						[],
						'Colours'
					)
					->addColumn(
						'image_url',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						[],
						'Image url'
					)
					->setComment('Post Table');
				$installer->getConnection()->createTable($table);

				$installer->getConnection()->addIndex(
					$installer->getTable('te_demo_productDetails'),
					$setup->getIdxName(
						$installer->getTable('te_demo_productDetails'),
						['product_description','sizes','colours','image_url'],
						\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
					),
					['product_description','sizes','colours','image_url'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				);
			}
		}

		$installer->endSetup();
	}
}
