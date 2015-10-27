<?php

namespace Jcowie\FeatureToggle\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface as DB;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $tableName = 'jcowie_featuretoggle';

        $table = $setup->getConnection()->newTable($tableName);

        $table->addColumn('featuretoggle_id', Table::TYPE_INTEGER, null, [
            'unsigned' => true,
            'identity' => true,
            'primary' => true,
        ])->addColumn('name', Table::TYPE_TEXT, 255, [
                'nullable' => false
        ])->addColumn('status', Table::TYPE_TEXT, 255, [
                'nullable' => false]
        );

        $setup->getConnection()->createTable($table);
    }
}
