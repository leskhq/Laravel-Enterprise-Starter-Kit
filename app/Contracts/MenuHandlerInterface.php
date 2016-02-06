<?php

namespace App\Contracts;

/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @package Sroutier\MenuBuilder
 */

use Illuminate\Foundation\Application;

interface MenuHandlerInterface
{

    public function __construct( Application $app );

    public function renderMenu( $topNode = 'root', $includeTopNode = false );

    public function renderBreadcrumbTrail( $leaf = null, $topNode = 'root', $includeTopNode = false );

}
