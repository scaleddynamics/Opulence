<?php
/**
 * Opulence
 *
 * @link      https://www.opulencephp.com
 * @copyright Copyright (C) 2015 David Young
 * @license   https://github.com/opulencephp/Opulence/blob/master/LICENSE.md
 */
namespace Opulence\QueryBuilders\PostgreSql;

use Opulence\QueryBuilders\AugmentingQueryBuilder as BaseAugmentingQueryBuilder;

/**
 * Adds PostgreSQL-specific functionality for augmenting queries
 */
class AugmentingQueryBuilder extends BaseAugmentingQueryBuilder
{
    /** @var array The list of columns whose value we want to return */
    protected $returningExpressions = [];

    /**
     * Adds to a "RETURNING" clause
     *
     * @param string $expression,... A variable list of expressions to add to the "RETURNING" clause
     * @return $this
     */
    public function addReturning($expression)
    {
        $this->returningExpressions = array_merge($this->returningExpressions, func_get_args());

        return $this;
    }

    /**
     * Gets the SQL that makes up the "RETURNING" clause, if one was specified
     *
     * @return string The SQL making up the "RETURNING" clause
     */
    public function getReturningClauseSql()
    {
        if (count($this->returningExpressions) > 0) {
            return " RETURNING " . implode(", ", $this->returningExpressions);
        }

        return "";
    }

    /**
     * Starts a "RETURNING" clause
     * Only call this method once per query because it will overwrite any previously-set "RETURNING" expressions
     *
     * @param string $expression,... A variable list of expressions to add to the "RETURNING" clause
     * @return $this
     */
    public function returning($expression)
    {
        $this->returningExpressions = func_get_args();

        return $this;
    }
} 