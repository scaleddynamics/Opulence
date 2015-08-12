<?php
/**
 * Copyright (C) 2015 David Young
 *
 * Defines different types of actions we can take with data in a repository
 */
namespace Opulence\ORM\Repositories;

class ActionTypes
{
    /** The data in the repo was added */
    const ADDED = 1;
    /** The data in the repo was updated */
    const UPDATED = 2;
    /** The data in the repo was deleted */
    const DELETED = 3;
} 