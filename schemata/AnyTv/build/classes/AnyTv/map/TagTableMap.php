<?php

namespace AnyTv\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'anytv_tag' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.AnyTv.map
 */
class TagTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AnyTv.map.TagTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('anytv_tag');
        $this->setPhpName('Tag');
        $this->setClassname('AnyTv\\Tag');
        $this->setPackage('AnyTv');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TagCloud', 'AnyTv\\TagCloud', RelationMap::ONE_TO_MANY, array('id' => 'tag_id', ), 'RESTRICT', 'CASCADE', 'TagClouds');
    } // buildRelations()

} // TagTableMap
