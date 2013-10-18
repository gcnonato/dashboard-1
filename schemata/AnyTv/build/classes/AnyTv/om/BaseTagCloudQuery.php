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
use AnyTv\Offer;
use AnyTv\Tag;
use AnyTv\TagCloud;
use AnyTv\TagCloudPeer;
use AnyTv\TagCloudQuery;

/**
 * Base class that represents a query for the 'anytv_tagcloud' table.
 *
 *
 *
 * @method TagCloudQuery orderByOfferId($order = Criteria::ASC) Order by the offer_id column
 * @method TagCloudQuery orderByTagId($order = Criteria::ASC) Order by the tag_id column
 *
 * @method TagCloudQuery groupByOfferId() Group by the offer_id column
 * @method TagCloudQuery groupByTagId() Group by the tag_id column
 *
 * @method TagCloudQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TagCloudQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TagCloudQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TagCloudQuery leftJoinOffer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Offer relation
 * @method TagCloudQuery rightJoinOffer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Offer relation
 * @method TagCloudQuery innerJoinOffer($relationAlias = null) Adds a INNER JOIN clause to the query using the Offer relation
 *
 * @method TagCloudQuery leftJoinTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tag relation
 * @method TagCloudQuery rightJoinTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tag relation
 * @method TagCloudQuery innerJoinTag($relationAlias = null) Adds a INNER JOIN clause to the query using the Tag relation
 *
 * @method TagCloud findOne(PropelPDO $con = null) Return the first TagCloud matching the query
 * @method TagCloud findOneOrCreate(PropelPDO $con = null) Return the first TagCloud matching the query, or a new TagCloud object populated from the query conditions when no match is found
 *
 * @method TagCloud findOneByOfferId(string $offer_id) Return the first TagCloud filtered by the offer_id column
 * @method TagCloud findOneByTagId(string $tag_id) Return the first TagCloud filtered by the tag_id column
 *
 * @method array findByOfferId(string $offer_id) Return TagCloud objects filtered by the offer_id column
 * @method array findByTagId(string $tag_id) Return TagCloud objects filtered by the tag_id column
 *
 * @package    propel.generator.AnyTv.om
 */
abstract class BaseTagCloudQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTagCloudQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'anytv_offers', $modelName = 'AnyTv\\TagCloud', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TagCloudQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TagCloudQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TagCloudQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TagCloudQuery) {
            return $criteria;
        }
        $query = new TagCloudQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$offer_id, $tag_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TagCloud|TagCloud[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TagCloudPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TagCloudPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 TagCloud A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `offer_id`, `tag_id` FROM `anytv_tagcloud` WHERE `offer_id` = :p0 AND `tag_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TagCloud();
            $obj->hydrate($row);
            TagCloudPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return TagCloud|TagCloud[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TagCloud[]|mixed the list of results, formatted by the current formatter
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
     * @return TagCloudQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TagCloudPeer::OFFER_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TagCloudPeer::TAG_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TagCloudQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TagCloudPeer::OFFER_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TagCloudPeer::TAG_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the offer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOfferId('fooValue');   // WHERE offer_id = 'fooValue'
     * $query->filterByOfferId('%fooValue%'); // WHERE offer_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $offerId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TagCloudQuery The current query, for fluid interface
     */
    public function filterByOfferId($offerId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($offerId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $offerId)) {
                $offerId = str_replace('*', '%', $offerId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TagCloudPeer::OFFER_ID, $offerId, $comparison);
    }

    /**
     * Filter the query on the tag_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTagId('fooValue');   // WHERE tag_id = 'fooValue'
     * $query->filterByTagId('%fooValue%'); // WHERE tag_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tagId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TagCloudQuery The current query, for fluid interface
     */
    public function filterByTagId($tagId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tagId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tagId)) {
                $tagId = str_replace('*', '%', $tagId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TagCloudPeer::TAG_ID, $tagId, $comparison);
    }

    /**
     * Filter the query by a related Offer object
     *
     * @param   Offer|PropelObjectCollection $offer The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TagCloudQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByOffer($offer, $comparison = null)
    {
        if ($offer instanceof Offer) {
            return $this
                ->addUsingAlias(TagCloudPeer::OFFER_ID, $offer->getId(), $comparison);
        } elseif ($offer instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TagCloudPeer::OFFER_ID, $offer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOffer() only accepts arguments of type Offer or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Offer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TagCloudQuery The current query, for fluid interface
     */
    public function joinOffer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Offer');

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
            $this->addJoinObject($join, 'Offer');
        }

        return $this;
    }

    /**
     * Use the Offer relation Offer object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AnyTv\OfferQuery A secondary query class using the current class as primary query
     */
    public function useOfferQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOffer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Offer', '\AnyTv\OfferQuery');
    }

    /**
     * Filter the query by a related Tag object
     *
     * @param   Tag|PropelObjectCollection $tag The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TagCloudQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTag($tag, $comparison = null)
    {
        if ($tag instanceof Tag) {
            return $this
                ->addUsingAlias(TagCloudPeer::TAG_ID, $tag->getId(), $comparison);
        } elseif ($tag instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TagCloudPeer::TAG_ID, $tag->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTag() only accepts arguments of type Tag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TagCloudQuery The current query, for fluid interface
     */
    public function joinTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tag');

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
            $this->addJoinObject($join, 'Tag');
        }

        return $this;
    }

    /**
     * Use the Tag relation Tag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AnyTv\TagQuery A secondary query class using the current class as primary query
     */
    public function useTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tag', '\AnyTv\TagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TagCloud $tagCloud Object to remove from the list of results
     *
     * @return TagCloudQuery The current query, for fluid interface
     */
    public function prune($tagCloud = null)
    {
        if ($tagCloud) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TagCloudPeer::OFFER_ID), $tagCloud->getOfferId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TagCloudPeer::TAG_ID), $tagCloud->getTagId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
