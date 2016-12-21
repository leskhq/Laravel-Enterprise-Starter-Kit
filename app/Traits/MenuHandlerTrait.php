<?php namespace App\Traits;
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

use App\Models\Menu;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Exception;
use Log;

use App\Repositories\MenuRepository;
use App\Exceptions\MenuBuilderMenuItemNotFoundException;

trait MenuHandlerTrait
{

    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * @var \App\Repositories\MenuRepository
     */
    public $menuRepository;


    /**
     * Create a new instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    public function __construct( Application $app )
    {
        $this->app = $app;

        $blankCollection = new Collection();
        $MenuRepo = new MenuRepository($this->app, $blankCollection);
        $this->menuRepository = $MenuRepo;

    }


    /**
     * Builds a representation of the menu for the defined framework and return it starting at the $topNode.
     *
     * @param string $topNode can be an instance of a Menu object, it's id or name. It is set to 'root' by default.
     * @param bool $includeTopNode indicates whether to include the root node itself or not. It's default value is 'false'.
     *
     * @return \Illuminate\View\View
     */
    public function renderMenu( $topNode = 'root', $includeTopNode = false )
    {
        $menuContent = "";

        try {
            $topNode = $this->getMenuItem($topNode);
            $menuBranch = $this->getMenuBranch();

            $variables   = $this->getVariables($topNode);
            $menuContent = $this->replaceVars($this->MENU_HEADER, $variables);

            if($includeTopNode) {
                $menuContent .= $this->renderMenuItem($topNode, $variables, $menuBranch);
            }
            else {
                $children = $topNode->children;
                foreach($children as $child) {
                    $menuContent .= $this->renderMenuItem($child, $variables, $menuBranch);
                }
            }
            $menuContent .= $this->replaceVars($this->MENU_FOOTER, $variables);
        }
        catch (\Exception $ex) {
            $menuContent = "<!-- Failed to render menu -->";
        }

        return view($this->MENU_PARTIAL_VIEW, compact('menuContent'));
    }


    /**
     *
     *
     *
     * @param Menu $item
     * @param array $variables
     *
     * @return string
     */
    public function renderMenuItem( Menu $item, $variables = [], $menuBranch = [] )
    {
        $itemGroupStart  = "";
        $itemGroupContent  = "";
        $itemGroupEnd  = "";
        $itemContent = "";

        if ($item->enabled) {
            $variables = $this->getVariables($item, $variables);

            $bActive      = in_array($item->name, $menuBranch);
            $bHasChildren = ($item->children->count())                       ? true : false;
            $bIsSeparator = ($item->separator)                               ? true : false;

            if ($bHasChildren) {
                if ($bActive) {
                    $itemGroupStart = $this->replaceVars($this->MENU_GROUP_START_OPENED, $variables);
                }
                else {
                    $itemGroupStart = $this->replaceVars($this->MENU_GROUP_START_CLOSED, $variables);
                }

                $children = $item->children;
                foreach($children as $child) {
                    $itemGroupContent .= $this->renderMenuItem($child, $variables, $menuBranch);
                }

                $itemGroupEnd = $this->replaceVars($this->MENU_GROUP_END, $variables);

                if ("" != $itemGroupContent) {
                    $itemContent = $itemGroupStart . $itemGroupContent . $itemGroupEnd;
                }
            }
            elseif ($bIsSeparator) {
                $itemContent .= $this->replaceVars($this->MENU_ITEM_SEPARATOR, $variables);
            }
            else {
                if ($bActive) {
                    $itemContent .= $this->replaceVars($this->MENU_ITEM_ACTIVE, $variables);
                }
                else {
                    $itemContent .= $this->replaceVars($this->MENU_ITEM_INACTIVE, $variables);
                }
            }
        }

        return $itemContent;
    }


    /**
     * @param null $leaf
     * @param string $topNode
     * @param bool $includeTopNode
     * @return \Illuminate\View\View
     */
    public function renderBreadcrumbTrail( $leaf = null, $topNode = 'root', $includeTopNode = false )
    {
        $trailContent = "";

        try {
            $bContinue = true;

            // Get crumbtrail leaf node from session in case a controller wants to force it.
            // Use session()->pull() to unset/reset the variable after each use.
            if (session()->has('crumbtrail.leaf')) {
                $leaf = session()->pull('crumbtrail.leaf');
            }

            $leaf    = $this->GetLeafMenuItem($leaf);
            $topNode = $this->getMenuItem($topNode);

            $variables    = $this->getVariables($leaf);
            $trailContent = $this->replaceVars($this->TRAIL_FOOTER, $variables);

            $trailNode = $leaf;
            while ($bContinue) {

                $trailContent = $this->renderBreadcrumbTrailItem($trailNode, $variables) . $trailContent;

                // If we already reached the top node
                if ($topNode->id == $trailNode->id) {
                    $bContinue = false;
                }
                // Else if parent is the top node and we want to render it, continue.
                elseif ( ($topNode->id == $trailNode->parent->id) && ($includeTopNode) ) {
                    $trailNode = $trailNode->parent;
                }
                // Else if parent is the top node and we do not want to render it, stop.
                elseif ( ($topNode->id == $trailNode->parent->id) && (!$includeTopNode)) {
                    $bContinue = false;
                }
                // Otherwise continue to the next parent node.
                else {
                    $trailNode = $trailNode->parent;
                }

            }
            $trailContent = $this->replaceVars($this->TRAIL_HEADER, $variables) . $trailContent;
        }
        catch (\Exception $ex) {
            $trailContent = "<!-- Failed to render breadcrumb trail -->";
            Log::error('Failed to render breadcrumb trail.', ['Exception' => $ex]);
        }

        return view($this->TRAIL_PARTIAL_VIEW, compact('trailContent'));

    }


    /**
     * @param Menu $item
     * @param array $variables
     * @return mixed|string
     */
    public function renderBreadcrumbTrailItem( Menu $item, $variables = [] )
    {
        $itemContent = "";
        $htmlTemplate = "<!-- Failed to identify breadcrumb trail HTML template -->";

        $variables = $this->getVariables($item, $variables);

        $bActive = ($variables['URL'] == $variables['CURRENT_URL']) ? true : false;
        $bHasURL = (!empty($variables['URL'])) ? true : false;

        if ($bActive && $bHasURL) {
            $htmlTemplate = $this->TRAIL_ITEM_ACTIVE_WITH_URL;
        }
        elseif ($bActive && !$bHasURL) {
            $htmlTemplate = $this->TRAIL_ITEM_ACTIVE_NO_URL;
        }
        elseif (!$bActive && $bHasURL) {
            $htmlTemplate = $this->TRAIL_ITEM_INACTIVE_WITH_URL;
        }
        elseif (!$bActive && !$bHasURL) {
            $htmlTemplate = $this->TRAIL_ITEM_INACTIVE_NO_URL;
        }

        $itemContent = $this->replaceVars($htmlTemplate, $variables);

        return $itemContent;
    }


    /**
     * @param $input
     * @return mixed
     * @throws MenuBuilderMenuItemNotFoundException
     */
    public function getMenuItem( $input )
    {
        // If we where given a MenuItem return it.
        if ($input instanceof Menu) {
            return $input;
        }
        // Fix #21: PostgreSQL throws an QueryException when we search a text value in a
        // field of numerical type.
        try {
            // Try to find the root object by it's ID
            $menuItem = $this->menuRepository->find($input);
            if ($menuItem instanceof Menu) {
                return $menuItem;
            }
        }
        catch (QueryException $ex) {
        }
        try {
            // Try to find the root object by it's name
            $menuItem = $this->menuRepository->findBy('name', $input);
            if ($menuItem instanceof Menu) {
                return $menuItem;
            }
        }
        catch (QueryException $ex) {
        }

        // Could not find the requested menu item, throwing an exception.
        throw new MenuBuilderMenuItemNotFoundException("Menu item [".$input."] not found.");
    }


    public function getMenuBranch( $leaf = null )
    {
        $menuBranch = [];

        try {
            // Try to resolve leaf if not already provided.
            if (!($leaf instanceof Menu)) {
                $leaf = $this->getLeafMenuItem($leaf);
            }

            $continue = true;
            $pointer = $leaf;
            while ($continue) {
                $menuBranch[] = $pointer->name;
                if ('root' == $pointer->name) {
                    $continue = false;
                } else {
                    $pointer = $pointer->parent;
                }
            }
        } catch (MenuBuilderMenuItemNotFoundException $ex) { }

        return $menuBranch;
    }


    /**
     * @param null $leaf
     * @return mixed|null
     * @throws MenuBuilderMenuItemNotFoundException
     */
    public function getLeafMenuItem( $leaf = null )
    {
//        // Get crumbtrail leaf node from session in case a controller wants to force it.
//        // Use session()->pull() to unset/reset the variable after each use.
//        if (session()->has('crumbtrail.leaf')) {
//            $leaf = session()->pull('crumbtrail.leaf');
//        }
//
        // Get the leaf menu item from the value passed in.
        try {
            $leaf = $this->getMenuItem($leaf);
            return $leaf;
        }
        catch (MenuBuilderMenuItemNotFoundException $ex) {
            // Eat the exception as we want a chance to find it from the current route.
        }

        // find by current URL...
        $currentUrl = $this->getCurrentUrl();
        $leaf = $this->menuRepository->findBy('url', $currentUrl);
        if ($leaf instanceof Menu) {
            return $leaf;
        }

        // Could not find the requested menu item, throwing an exception.
        throw new MenuBuilderMenuItemNotFoundException("Menu item [".$leaf."] not found for URL [".$currentUrl."].");

    }


    /**
     * @return null
     */
    public function getCurrentUrl()
    {
        $staticPrefix = null;

        $route = $this->app->request->route();
        if (null != $route) {
            $compRoute = $route->getCompiled();
            $staticPrefix = $compRoute->getStaticPrefix();
        }
        return $staticPrefix;
    }


    /**
     * @param $string
     * @param $vars
     * @return mixed
     */
    public function replaceVars( $string, $vars )
    {
        foreach($vars as $key => $value) {
            $search = '@'.$key.'@';
            $string = str_replace($search, $value, $string);
        }

        return $string;
    }

    /**
     * @param Menu $menu
     * @param array $variables
     * @return array
     */
    public function getVariables( Menu $menu, $variables = [] )
    {
        // Get the icon or use blank.
        $icon = ($menu->icon) ? $menu->icon : "";
        // Get the URL or use a placeholder.
        $url = $this->generateUrl($menu);
        // Get the current URL.
        $currentUrl = $this->getCurrentUrl();

        $variables = [  'URL'         => $url,
                        'ICON'        => $icon,
                        'LABEL'       => $menu->label,
                        'CURRENT_URL' => $currentUrl ];

        return $variables;
    }


    /**
     * @param Menu $menu
     * @return mixed|null|string
     */
    public function generateUrl( Menu $menu )
    {
        $url = null;

        if ($menu instanceof Menu) {
            $url = ($menu->url) ? $menu->url : null;
        }

        return $url;
    }

}
