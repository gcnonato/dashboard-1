<?php

namespace AnyTv\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use AnyTv\Category;
use AnyTv\CategoryQuery;
use AnyTv\Offer;
use AnyTv\OfferPeer;
use AnyTv\OfferQuery;
use AnyTv\TagCloud;
use AnyTv\TagCloudQuery;

/**
 * Base class that represents a row from the 'anytv_offer' table.
 *
 *
 *
 * @package    propel.generator.AnyTv.om
 */
abstract class BaseOffer extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AnyTv\\OfferPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        OfferPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        string
     */
    protected $id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the default_link field.
     * @var        string
     */
    protected $default_link;

    /**
     * The value for the cat_id field.
     * @var        string
     */
    protected $cat_id;

    /**
     * The value for the payout_type field.
     * @var        string
     */
    protected $payout_type;

    /**
     * The value for the revenue_type field.
     * @var        string
     */
    protected $revenue_type;

    /**
     * The value for the default_payout field.
     * @var        double
     */
    protected $default_payout;

    /**
     * The value for the max_payout field.
     * @var        double
     */
    protected $max_payout;

    /**
     * The value for the percent_payout field.
     * @var        double
     */
    protected $percent_payout;

    /**
     * The value for the max_percent_payout field.
     * @var        double
     */
    protected $max_percent_payout;

    /**
     * The value for the tiered_payout field.
     * @var        int
     */
    protected $tiered_payout;

    /**
     * The value for the advertiser_id field.
     * @var        string
     */
    protected $advertiser_id;

    /**
     * The value for the protocol field.
     * @var        string
     */
    protected $protocol;

    /**
     * The value for the status field.
     * @var        string
     */
    protected $status;

    /**
     * The value for the expiration_date field.
     * @var        string
     */
    protected $expiration_date;

    /**
     * The value for the currency field.
     * @var        string
     */
    protected $currency;

    /**
     * The value for the offer_url field.
     * @var        string
     */
    protected $offer_url;

    /**
     * @var        Category
     */
    protected $aCategory;

    /**
     * @var        PropelObjectCollection|TagCloud[] Collection to store aggregation of TagCloud objects.
     */
    protected $collTagClouds;
    protected $collTagCloudsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tagCloudsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the [default_link] column value.
     *
     * @return string
     */
    public function getDefaultLink()
    {
        return $this->default_link;
    }

    /**
     * Get the [cat_id] column value.
     *
     * @return string
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * Get the [payout_type] column value.
     *
     * @return string
     */
    public function getPayoutType()
    {
        return $this->payout_type;
    }

    /**
     * Get the [revenue_type] column value.
     *
     * @return string
     */
    public function getRevenueType()
    {
        return $this->revenue_type;
    }

    /**
     * Get the [default_payout] column value.
     *
     * @return double
     */
    public function getDefaultPayout()
    {
        return $this->default_payout;
    }

    /**
     * Get the [max_payout] column value.
     *
     * @return double
     */
    public function getMaxPayout()
    {
        return $this->max_payout;
    }

    /**
     * Get the [percent_payout] column value.
     *
     * @return double
     */
    public function getPercentPayout()
    {
        return $this->percent_payout;
    }

    /**
     * Get the [max_percent_payout] column value.
     *
     * @return double
     */
    public function getMaxPercentPayout()
    {
        return $this->max_percent_payout;
    }

    /**
     * Get the [tiered_payout] column value.
     *
     * @return int
     */
    public function getTieredPayout()
    {
        return $this->tiered_payout;
    }

    /**
     * Get the [advertiser_id] column value.
     *
     * @return string
     */
    public function getAdvertiserId()
    {
        return $this->advertiser_id;
    }

    /**
     * Get the [protocol] column value.
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [optionally formatted] temporal [expiration_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getExpirationDate($format = 'Y-m-d H:i:s')
    {
        if ($this->expiration_date === null) {
            return null;
        }

        if ($this->expiration_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->expiration_date);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->expiration_date, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [currency] column value.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Get the [offer_url] column value.
     *
     * @return string
     */
    public function getOfferUrl()
    {
        return $this->offer_url;
    }

    /**
     * Set the value of [id] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = OfferPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = OfferPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = OfferPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[] = OfferPeer::SLUG;
        }


        return $this;
    } // setSlug()

    /**
     * Set the value of [default_link] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setDefaultLink($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->default_link !== $v) {
            $this->default_link = $v;
            $this->modifiedColumns[] = OfferPeer::DEFAULT_LINK;
        }


        return $this;
    } // setDefaultLink()

    /**
     * Set the value of [cat_id] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setCatId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->cat_id !== $v) {
            $this->cat_id = $v;
            $this->modifiedColumns[] = OfferPeer::CAT_ID;
        }

        if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
            $this->aCategory = null;
        }


        return $this;
    } // setCatId()

    /**
     * Set the value of [payout_type] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setPayoutType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->payout_type !== $v) {
            $this->payout_type = $v;
            $this->modifiedColumns[] = OfferPeer::PAYOUT_TYPE;
        }


        return $this;
    } // setPayoutType()

    /**
     * Set the value of [revenue_type] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setRevenueType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->revenue_type !== $v) {
            $this->revenue_type = $v;
            $this->modifiedColumns[] = OfferPeer::REVENUE_TYPE;
        }


        return $this;
    } // setRevenueType()

    /**
     * Set the value of [default_payout] column.
     *
     * @param double $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setDefaultPayout($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->default_payout !== $v) {
            $this->default_payout = $v;
            $this->modifiedColumns[] = OfferPeer::DEFAULT_PAYOUT;
        }


        return $this;
    } // setDefaultPayout()

    /**
     * Set the value of [max_payout] column.
     *
     * @param double $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setMaxPayout($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->max_payout !== $v) {
            $this->max_payout = $v;
            $this->modifiedColumns[] = OfferPeer::MAX_PAYOUT;
        }


        return $this;
    } // setMaxPayout()

    /**
     * Set the value of [percent_payout] column.
     *
     * @param double $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setPercentPayout($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->percent_payout !== $v) {
            $this->percent_payout = $v;
            $this->modifiedColumns[] = OfferPeer::PERCENT_PAYOUT;
        }


        return $this;
    } // setPercentPayout()

    /**
     * Set the value of [max_percent_payout] column.
     *
     * @param double $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setMaxPercentPayout($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->max_percent_payout !== $v) {
            $this->max_percent_payout = $v;
            $this->modifiedColumns[] = OfferPeer::MAX_PERCENT_PAYOUT;
        }


        return $this;
    } // setMaxPercentPayout()

    /**
     * Set the value of [tiered_payout] column.
     *
     * @param int $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setTieredPayout($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->tiered_payout !== $v) {
            $this->tiered_payout = $v;
            $this->modifiedColumns[] = OfferPeer::TIERED_PAYOUT;
        }


        return $this;
    } // setTieredPayout()

    /**
     * Set the value of [advertiser_id] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setAdvertiserId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->advertiser_id !== $v) {
            $this->advertiser_id = $v;
            $this->modifiedColumns[] = OfferPeer::ADVERTISER_ID;
        }


        return $this;
    } // setAdvertiserId()

    /**
     * Set the value of [protocol] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setProtocol($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->protocol !== $v) {
            $this->protocol = $v;
            $this->modifiedColumns[] = OfferPeer::PROTOCOL;
        }


        return $this;
    } // setProtocol()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = OfferPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Sets the value of [expiration_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Offer The current object (for fluent API support)
     */
    public function setExpirationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->expiration_date !== null || $dt !== null) {
            $currentDateAsString = ($this->expiration_date !== null && $tmpDt = new DateTime($this->expiration_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->expiration_date = $newDateAsString;
                $this->modifiedColumns[] = OfferPeer::EXPIRATION_DATE;
            }
        } // if either are not null


        return $this;
    } // setExpirationDate()

    /**
     * Set the value of [currency] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setCurrency($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->currency !== $v) {
            $this->currency = $v;
            $this->modifiedColumns[] = OfferPeer::CURRENCY;
        }


        return $this;
    } // setCurrency()

    /**
     * Set the value of [offer_url] column.
     *
     * @param string $v new value
     * @return Offer The current object (for fluent API support)
     */
    public function setOfferUrl($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->offer_url !== $v) {
            $this->offer_url = $v;
            $this->modifiedColumns[] = OfferPeer::OFFER_URL;
        }


        return $this;
    } // setOfferUrl()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->slug = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->default_link = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->cat_id = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->payout_type = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->revenue_type = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->default_payout = ($row[$startcol + 8] !== null) ? (double) $row[$startcol + 8] : null;
            $this->max_payout = ($row[$startcol + 9] !== null) ? (double) $row[$startcol + 9] : null;
            $this->percent_payout = ($row[$startcol + 10] !== null) ? (double) $row[$startcol + 10] : null;
            $this->max_percent_payout = ($row[$startcol + 11] !== null) ? (double) $row[$startcol + 11] : null;
            $this->tiered_payout = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->advertiser_id = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->protocol = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->status = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->expiration_date = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->currency = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->offer_url = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 19; // 19 = OfferPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Offer object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aCategory !== null && $this->cat_id !== $this->aCategory->getId()) {
            $this->aCategory = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = OfferPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategory = null;
            $this->collTagClouds = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = OfferQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                OfferPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategory !== null) {
                if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
                    $affectedRows += $this->aCategory->save($con);
                }
                $this->setCategory($this->aCategory);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->tagCloudsScheduledForDeletion !== null) {
                if (!$this->tagCloudsScheduledForDeletion->isEmpty()) {
                    TagCloudQuery::create()
                        ->filterByPrimaryKeys($this->tagCloudsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tagCloudsScheduledForDeletion = null;
                }
            }

            if ($this->collTagClouds !== null) {
                foreach ($this->collTagClouds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = OfferPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OfferPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OfferPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(OfferPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(OfferPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(OfferPeer::SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(OfferPeer::DEFAULT_LINK)) {
            $modifiedColumns[':p' . $index++]  = '`default_link`';
        }
        if ($this->isColumnModified(OfferPeer::CAT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`cat_id`';
        }
        if ($this->isColumnModified(OfferPeer::PAYOUT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`payout_type`';
        }
        if ($this->isColumnModified(OfferPeer::REVENUE_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`revenue_type`';
        }
        if ($this->isColumnModified(OfferPeer::DEFAULT_PAYOUT)) {
            $modifiedColumns[':p' . $index++]  = '`default_payout`';
        }
        if ($this->isColumnModified(OfferPeer::MAX_PAYOUT)) {
            $modifiedColumns[':p' . $index++]  = '`max_payout`';
        }
        if ($this->isColumnModified(OfferPeer::PERCENT_PAYOUT)) {
            $modifiedColumns[':p' . $index++]  = '`percent_payout`';
        }
        if ($this->isColumnModified(OfferPeer::MAX_PERCENT_PAYOUT)) {
            $modifiedColumns[':p' . $index++]  = '`max_percent_payout`';
        }
        if ($this->isColumnModified(OfferPeer::TIERED_PAYOUT)) {
            $modifiedColumns[':p' . $index++]  = '`tiered_payout`';
        }
        if ($this->isColumnModified(OfferPeer::ADVERTISER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`advertiser_id`';
        }
        if ($this->isColumnModified(OfferPeer::PROTOCOL)) {
            $modifiedColumns[':p' . $index++]  = '`protocol`';
        }
        if ($this->isColumnModified(OfferPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(OfferPeer::EXPIRATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`expiration_date`';
        }
        if ($this->isColumnModified(OfferPeer::CURRENCY)) {
            $modifiedColumns[':p' . $index++]  = '`currency`';
        }
        if ($this->isColumnModified(OfferPeer::OFFER_URL)) {
            $modifiedColumns[':p' . $index++]  = '`offer_url`';
        }

        $sql = sprintf(
            'INSERT INTO `anytv_offer` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_STR);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`default_link`':
                        $stmt->bindValue($identifier, $this->default_link, PDO::PARAM_STR);
                        break;
                    case '`cat_id`':
                        $stmt->bindValue($identifier, $this->cat_id, PDO::PARAM_STR);
                        break;
                    case '`payout_type`':
                        $stmt->bindValue($identifier, $this->payout_type, PDO::PARAM_STR);
                        break;
                    case '`revenue_type`':
                        $stmt->bindValue($identifier, $this->revenue_type, PDO::PARAM_STR);
                        break;
                    case '`default_payout`':
                        $stmt->bindValue($identifier, $this->default_payout, PDO::PARAM_STR);
                        break;
                    case '`max_payout`':
                        $stmt->bindValue($identifier, $this->max_payout, PDO::PARAM_STR);
                        break;
                    case '`percent_payout`':
                        $stmt->bindValue($identifier, $this->percent_payout, PDO::PARAM_STR);
                        break;
                    case '`max_percent_payout`':
                        $stmt->bindValue($identifier, $this->max_percent_payout, PDO::PARAM_STR);
                        break;
                    case '`tiered_payout`':
                        $stmt->bindValue($identifier, $this->tiered_payout, PDO::PARAM_INT);
                        break;
                    case '`advertiser_id`':
                        $stmt->bindValue($identifier, $this->advertiser_id, PDO::PARAM_STR);
                        break;
                    case '`protocol`':
                        $stmt->bindValue($identifier, $this->protocol, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case '`expiration_date`':
                        $stmt->bindValue($identifier, $this->expiration_date, PDO::PARAM_STR);
                        break;
                    case '`currency`':
                        $stmt->bindValue($identifier, $this->currency, PDO::PARAM_STR);
                        break;
                    case '`offer_url`':
                        $stmt->bindValue($identifier, $this->offer_url, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategory !== null) {
                if (!$this->aCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
                }
            }


            if (($retval = OfferPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTagClouds !== null) {
                    foreach ($this->collTagClouds as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = OfferPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getDescription();
                break;
            case 3:
                return $this->getSlug();
                break;
            case 4:
                return $this->getDefaultLink();
                break;
            case 5:
                return $this->getCatId();
                break;
            case 6:
                return $this->getPayoutType();
                break;
            case 7:
                return $this->getRevenueType();
                break;
            case 8:
                return $this->getDefaultPayout();
                break;
            case 9:
                return $this->getMaxPayout();
                break;
            case 10:
                return $this->getPercentPayout();
                break;
            case 11:
                return $this->getMaxPercentPayout();
                break;
            case 12:
                return $this->getTieredPayout();
                break;
            case 13:
                return $this->getAdvertiserId();
                break;
            case 14:
                return $this->getProtocol();
                break;
            case 15:
                return $this->getStatus();
                break;
            case 16:
                return $this->getExpirationDate();
                break;
            case 17:
                return $this->getCurrency();
                break;
            case 18:
                return $this->getOfferUrl();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Offer'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Offer'][$this->getPrimaryKey()] = true;
        $keys = OfferPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getSlug(),
            $keys[4] => $this->getDefaultLink(),
            $keys[5] => $this->getCatId(),
            $keys[6] => $this->getPayoutType(),
            $keys[7] => $this->getRevenueType(),
            $keys[8] => $this->getDefaultPayout(),
            $keys[9] => $this->getMaxPayout(),
            $keys[10] => $this->getPercentPayout(),
            $keys[11] => $this->getMaxPercentPayout(),
            $keys[12] => $this->getTieredPayout(),
            $keys[13] => $this->getAdvertiserId(),
            $keys[14] => $this->getProtocol(),
            $keys[15] => $this->getStatus(),
            $keys[16] => $this->getExpirationDate(),
            $keys[17] => $this->getCurrency(),
            $keys[18] => $this->getOfferUrl(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCategory) {
                $result['Category'] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collTagClouds) {
                $result['TagClouds'] = $this->collTagClouds->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = OfferPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setDescription($value);
                break;
            case 3:
                $this->setSlug($value);
                break;
            case 4:
                $this->setDefaultLink($value);
                break;
            case 5:
                $this->setCatId($value);
                break;
            case 6:
                $this->setPayoutType($value);
                break;
            case 7:
                $this->setRevenueType($value);
                break;
            case 8:
                $this->setDefaultPayout($value);
                break;
            case 9:
                $this->setMaxPayout($value);
                break;
            case 10:
                $this->setPercentPayout($value);
                break;
            case 11:
                $this->setMaxPercentPayout($value);
                break;
            case 12:
                $this->setTieredPayout($value);
                break;
            case 13:
                $this->setAdvertiserId($value);
                break;
            case 14:
                $this->setProtocol($value);
                break;
            case 15:
                $this->setStatus($value);
                break;
            case 16:
                $this->setExpirationDate($value);
                break;
            case 17:
                $this->setCurrency($value);
                break;
            case 18:
                $this->setOfferUrl($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = OfferPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setSlug($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDefaultLink($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCatId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setPayoutType($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setRevenueType($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setDefaultPayout($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMaxPayout($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setPercentPayout($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setMaxPercentPayout($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setTieredPayout($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setAdvertiserId($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setProtocol($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setStatus($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setExpirationDate($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setCurrency($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setOfferUrl($arr[$keys[18]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(OfferPeer::DATABASE_NAME);

        if ($this->isColumnModified(OfferPeer::ID)) $criteria->add(OfferPeer::ID, $this->id);
        if ($this->isColumnModified(OfferPeer::NAME)) $criteria->add(OfferPeer::NAME, $this->name);
        if ($this->isColumnModified(OfferPeer::DESCRIPTION)) $criteria->add(OfferPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(OfferPeer::SLUG)) $criteria->add(OfferPeer::SLUG, $this->slug);
        if ($this->isColumnModified(OfferPeer::DEFAULT_LINK)) $criteria->add(OfferPeer::DEFAULT_LINK, $this->default_link);
        if ($this->isColumnModified(OfferPeer::CAT_ID)) $criteria->add(OfferPeer::CAT_ID, $this->cat_id);
        if ($this->isColumnModified(OfferPeer::PAYOUT_TYPE)) $criteria->add(OfferPeer::PAYOUT_TYPE, $this->payout_type);
        if ($this->isColumnModified(OfferPeer::REVENUE_TYPE)) $criteria->add(OfferPeer::REVENUE_TYPE, $this->revenue_type);
        if ($this->isColumnModified(OfferPeer::DEFAULT_PAYOUT)) $criteria->add(OfferPeer::DEFAULT_PAYOUT, $this->default_payout);
        if ($this->isColumnModified(OfferPeer::MAX_PAYOUT)) $criteria->add(OfferPeer::MAX_PAYOUT, $this->max_payout);
        if ($this->isColumnModified(OfferPeer::PERCENT_PAYOUT)) $criteria->add(OfferPeer::PERCENT_PAYOUT, $this->percent_payout);
        if ($this->isColumnModified(OfferPeer::MAX_PERCENT_PAYOUT)) $criteria->add(OfferPeer::MAX_PERCENT_PAYOUT, $this->max_percent_payout);
        if ($this->isColumnModified(OfferPeer::TIERED_PAYOUT)) $criteria->add(OfferPeer::TIERED_PAYOUT, $this->tiered_payout);
        if ($this->isColumnModified(OfferPeer::ADVERTISER_ID)) $criteria->add(OfferPeer::ADVERTISER_ID, $this->advertiser_id);
        if ($this->isColumnModified(OfferPeer::PROTOCOL)) $criteria->add(OfferPeer::PROTOCOL, $this->protocol);
        if ($this->isColumnModified(OfferPeer::STATUS)) $criteria->add(OfferPeer::STATUS, $this->status);
        if ($this->isColumnModified(OfferPeer::EXPIRATION_DATE)) $criteria->add(OfferPeer::EXPIRATION_DATE, $this->expiration_date);
        if ($this->isColumnModified(OfferPeer::CURRENCY)) $criteria->add(OfferPeer::CURRENCY, $this->currency);
        if ($this->isColumnModified(OfferPeer::OFFER_URL)) $criteria->add(OfferPeer::OFFER_URL, $this->offer_url);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(OfferPeer::DATABASE_NAME);
        $criteria->add(OfferPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Offer (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setDefaultLink($this->getDefaultLink());
        $copyObj->setCatId($this->getCatId());
        $copyObj->setPayoutType($this->getPayoutType());
        $copyObj->setRevenueType($this->getRevenueType());
        $copyObj->setDefaultPayout($this->getDefaultPayout());
        $copyObj->setMaxPayout($this->getMaxPayout());
        $copyObj->setPercentPayout($this->getPercentPayout());
        $copyObj->setMaxPercentPayout($this->getMaxPercentPayout());
        $copyObj->setTieredPayout($this->getTieredPayout());
        $copyObj->setAdvertiserId($this->getAdvertiserId());
        $copyObj->setProtocol($this->getProtocol());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setExpirationDate($this->getExpirationDate());
        $copyObj->setCurrency($this->getCurrency());
        $copyObj->setOfferUrl($this->getOfferUrl());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTagClouds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTagCloud($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Offer Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return OfferPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new OfferPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Category object.
     *
     * @param             Category $v
     * @return Offer The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategory(Category $v = null)
    {
        if ($v === null) {
            $this->setCatId(NULL);
        } else {
            $this->setCatId($v->getId());
        }

        $this->aCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Category object, it will not be re-added.
        if ($v !== null) {
            $v->addOffer($this);
        }


        return $this;
    }


    /**
     * Get the associated Category object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Category The associated Category object.
     * @throws PropelException
     */
    public function getCategory(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCategory === null && (($this->cat_id !== "" && $this->cat_id !== null)) && $doQuery) {
            $this->aCategory = CategoryQuery::create()->findPk($this->cat_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategory->addOffers($this);
             */
        }

        return $this->aCategory;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('TagCloud' == $relationName) {
            $this->initTagClouds();
        }
    }

    /**
     * Clears out the collTagClouds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Offer The current object (for fluent API support)
     * @see        addTagClouds()
     */
    public function clearTagClouds()
    {
        $this->collTagClouds = null; // important to set this to null since that means it is uninitialized
        $this->collTagCloudsPartial = null;

        return $this;
    }

    /**
     * reset is the collTagClouds collection loaded partially
     *
     * @return void
     */
    public function resetPartialTagClouds($v = true)
    {
        $this->collTagCloudsPartial = $v;
    }

    /**
     * Initializes the collTagClouds collection.
     *
     * By default this just sets the collTagClouds collection to an empty array (like clearcollTagClouds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTagClouds($overrideExisting = true)
    {
        if (null !== $this->collTagClouds && !$overrideExisting) {
            return;
        }
        $this->collTagClouds = new PropelObjectCollection();
        $this->collTagClouds->setModel('TagCloud');
    }

    /**
     * Gets an array of TagCloud objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Offer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TagCloud[] List of TagCloud objects
     * @throws PropelException
     */
    public function getTagClouds($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTagCloudsPartial && !$this->isNew();
        if (null === $this->collTagClouds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTagClouds) {
                // return empty collection
                $this->initTagClouds();
            } else {
                $collTagClouds = TagCloudQuery::create(null, $criteria)
                    ->filterByOffer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTagCloudsPartial && count($collTagClouds)) {
                      $this->initTagClouds(false);

                      foreach($collTagClouds as $obj) {
                        if (false == $this->collTagClouds->contains($obj)) {
                          $this->collTagClouds->append($obj);
                        }
                      }

                      $this->collTagCloudsPartial = true;
                    }

                    $collTagClouds->getInternalIterator()->rewind();
                    return $collTagClouds;
                }

                if($partial && $this->collTagClouds) {
                    foreach($this->collTagClouds as $obj) {
                        if($obj->isNew()) {
                            $collTagClouds[] = $obj;
                        }
                    }
                }

                $this->collTagClouds = $collTagClouds;
                $this->collTagCloudsPartial = false;
            }
        }

        return $this->collTagClouds;
    }

    /**
     * Sets a collection of TagCloud objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tagClouds A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Offer The current object (for fluent API support)
     */
    public function setTagClouds(PropelCollection $tagClouds, PropelPDO $con = null)
    {
        $tagCloudsToDelete = $this->getTagClouds(new Criteria(), $con)->diff($tagClouds);

        $this->tagCloudsScheduledForDeletion = unserialize(serialize($tagCloudsToDelete));

        foreach ($tagCloudsToDelete as $tagCloudRemoved) {
            $tagCloudRemoved->setOffer(null);
        }

        $this->collTagClouds = null;
        foreach ($tagClouds as $tagCloud) {
            $this->addTagCloud($tagCloud);
        }

        $this->collTagClouds = $tagClouds;
        $this->collTagCloudsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TagCloud objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TagCloud objects.
     * @throws PropelException
     */
    public function countTagClouds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTagCloudsPartial && !$this->isNew();
        if (null === $this->collTagClouds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTagClouds) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTagClouds());
            }
            $query = TagCloudQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOffer($this)
                ->count($con);
        }

        return count($this->collTagClouds);
    }

    /**
     * Method called to associate a TagCloud object to this object
     * through the TagCloud foreign key attribute.
     *
     * @param    TagCloud $l TagCloud
     * @return Offer The current object (for fluent API support)
     */
    public function addTagCloud(TagCloud $l)
    {
        if ($this->collTagClouds === null) {
            $this->initTagClouds();
            $this->collTagCloudsPartial = true;
        }
        if (!in_array($l, $this->collTagClouds->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTagCloud($l);
        }

        return $this;
    }

    /**
     * @param	TagCloud $tagCloud The tagCloud object to add.
     */
    protected function doAddTagCloud($tagCloud)
    {
        $this->collTagClouds[]= $tagCloud;
        $tagCloud->setOffer($this);
    }

    /**
     * @param	TagCloud $tagCloud The tagCloud object to remove.
     * @return Offer The current object (for fluent API support)
     */
    public function removeTagCloud($tagCloud)
    {
        if ($this->getTagClouds()->contains($tagCloud)) {
            $this->collTagClouds->remove($this->collTagClouds->search($tagCloud));
            if (null === $this->tagCloudsScheduledForDeletion) {
                $this->tagCloudsScheduledForDeletion = clone $this->collTagClouds;
                $this->tagCloudsScheduledForDeletion->clear();
            }
            $this->tagCloudsScheduledForDeletion[]= clone $tagCloud;
            $tagCloud->setOffer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Offer is new, it will return
     * an empty collection; or if this Offer has previously
     * been saved, it will retrieve related TagClouds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Offer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TagCloud[] List of TagCloud objects
     */
    public function getTagCloudsJoinTag($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TagCloudQuery::create(null, $criteria);
        $query->joinWith('Tag', $join_behavior);

        return $this->getTagClouds($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->description = null;
        $this->slug = null;
        $this->default_link = null;
        $this->cat_id = null;
        $this->payout_type = null;
        $this->revenue_type = null;
        $this->default_payout = null;
        $this->max_payout = null;
        $this->percent_payout = null;
        $this->max_percent_payout = null;
        $this->tiered_payout = null;
        $this->advertiser_id = null;
        $this->protocol = null;
        $this->status = null;
        $this->expiration_date = null;
        $this->currency = null;
        $this->offer_url = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collTagClouds) {
                foreach ($this->collTagClouds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aCategory instanceof Persistent) {
              $this->aCategory->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collTagClouds instanceof PropelCollection) {
            $this->collTagClouds->clearIterator();
        }
        $this->collTagClouds = null;
        $this->aCategory = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OfferPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
