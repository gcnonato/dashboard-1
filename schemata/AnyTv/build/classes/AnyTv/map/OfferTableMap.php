<?php

namespace AnyTv\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'anytv_offer' table.
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
class OfferTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AnyTv.map.OfferTableMap';

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
        $this->setName('anytv_offer');
        $this->setPhpName('Offer');
        $this->setClassname('AnyTv\\Offer');
        $this->setPackage('AnyTv');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'CLOB', false, null, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addColumn('default_link', 'DefaultLink', 'CLOB', false, null, null);
        $this->addForeignKey('cat_id', 'CatId', 'VARCHAR', 'anytv_category', 'id', false, null, null);
        $this->addColumn('payout_type', 'PayoutType', 'VARCHAR', false, 45, null);
        $this->addColumn('revenue_type', 'RevenueType', 'VARCHAR', false, 45, null);
        $this->addColumn('default_payout', 'DefaultPayout', 'FLOAT', false, null, null);
        $this->addColumn('max_payout', 'MaxPayout', 'FLOAT', false, null, null);
        $this->addColumn('percent_payout', 'PercentPayout', 'FLOAT', false, null, null);
        $this->addColumn('max_percent_payout', 'MaxPercentPayout', 'FLOAT', false, null, null);
        $this->addColumn('tiered_payout', 'TieredPayout', 'TINYINT', false, 1, null);
        $this->addColumn('advertiser_id', 'AdvertiserId', 'BIGINT', false, 19, null);
        $this->addColumn('protocol', 'Protocol', 'VARCHAR', false, 45, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 20, null);
        $this->addColumn('expiration_date', 'ExpirationDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('currency', 'Currency', 'VARCHAR', false, 3, null);
        $this->addColumn('offer_url', 'OfferUrl', 'LONGVARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Category', 'AnyTv\\Category', RelationMap::MANY_TO_ONE, array('cat_id' => 'id', ), 'RESTRICT', 'CASCADE');
        $this->addRelation('TagCloud', 'AnyTv\\TagCloud', RelationMap::ONE_TO_MANY, array('id' => 'offer_id', ), 'CASCADE', 'CASCADE', 'TagClouds');
    } // buildRelations()

} // OfferTableMap
