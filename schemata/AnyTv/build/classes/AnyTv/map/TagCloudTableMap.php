<?php

namespace AnyTv\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'anytv_tagcloud' table.
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
class TagCloudTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AnyTv.map.TagCloudTableMap';

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
        $this->setName('anytv_tagcloud');
        $this->setPhpName('TagCloud');
        $this->setClassname('AnyTv\\TagCloud');
        $this->setPackage('AnyTv');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('offer_id', 'OfferId', 'VARCHAR' , 'anytv_offer', 'id', true, null, null);
        $this->addForeignPrimaryKey('tag_id', 'TagId', 'VARCHAR' , 'anytv_tag', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Offer', 'AnyTv\\Offer', RelationMap::MANY_TO_ONE, array('offer_id' => 'id', ), 'CASCADE', 'CASCADE');
        $this->addRelation('Tag', 'AnyTv\\Tag', RelationMap::MANY_TO_ONE, array('tag_id' => 'id', ), 'RESTRICT', 'CASCADE');
    } // buildRelations()

} // TagCloudTableMap
