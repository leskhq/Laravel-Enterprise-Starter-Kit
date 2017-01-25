<?php namespace App\Handlers;
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

use App\Contracts\MenuHandlerInterface;
use App\Traits\MenuHandlerTrait;

class BootstrapLightMenuHandler implements MenuHandlerInterface
{

    use MenuHandlerTrait;

    // TODO: RenderLeftAlignmentGroup
    // TODO: RenderRightAlignmentGroup

    public $MENU_PARTIAL_VIEW       = 'partials._bootstrap-light-menu';
    public $MENU_HEADER             = "<ul class='nav navbar-nav'>";
    public $MENU_FOOTER             = "</ul>";
    public $MENU_ITEM_SEPARATOR     = "<li role='separator' class='divider'></li>";
    public $MENU_ITEM_INACTIVE      = "<li><a href='@URL@'><i class='@ICON@'></i>&nbsp;@LABEL@</a></li>";
    public $MENU_ITEM_ACTIVE        = "<li class='active'><a href='@URL@'><i class='@ICON@'></i>&nbsp;@LABEL@<span class='sr-only'>(current)</span></a></li>";
    public $MENU_GROUP_START_OPENED = "<li class='dropdown'><a href='@URL@' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><i class='@ICON@'></i>&nbsp;@LABEL@<span class='caret'></span></a><ul class='dropdown-menu'>";
    public $MENU_GROUP_START_CLOSED = "<li class='dropdown'><a href='@URL@' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><i class='@ICON@'></i>&nbsp;@LABEL@<span class='caret'></span></a><ul class='dropdown-menu'>";
    public $MENU_GROUP_END          = "</ul></li>";

    public $TRAIL_PARTIAL_VIEW           = 'partials._bootstrap-light-trail';
    public $TRAIL_HEADER                 = "<ol class='breadcrumb'>";
    public $TRAIL_FOOTER                 = "</ol>";
    public $TRAIL_ITEM_ACTIVE_NO_URL     = "<li>@LABEL@</li>";
    public $TRAIL_ITEM_ACTIVE_WITH_URL   = "<li><a href='@URL@'>@LABEL@</a></li>";
    public $TRAIL_ITEM_INACTIVE_NO_URL   = "<li>@LABEL@</li>";
    public $TRAIL_ITEM_INACTIVE_WITH_URL = "<li><a href='@URL@'>@LABEL@</a></li>";

}
