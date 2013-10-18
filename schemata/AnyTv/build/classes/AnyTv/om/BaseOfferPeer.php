<?php

namespace AnyTv\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use AnyTv\CategoryPeer;
use AnyTv\Offer;
use AnyTv\OfferPeer;
use AnyTv\TagCloudPeer;
use AnyTv\map\OfferTableMap;

/**
 * Base static class for performing query and update operations on the 'anytv_offer' table.
 *
 *
 *
 * @package propel.generator.AnyTv.om
 */
abstract class BaseOfferPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'anytv_offers';

    /** the table name for this class */
    const TABLE_NAME = 'anytv_offer';

    /** the related Propel class for this table */
    const OM_CLASS = 'AnyTv\\Offer';

    /** the related TableMap class for this table */
    const TM_CLASS = 'OfferTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 19;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 19;

    /** the column name for the id field */
    const ID = 'anytv_offer.id';

    /** the column name for the name field */
    const NAME = 'anytv_offer.name';

    /** the column name for the description field */
    const DESCRIPTION = 'anytv_offer.description';

    /** the column name for the slug field */
    const SLUG = 'anytv_offer.slug';

    /** the column name for the default_link field */
    const DEFAULT_LINK = 'anytv_offer.default_link';

    /** the column name for the cat_id field */
    const CAT_ID = 'anytv_offer.cat_id';

    /** the column name for the payout_type field */
    const PAYOUT_TYPE = 'anytv_offer.payout_type';

    /** the column name for the revenue_type field */
    const REVENUE_TYPE = 'anytv_offer.revenue_type';

    /** the column name for the default_payout field */
    const DEFAULT_PAYOUT = 'anytv_offer.default_payout';

    /** the column name for the max_payout field */
    const MAX_PAYOUT = 'anytv_offer.max_payout';

    /** the column name for the percent_payout field */
    const PERCENT_PAYOUT = 'anytv_offer.percent_payout';

    /** the column name for the max_percent_payout field */
    const MAX_PERCENT_PAYOUT = 'anytv_offer.max_percent_payout';

    /** the column name for the tiered_payout field */
    const TIERED_PAYOUT = 'anytv_offer.tiered_payout';

    /** the column name for the advertiser_id field */
    const ADVERTISER_ID = 'anytv_offer.advertiser_id';

    /** the column name for the protocol field */
    const PROTOCOL = 'anytv_offer.protocol';

    /** the column name for the status field */
    const STATUS = 'anytv_offer.status';

    /** the column name for the expiration_date field */
    const EXPIRATION_DATE = 'anytv_offer.expiration_date';

    /** the column name for the currency field */
    const CURRENCY = 'anytv_offer.currency';

    /** the column name for the offer_url field */
    const OFFER_URL = 'anytv_offer.offer_url';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Offer objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Offer[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. OfferPeer::$fieldNames[OfferPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'Slug', 'DefaultLink', 'CatId', 'PayoutType', 'RevenueType', 'DefaultPayout', 'MaxPayout', 'PercentPayout', 'MaxPercentPayout', 'TieredPayout', 'AdvertiserId', 'Protocol', 'Status', 'ExpirationDate', 'Currency', 'OfferUrl', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'description', 'slug', 'defaultLink', 'catId', 'payoutType', 'revenueType', 'defaultPayout', 'maxPayout', 'percentPayout', 'maxPercentPayout', 'tieredPayout', 'advertiserId', 'protocol', 'status', 'expirationDate', 'currency', 'offerUrl', ),
        BasePeer::TYPE_COLNAME => array (OfferPeer::ID, OfferPeer::NAME, OfferPeer::DESCRIPTION, OfferPeer::SLUG, OfferPeer::DEFAULT_LINK, OfferPeer::CAT_ID, OfferPeer::PAYOUT_TYPE, OfferPeer::REVENUE_TYPE, OfferPeer::DEFAULT_PAYOUT, OfferPeer::MAX_PAYOUT, OfferPeer::PERCENT_PAYOUT, OfferPeer::MAX_PERCENT_PAYOUT, OfferPeer::TIERED_PAYOUT, OfferPeer::ADVERTISER_ID, OfferPeer::PROTOCOL, OfferPeer::STATUS, OfferPeer::EXPIRATION_DATE, OfferPeer::CURRENCY, OfferPeer::OFFER_URL, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'NAME', 'DESCRIPTION', 'SLUG', 'DEFAULT_LINK', 'CAT_ID', 'PAYOUT_TYPE', 'REVENUE_TYPE', 'DEFAULT_PAYOUT', 'MAX_PAYOUT', 'PERCENT_PAYOUT', 'MAX_PERCENT_PAYOUT', 'TIERED_PAYOUT', 'ADVERTISER_ID', 'PROTOCOL', 'STATUS', 'EXPIRATION_DATE', 'CURRENCY', 'OFFER_URL', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'slug', 'default_link', 'cat_id', 'payout_type', 'revenue_type', 'default_payout', 'max_payout', 'percent_payout', 'max_percent_payout', 'tiered_payout', 'advertiser_id', 'protocol', 'status', 'expiration_date', 'currency', 'offer_url', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. OfferPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'Slug' => 3, 'DefaultLink' => 4, 'CatId' => 5, 'PayoutType' => 6, 'RevenueType' => 7, 'DefaultPayout' => 8, 'MaxPayout' => 9, 'PercentPayout' => 10, 'MaxPercentPayout' => 11, 'TieredPayout' => 12, 'AdvertiserId' => 13, 'Protocol' => 14, 'Status' => 15, 'ExpirationDate' => 16, 'Currency' => 17, 'OfferUrl' => 18, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'slug' => 3, 'defaultLink' => 4, 'catId' => 5, 'payoutType' => 6, 'revenueType' => 7, 'defaultPayout' => 8, 'maxPayout' => 9, 'percentPayout' => 10, 'maxPercentPayout' => 11, 'tieredPayout' => 12, 'advertiserId' => 13, 'protocol' => 14, 'status' => 15, 'expirationDate' => 16, 'currency' => 17, 'offerUrl' => 18, ),
        BasePeer::TYPE_COLNAME => array (OfferPeer::ID => 0, OfferPeer::NAME => 1, OfferPeer::DESCRIPTION => 2, OfferPeer::SLUG => 3, OfferPeer::DEFAULT_LINK => 4, OfferPeer::CAT_ID => 5, OfferPeer::PAYOUT_TYPE => 6, OfferPeer::REVENUE_TYPE => 7, OfferPeer::DEFAULT_PAYOUT => 8, OfferPeer::MAX_PAYOUT => 9, OfferPeer::PERCENT_PAYOUT => 10, OfferPeer::MAX_PERCENT_PAYOUT => 11, OfferPeer::TIERED_PAYOUT => 12, OfferPeer::ADVERTISER_ID => 13, OfferPeer::PROTOCOL => 14, OfferPeer::STATUS => 15, OfferPeer::EXPIRATION_DATE => 16, OfferPeer::CURRENCY => 17, OfferPeer::OFFER_URL => 18, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'NAME' => 1, 'DESCRIPTION' => 2, 'SLUG' => 3, 'DEFAULT_LINK' => 4, 'CAT_ID' => 5, 'PAYOUT_TYPE' => 6, 'REVENUE_TYPE' => 7, 'DEFAULT_PAYOUT' => 8, 'MAX_PAYOUT' => 9, 'PERCENT_PAYOUT' => 10, 'MAX_PERCENT_PAYOUT' => 11, 'TIERED_PAYOUT' => 12, 'ADVERTISER_ID' => 13, 'PROTOCOL' => 14, 'STATUS' => 15, 'EXPIRATION_DATE' => 16, 'CURRENCY' => 17, 'OFFER_URL' => 18, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'slug' => 3, 'default_link' => 4, 'cat_id' => 5, 'payout_type' => 6, 'revenue_type' => 7, 'default_payout' => 8, 'max_payout' => 9, 'percent_payout' => 10, 'max_percent_payout' => 11, 'tiered_payout' => 12, 'advertiser_id' => 13, 'protocol' => 14, 'status' => 15, 'expiration_date' => 16, 'currency' => 17, 'offer_url' => 18, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = OfferPeer::getFieldNames($toType);
        $key = isset(OfferPeer::$fieldKeys[$fromType][$name]) ? OfferPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(OfferPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, OfferPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return OfferPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. OfferPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(OfferPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(OfferPeer::ID);
            $criteria->addSelectColumn(OfferPeer::NAME);
            $criteria->addSelectColumn(OfferPeer::DESCRIPTION);
            $criteria->addSelectColumn(OfferPeer::SLUG);
            $criteria->addSelectColumn(OfferPeer::DEFAULT_LINK);
            $criteria->addSelectColumn(OfferPeer::CAT_ID);
            $criteria->addSelectColumn(OfferPeer::PAYOUT_TYPE);
            $criteria->addSelectColumn(OfferPeer::REVENUE_TYPE);
            $criteria->addSelectColumn(OfferPeer::DEFAULT_PAYOUT);
            $criteria->addSelectColumn(OfferPeer::MAX_PAYOUT);
            $criteria->addSelectColumn(OfferPeer::PERCENT_PAYOUT);
            $criteria->addSelectColumn(OfferPeer::MAX_PERCENT_PAYOUT);
            $criteria->addSelectColumn(OfferPeer::TIERED_PAYOUT);
            $criteria->addSelectColumn(OfferPeer::ADVERTISER_ID);
            $criteria->addSelectColumn(OfferPeer::PROTOCOL);
            $criteria->addSelectColumn(OfferPeer::STATUS);
            $criteria->addSelectColumn(OfferPeer::EXPIRATION_DATE);
            $criteria->addSelectColumn(OfferPeer::CURRENCY);
            $criteria->addSelectColumn(OfferPeer::OFFER_URL);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.default_link');
            $criteria->addSelectColumn($alias . '.cat_id');
            $criteria->addSelectColumn($alias . '.payout_type');
            $criteria->addSelectColumn($alias . '.revenue_type');
            $criteria->addSelectColumn($alias . '.default_payout');
            $criteria->addSelectColumn($alias . '.max_payout');
            $criteria->addSelectColumn($alias . '.percent_payout');
            $criteria->addSelectColumn($alias . '.max_percent_payout');
            $criteria->addSelectColumn($alias . '.tiered_payout');
            $criteria->addSelectColumn($alias . '.advertiser_id');
            $criteria->addSelectColumn($alias . '.protocol');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.expiration_date');
            $criteria->addSelectColumn($alias . '.currency');
            $criteria->addSelectColumn($alias . '.offer_url');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(OfferPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            OfferPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(OfferPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Offer
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = OfferPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return OfferPeer::populateObjects(OfferPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            OfferPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(OfferPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      Offer $obj A Offer object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            OfferPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Offer object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Offer) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Offer object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(OfferPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Offer Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(OfferPeer::$instances[$key])) {
                return OfferPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (OfferPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        OfferPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to anytv_offer
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in TagCloudPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        TagCloudPeer::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (string) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = OfferPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = OfferPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = OfferPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OfferPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Offer object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = OfferPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = OfferPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + OfferPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OfferPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            OfferPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Category table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(OfferPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            OfferPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(OfferPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(OfferPeer::CAT_ID, CategoryPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of Offer objects pre-filled with their Category objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Offer objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(OfferPeer::DATABASE_NAME);
        }

        OfferPeer::addSelectColumns($criteria);
        $startcol = OfferPeer::NUM_HYDRATE_COLUMNS;
        CategoryPeer::addSelectColumns($criteria);

        $criteria->addJoin(OfferPeer::CAT_ID, CategoryPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = OfferPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = OfferPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = OfferPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                OfferPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = CategoryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = CategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    CategoryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Offer) to $obj2 (Category)
                $obj2->addOffer($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(OfferPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            OfferPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(OfferPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(OfferPeer::CAT_ID, CategoryPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of Offer objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Offer objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(OfferPeer::DATABASE_NAME);
        }

        OfferPeer::addSelectColumns($criteria);
        $startcol2 = OfferPeer::NUM_HYDRATE_COLUMNS;

        CategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + CategoryPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(OfferPeer::CAT_ID, CategoryPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = OfferPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = OfferPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = OfferPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                OfferPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Category rows

            $key2 = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = CategoryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = CategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    CategoryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Offer) to the collection in $obj2 (Category)
                $obj2->addOffer($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(OfferPeer::DATABASE_NAME)->getTable(OfferPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseOfferPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseOfferPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new OfferTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return OfferPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Offer or Criteria object.
     *
     * @param      mixed $values Criteria or Offer object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Offer object
        }

        if ($criteria->containsKey(OfferPeer::ID) && $criteria->keyContainsValue(OfferPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OfferPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(OfferPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Offer or Criteria object.
     *
     * @param      mixed $values Criteria or Offer object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(OfferPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(OfferPeer::ID);
            $value = $criteria->remove(OfferPeer::ID);
            if ($value) {
                $selectCriteria->add(OfferPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(OfferPeer::TABLE_NAME);
            }

        } else { // $values is Offer object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(OfferPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the anytv_offer table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += OfferPeer::doOnDeleteCascade(new Criteria(OfferPeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(OfferPeer::TABLE_NAME, $con, OfferPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OfferPeer::clearInstancePool();
            OfferPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Offer or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Offer object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Offer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OfferPeer::DATABASE_NAME);
            $criteria->add(OfferPeer::ID, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(OfferPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += OfferPeer::doOnDeleteCascade($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                OfferPeer::clearInstancePool();
            } elseif ($values instanceof Offer) { // it's a model object
                OfferPeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    OfferPeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            OfferPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
     * feature (like MySQL or SQLite).
     *
     * This method is not very speedy because it must perform a query first to get
     * the implicated records and then perform the deletes by calling those Peer classes.
     *
     * This method should be used within a transaction if possible.
     *
     * @param      Criteria $criteria
     * @param      PropelPDO $con
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
    {
        // initialize var to track total num of affected rows
        $affectedRows = 0;

        // first find the objects that are implicated by the $criteria
        $objects = OfferPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related TagCloud objects
            $criteria = new Criteria(TagCloudPeer::DATABASE_NAME);

            $criteria->add(TagCloudPeer::OFFER_ID, $obj->getId());
            $affectedRows += TagCloudPeer::doDelete($criteria, $con);
        }

        return $affectedRows;
    }

    /**
     * Validates all modified columns of given Offer object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Offer $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(OfferPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(OfferPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(OfferPeer::DATABASE_NAME, OfferPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      string $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Offer
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = OfferPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(OfferPeer::DATABASE_NAME);
        $criteria->add(OfferPeer::ID, $pk);

        $v = OfferPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Offer[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(OfferPeer::DATABASE_NAME);
            $criteria->add(OfferPeer::ID, $pks, Criteria::IN);
            $objs = OfferPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseOfferPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseOfferPeer::buildTableMap();

