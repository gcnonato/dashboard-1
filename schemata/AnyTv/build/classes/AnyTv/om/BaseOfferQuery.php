<?php

namespace AnyTv\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use AnyTv\Category;
use AnyTv\Offer;
use AnyTv\OfferPeer;
use AnyTv\OfferQuery;
use AnyTv\TagCloud;

/**
 * Base class that represents a query for the 'anytv_offer' table.
 *
 *
 *
 * @method OfferQuery orderById($order = Criteria::ASC) Order by the id column
 * @method OfferQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method OfferQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method OfferQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method OfferQuery orderByDefaultLink($order = Criteria::ASC) Order by the default_link column
 * @method OfferQuery orderByCatId($order = Criteria::ASC) Order by the cat_id column
 * @method OfferQuery orderByPayoutType($order = Criteria::ASC) Order by the payout_type column
 * @method OfferQuery orderByRevenueType($order = Criteria::ASC) Order by the revenue_type column
 * @method OfferQuery orderByDefaultPayout($order = Criteria::ASC) Order by the default_payout column
 * @method OfferQuery orderByMaxPayout($order = Criteria::ASC) Order by the max_payout column
 * @method OfferQuery orderByPercentPayout($order = Criteria::ASC) Order by the percent_payout column
 * @method OfferQuery orderByMaxPercentPayout($order = Criteria::ASC) Order by the max_percent_payout column
 * @method OfferQuery orderByTieredPayout($order = Criteria::ASC) Order by the tiered_payout column
 * @method OfferQuery orderByAdvertiserId($order = Criteria::ASC) Order by the advertiser_id column
 * @method OfferQuery orderByProtocol($order = Criteria::ASC) Order by the protocol column
 * @method OfferQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method OfferQuery orderByExpirationDate($order = Criteria::ASC) Order by the expiration_date column
 * @method OfferQuery orderByCurrency($order = Criteria::ASC) Order by the currency column
 * @method OfferQuery orderByOfferUrl($order = Criteria::ASC) Order by the offer_url column
 *
 * @method OfferQuery groupById() Group by the id column
 * @method OfferQuery groupByName() Group by the name column
 * @method OfferQuery groupByDescription() Group by the description column
 * @method OfferQuery groupBySlug() Group by the slug column
 * @method OfferQuery groupByDefaultLink() Group by the default_link column
 * @method OfferQuery groupByCatId() Group by the cat_id column
 * @method OfferQuery groupByPayoutType() Group by the payout_type column
 * @method OfferQuery groupByRevenueType() Group by the revenue_type column
 * @method OfferQuery groupByDefaultPayout() Group by the default_payout column
 * @method OfferQuery groupByMaxPayout() Group by the max_payout column
 * @method OfferQuery groupByPercentPayout() Group by the percent_payout column
 * @method OfferQuery groupByMaxPercentPayout() Group by the max_percent_payout column
 * @method OfferQuery groupByTieredPayout() Group by the tiered_payout column
 * @method OfferQuery groupByAdvertiserId() Group by the advertiser_id column
 * @method OfferQuery groupByProtocol() Group by the protocol column
 * @method OfferQuery groupByStatus() Group by the status column
 * @method OfferQuery groupByExpirationDate() Group by the expiration_date column
 * @method OfferQuery groupByCurrency() Group by the currency column
 * @method OfferQuery groupByOfferUrl() Group by the offer_url column
 *
 * @method OfferQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method OfferQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method OfferQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method OfferQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method OfferQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method OfferQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method OfferQuery leftJoinTagCloud($relationAlias = null) Adds a LEFT JOIN clause to the query using the TagCloud relation
 * @method OfferQuery rightJoinTagCloud($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TagCloud relation
 * @method OfferQuery innerJoinTagCloud($relationAlias = null) Adds a INNER JOIN clause to the query using the TagCloud relation
 *
 * @method Offer findOne(PropelPDO $con = null) Return the first Offer matching the query
 * @method Offer findOneOrCreate(PropelPDO $con = null) Return the first Offer matching the query, or a new Offer object populated from the query conditions when no match is found
 *
 * @method Offer findOneByName(string $name) Return the first Offer filtered by the name column
 * @method Offer findOneByDescription(string $description) Return the first Offer filtered by the description column
 * @method Offer findOneBySlug(string $slug) Return the first Offer filtered by the slug column
 * @method Offer findOneByDefaultLink(string $default_link) Return the first Offer filtered by the default_link column
 * @method Offer findOneByCatId(string $cat_id) Return the first Offer filtered by the cat_id column
 * @method Offer findOneByPayoutType(string $payout_type) Return the first Offer filtered by the payout_type column
 * @method Offer findOneByRevenueType(string $revenue_type) Return the first Offer filtered by the revenue_type column
 * @method Offer findOneByDefaultPayout(double $default_payout) Return the first Offer filtered by the default_payout column
 * @method Offer findOneByMaxPayout(double $max_payout) Return the first Offer filtered by the max_payout column
 * @method Offer findOneByPercentPayout(double $percent_payout) Return the first Offer filtered by the percent_payout column
 * @method Offer findOneByMaxPercentPayout(double $max_percent_payout) Return the first Offer filtered by the max_percent_payout column
 * @method Offer findOneByTieredPayout(int $tiered_payout) Return the first Offer filtered by the tiered_payout column
 * @method Offer findOneByAdvertiserId(string $advertiser_id) Return the first Offer filtered by the advertiser_id column
 * @method Offer findOneByProtocol(string $protocol) Return the first Offer filtered by the protocol column
 * @method Offer findOneByStatus(string $status) Return the first Offer filtered by the status column
 * @method Offer findOneByExpirationDate(string $expiration_date) Return the first Offer filtered by the expiration_date column
 * @method Offer findOneByCurrency(string $currency) Return the first Offer filtered by the currency column
 * @method Offer findOneByOfferUrl(string $offer_url) Return the first Offer filtered by the offer_url column
 *
 * @method array findById(string $id) Return Offer objects filtered by the id column
 * @method array findByName(string $name) Return Offer objects filtered by the name column
 * @method array findByDescription(string $description) Return Offer objects filtered by the description column
 * @method array findBySlug(string $slug) Return Offer objects filtered by the slug column
 * @method array findByDefaultLink(string $default_link) Return Offer objects filtered by the default_link column
 * @method array findByCatId(string $cat_id) Return Offer objects filtered by the cat_id column
 * @method array findByPayoutType(string $payout_type) Return Offer objects filtered by the payout_type column
 * @method array findByRevenueType(string $revenue_type) Return Offer objects filtered by the revenue_type column
 * @method array findByDefaultPayout(double $default_payout) Return Offer objects filtered by the default_payout column
 * @method array findByMaxPayout(double $max_payout) Return Offer objects filtered by the max_payout column
 * @method array findByPercentPayout(double $percent_payout) Return Offer objects filtered by the percent_payout column
 * @method array findByMaxPercentPayout(double $max_percent_payout) Return Offer objects filtered by the max_percent_payout column
 * @method array findByTieredPayout(int $tiered_payout) Return Offer objects filtered by the tiered_payout column
 * @method array findByAdvertiserId(string $advertiser_id) Return Offer objects filtered by the advertiser_id column
 * @method array findByProtocol(string $protocol) Return Offer objects filtered by the protocol column
 * @method array findByStatus(string $status) Return Offer objects filtered by the status column
 * @method array findByExpirationDate(string $expiration_date) Return Offer objects filtered by the expiration_date column
 * @method array findByCurrency(string $currency) Return Offer objects filtered by the currency column
 * @method array findByOfferUrl(string $offer_url) Return Offer objects filtered by the offer_url column
 *
 * @package    propel.generator.AnyTv.om
 */
abstract class BaseOfferQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseOfferQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'anytv_offers', $modelName = 'AnyTv\\Offer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new OfferQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   OfferQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return OfferQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof OfferQuery) {
            return $criteria;
        }
        $query = new OfferQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Offer|Offer[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = OfferPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(OfferPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Offer A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Offer A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `description`, `slug`, `default_link`, `cat_id`, `payout_type`, `revenue_type`, `default_payout`, `max_payout`, `percent_payout`, `max_percent_payout`, `tiered_payout`, `advertiser_id`, `protocol`, `status`, `expiration_date`, `currency`, `offer_url` FROM `anytv_offer` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Offer();
            $obj->hydrate($row);
            OfferPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Offer|Offer[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Offer[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OfferPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OfferPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OfferPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OfferPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the default_link column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultLink('fooValue');   // WHERE default_link = 'fooValue'
     * $query->filterByDefaultLink('%fooValue%'); // WHERE default_link LIKE '%fooValue%'
     * </code>
     *
     * @param     string $defaultLink The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByDefaultLink($defaultLink = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($defaultLink)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $defaultLink)) {
                $defaultLink = str_replace('*', '%', $defaultLink);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::DEFAULT_LINK, $defaultLink, $comparison);
    }

    /**
     * Filter the query on the cat_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCatId('fooValue');   // WHERE cat_id = 'fooValue'
     * $query->filterByCatId('%fooValue%'); // WHERE cat_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $catId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByCatId($catId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($catId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $catId)) {
                $catId = str_replace('*', '%', $catId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::CAT_ID, $catId, $comparison);
    }

    /**
     * Filter the query on the payout_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPayoutType('fooValue');   // WHERE payout_type = 'fooValue'
     * $query->filterByPayoutType('%fooValue%'); // WHERE payout_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $payoutType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByPayoutType($payoutType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payoutType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $payoutType)) {
                $payoutType = str_replace('*', '%', $payoutType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::PAYOUT_TYPE, $payoutType, $comparison);
    }

    /**
     * Filter the query on the revenue_type column
     *
     * Example usage:
     * <code>
     * $query->filterByRevenueType('fooValue');   // WHERE revenue_type = 'fooValue'
     * $query->filterByRevenueType('%fooValue%'); // WHERE revenue_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $revenueType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByRevenueType($revenueType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($revenueType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $revenueType)) {
                $revenueType = str_replace('*', '%', $revenueType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::REVENUE_TYPE, $revenueType, $comparison);
    }

    /**
     * Filter the query on the default_payout column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultPayout(1234); // WHERE default_payout = 1234
     * $query->filterByDefaultPayout(array(12, 34)); // WHERE default_payout IN (12, 34)
     * $query->filterByDefaultPayout(array('min' => 12)); // WHERE default_payout >= 12
     * $query->filterByDefaultPayout(array('max' => 12)); // WHERE default_payout <= 12
     * </code>
     *
     * @param     mixed $defaultPayout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByDefaultPayout($defaultPayout = null, $comparison = null)
    {
        if (is_array($defaultPayout)) {
            $useMinMax = false;
            if (isset($defaultPayout['min'])) {
                $this->addUsingAlias(OfferPeer::DEFAULT_PAYOUT, $defaultPayout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultPayout['max'])) {
                $this->addUsingAlias(OfferPeer::DEFAULT_PAYOUT, $defaultPayout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::DEFAULT_PAYOUT, $defaultPayout, $comparison);
    }

    /**
     * Filter the query on the max_payout column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxPayout(1234); // WHERE max_payout = 1234
     * $query->filterByMaxPayout(array(12, 34)); // WHERE max_payout IN (12, 34)
     * $query->filterByMaxPayout(array('min' => 12)); // WHERE max_payout >= 12
     * $query->filterByMaxPayout(array('max' => 12)); // WHERE max_payout <= 12
     * </code>
     *
     * @param     mixed $maxPayout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByMaxPayout($maxPayout = null, $comparison = null)
    {
        if (is_array($maxPayout)) {
            $useMinMax = false;
            if (isset($maxPayout['min'])) {
                $this->addUsingAlias(OfferPeer::MAX_PAYOUT, $maxPayout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxPayout['max'])) {
                $this->addUsingAlias(OfferPeer::MAX_PAYOUT, $maxPayout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::MAX_PAYOUT, $maxPayout, $comparison);
    }

    /**
     * Filter the query on the percent_payout column
     *
     * Example usage:
     * <code>
     * $query->filterByPercentPayout(1234); // WHERE percent_payout = 1234
     * $query->filterByPercentPayout(array(12, 34)); // WHERE percent_payout IN (12, 34)
     * $query->filterByPercentPayout(array('min' => 12)); // WHERE percent_payout >= 12
     * $query->filterByPercentPayout(array('max' => 12)); // WHERE percent_payout <= 12
     * </code>
     *
     * @param     mixed $percentPayout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByPercentPayout($percentPayout = null, $comparison = null)
    {
        if (is_array($percentPayout)) {
            $useMinMax = false;
            if (isset($percentPayout['min'])) {
                $this->addUsingAlias(OfferPeer::PERCENT_PAYOUT, $percentPayout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($percentPayout['max'])) {
                $this->addUsingAlias(OfferPeer::PERCENT_PAYOUT, $percentPayout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::PERCENT_PAYOUT, $percentPayout, $comparison);
    }

    /**
     * Filter the query on the max_percent_payout column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxPercentPayout(1234); // WHERE max_percent_payout = 1234
     * $query->filterByMaxPercentPayout(array(12, 34)); // WHERE max_percent_payout IN (12, 34)
     * $query->filterByMaxPercentPayout(array('min' => 12)); // WHERE max_percent_payout >= 12
     * $query->filterByMaxPercentPayout(array('max' => 12)); // WHERE max_percent_payout <= 12
     * </code>
     *
     * @param     mixed $maxPercentPayout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByMaxPercentPayout($maxPercentPayout = null, $comparison = null)
    {
        if (is_array($maxPercentPayout)) {
            $useMinMax = false;
            if (isset($maxPercentPayout['min'])) {
                $this->addUsingAlias(OfferPeer::MAX_PERCENT_PAYOUT, $maxPercentPayout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxPercentPayout['max'])) {
                $this->addUsingAlias(OfferPeer::MAX_PERCENT_PAYOUT, $maxPercentPayout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::MAX_PERCENT_PAYOUT, $maxPercentPayout, $comparison);
    }

    /**
     * Filter the query on the tiered_payout column
     *
     * Example usage:
     * <code>
     * $query->filterByTieredPayout(1234); // WHERE tiered_payout = 1234
     * $query->filterByTieredPayout(array(12, 34)); // WHERE tiered_payout IN (12, 34)
     * $query->filterByTieredPayout(array('min' => 12)); // WHERE tiered_payout >= 12
     * $query->filterByTieredPayout(array('max' => 12)); // WHERE tiered_payout <= 12
     * </code>
     *
     * @param     mixed $tieredPayout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByTieredPayout($tieredPayout = null, $comparison = null)
    {
        if (is_array($tieredPayout)) {
            $useMinMax = false;
            if (isset($tieredPayout['min'])) {
                $this->addUsingAlias(OfferPeer::TIERED_PAYOUT, $tieredPayout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tieredPayout['max'])) {
                $this->addUsingAlias(OfferPeer::TIERED_PAYOUT, $tieredPayout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::TIERED_PAYOUT, $tieredPayout, $comparison);
    }

    /**
     * Filter the query on the advertiser_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAdvertiserId(1234); // WHERE advertiser_id = 1234
     * $query->filterByAdvertiserId(array(12, 34)); // WHERE advertiser_id IN (12, 34)
     * $query->filterByAdvertiserId(array('min' => 12)); // WHERE advertiser_id >= 12
     * $query->filterByAdvertiserId(array('max' => 12)); // WHERE advertiser_id <= 12
     * </code>
     *
     * @param     mixed $advertiserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByAdvertiserId($advertiserId = null, $comparison = null)
    {
        if (is_array($advertiserId)) {
            $useMinMax = false;
            if (isset($advertiserId['min'])) {
                $this->addUsingAlias(OfferPeer::ADVERTISER_ID, $advertiserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($advertiserId['max'])) {
                $this->addUsingAlias(OfferPeer::ADVERTISER_ID, $advertiserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::ADVERTISER_ID, $advertiserId, $comparison);
    }

    /**
     * Filter the query on the protocol column
     *
     * Example usage:
     * <code>
     * $query->filterByProtocol('fooValue');   // WHERE protocol = 'fooValue'
     * $query->filterByProtocol('%fooValue%'); // WHERE protocol LIKE '%fooValue%'
     * </code>
     *
     * @param     string $protocol The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByProtocol($protocol = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($protocol)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $protocol)) {
                $protocol = str_replace('*', '%', $protocol);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::PROTOCOL, $protocol, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the expiration_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExpirationDate('2011-03-14'); // WHERE expiration_date = '2011-03-14'
     * $query->filterByExpirationDate('now'); // WHERE expiration_date = '2011-03-14'
     * $query->filterByExpirationDate(array('max' => 'yesterday')); // WHERE expiration_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $expirationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByExpirationDate($expirationDate = null, $comparison = null)
    {
        if (is_array($expirationDate)) {
            $useMinMax = false;
            if (isset($expirationDate['min'])) {
                $this->addUsingAlias(OfferPeer::EXPIRATION_DATE, $expirationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expirationDate['max'])) {
                $this->addUsingAlias(OfferPeer::EXPIRATION_DATE, $expirationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferPeer::EXPIRATION_DATE, $expirationDate, $comparison);
    }

    /**
     * Filter the query on the currency column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrency('fooValue');   // WHERE currency = 'fooValue'
     * $query->filterByCurrency('%fooValue%'); // WHERE currency LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currency The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currency)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $currency)) {
                $currency = str_replace('*', '%', $currency);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::CURRENCY, $currency, $comparison);
    }

    /**
     * Filter the query on the offer_url column
     *
     * Example usage:
     * <code>
     * $query->filterByOfferUrl('fooValue');   // WHERE offer_url = 'fooValue'
     * $query->filterByOfferUrl('%fooValue%'); // WHERE offer_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $offerUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function filterByOfferUrl($offerUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($offerUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $offerUrl)) {
                $offerUrl = str_replace('*', '%', $offerUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferPeer::OFFER_URL, $offerUrl, $comparison);
    }

    /**
     * Filter the query by a related Category object
     *
     * @param   Category|PropelObjectCollection $category The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 OfferQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof Category) {
            return $this
                ->addUsingAlias(OfferPeer::CAT_ID, $category->getId(), $comparison);
        } elseif ($category instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OfferPeer::CAT_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type Category or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AnyTv\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\AnyTv\CategoryQuery');
    }

    /**
     * Filter the query by a related TagCloud object
     *
     * @param   TagCloud|PropelObjectCollection $tagCloud  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 OfferQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTagCloud($tagCloud, $comparison = null)
    {
        if ($tagCloud instanceof TagCloud) {
            return $this
                ->addUsingAlias(OfferPeer::ID, $tagCloud->getOfferId(), $comparison);
        } elseif ($tagCloud instanceof PropelObjectCollection) {
            return $this
                ->useTagCloudQuery()
                ->filterByPrimaryKeys($tagCloud->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTagCloud() only accepts arguments of type TagCloud or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TagCloud relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function joinTagCloud($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TagCloud');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TagCloud');
        }

        return $this;
    }

    /**
     * Use the TagCloud relation TagCloud object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AnyTv\TagCloudQuery A secondary query class using the current class as primary query
     */
    public function useTagCloudQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTagCloud($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TagCloud', '\AnyTv\TagCloudQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Offer $offer Object to remove from the list of results
     *
     * @return OfferQuery The current query, for fluid interface
     */
    public function prune($offer = null)
    {
        if ($offer) {
            $this->addUsingAlias(OfferPeer::ID, $offer->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
