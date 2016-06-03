<?php
/**
 * @file
 * LaravelJqGrid config file.
 *
 * All LaravelJqGrid code is copyright by the original authors and released under the MIT License.
 * See LICENSE.
 */

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Grid Options
	|--------------------------------------------------------------------------
	|
	| An array of grid options that will be set to all grids of your applications,
	| the key of the array must correspond to a valid grid option.
	| These options can override by setting a different value in a specific grid.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:options
	|
	*/

	'default_grid_options' => array('datatype' => 'json', 'mtype'  =>  'POST'),

	/*
	|--------------------------------------------------------------------------
	| Default Pivot Grid Options
	|--------------------------------------------------------------------------
	|
	| An array of pivot grid options that will be set to all grids of your applications,
	| the key of the array must correspond to a valid pivot grid option.
	| These options can override by setting a different value in a specific grid.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:pivotsettings
	|
	*/

	'default_pivot_grid_options' => array('yDimension' => array()),

	/*
	|--------------------------------------------------------------------------
	| Default Group Header Options
	|--------------------------------------------------------------------------
	|
	| An array of group header options that will be set to all grids of your applications,
	| the key of the array must correspond to a valid pivot grid option.
	| These options can override by setting a different value in a specific grid.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:groupingheadar
	|
	*/

	'default_group_header_options' => array('useColSpanStyle' => true),

	/*
	|--------------------------------------------------------------------------
	| Default column model properties
	|--------------------------------------------------------------------------
	|
	| An array of column model properties that will be set to all columns grid of your applications,
	| the key of the array must correspond to a valid column model property.
	| These column model properties can override by setting a different value in a specific grid.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:colmodel_options
	|
	*/

	'default_col_model_properties' => array('searchoptions' => array('sopt'=>array('cn'))),

	/*
	|--------------------------------------------------------------------------
	| Default navigator options
	|--------------------------------------------------------------------------
	|
	| Default navigators options that will be set to all grid of your applications,
	| the key of the array must correspond to a valid navigator option.
	| These options can override by setting a different value in a specific grid.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:navigator
	|
	*/

	'default_navigator_options' => array('add' => false, 'edit' => false, 'del' => false, 'search' => false, 'view' => true, 'refresh' => false),

	/*
	|--------------------------------------------------------------------------
	| Default filter toolbar options
	|--------------------------------------------------------------------------
	|
	| Default navigators options that will be set to all grid of your applications,
	| the key of the array must correspond to a valid filter toolbar option.
	| These options can override by setting a different value in a specific grid.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:toolbar_searching
	|
	*/

	'default_filter_toolbar_options' => array('stringResult' => true),

	/*
	|--------------------------------------------------------------------------
	| Default Filter Toolbar Buttons Options
	|--------------------------------------------------------------------------
	|
	| An array of toolbar button options that will be set to all grids of your applications.
	| filterToolbar: enable o disabled the filter toolbar
	| toggleButton: add a button to toggle the filter toolbar
	| clearButton: add a button to clear the filter toolbar
	| toggleButtonText: text of the toggle button
	| clearButtonText: text of the clear button
	|
	*/

	'default_filter_toolbar_buttons_options' => array('filterToolbar' => false, 'toggleButton' => true, 'clearButton' => true, 'toggleButtonText' => '', 'clearButtonText' => ''),

	/*
	|--------------------------------------------------------------------------
	| Default Export Buttons Options
	|--------------------------------------------------------------------------
	|
	| An array of toolbar button options that will be set to all grids of your applications.
	| xlsButtonVisible: show or hide the xls export button
	| xlsButtonText: text of the xls export button
	| xlsIcon: xls icon (jquery ui icon)
	| csvButtonVisible: show or hide the csv export button
	| csvButtonText: text of the csv export button
	| csvIcon: csv icon (jquery ui icon)
	|
	*/

	'default_export_buttons_options' => array('xlsButtonVisible' => true, 'xlsButtonText' => 'xls', 'xlsIcon' => 'ui-icon-arrowthickstop-1-s', 'csvButtonVisible' => true, 'csvButtonText' => 'csv', 'csvIcon' => 'ui-icon-arrowthickstop-1-s'),

	/*
	|--------------------------------------------------------------------------
	| Default Laravel Excel File Properties
	|--------------------------------------------------------------------------
	|
	| Default Laravel Excel File Properties that will be set to all grid of your applications,
	| the key of the array must correspond to a Laravel Excel File Property.
	| These properties can override by setting a different value in a specific grid.
	| Online documentation available at http://www.maatwebsite.nl/laravel-excel/docs/reference-guide
	|
	*/

	'default_file_properties' => array(),

	/*
	|--------------------------------------------------------------------------
	| Default Laravel Excel Sheet Properties
	|--------------------------------------------------------------------------
	|
	| Default Laravel Excel Sheet Properties that will be set to all grid of your applications,
	| the key of the array must correspond to a Laravel Excel Sheet Property.
	| These properties can override by setting a different value in a specific grid.
	| Online documentation available at http://www.maatwebsite.nl/laravel-excel/docs/reference-guide
	|
	*/

	'default_sheet_properties' => array(),

	/*
	|--------------------------------------------------------------------------
	| Pivot options
	|--------------------------------------------------------------------------
	|
	| Pivots options defined by the jqGrid documentation.
	| Warning: This options are vital when using the grid as a pivot grid, do not modify them unless you know what you are doing.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:pivotsettings
	|
	*/

	'pivot_options' => array('aggregates', 'colTotals', 'frozenStaticCols', 'groupSummary', 'groupSummaryPos', 'rowTotals', 'rowTotalsText', 'xDimension', 'yDimension'),

	/*
	|--------------------------------------------------------------------------
	| Group header options
	|--------------------------------------------------------------------------
	|
	| Group header options options defined by the jqGrid documentation.
	| Warning: This options are vital when grouping header columns, do not modify them unless you know what you are doing.
	| Online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:groupingheadar
	|
	*/

	'group_header_options' => array('useColSpanStyle', 'groupHeaders'),

	/*
	|--------------------------------------------------------------------------
	| Function type Grid options and column properties
	|--------------------------------------------------------------------------
	|
	| These options and properties can be set as a string by the programmer, but first and last quotes will be removed from the javascript code.
	| In some cases there are predefined values that are exceptions, these can be included as an array.
	| "JqGrid options" online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:colmodel_options
	| "JqGrid column properties" online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:colmodel_options
	| "JqGrid predefined format types" online documentation available at http://www.trirand.com/jqgridwiki/doku.php?id=wiki:predefined_formatter
	| Warning: This options are vital for the functionaty of the package, do not modify them unless you know what you are doing.
	|
	*/

	'function_type_properties' => array(
						'datatype' => array('xml', 'xmlstring', 'json', 'jsonstring', 'local', 'javascript', 'clientSide'),
						'cellattr' => array(),
						'formatter' => array('integer', 'number', 'currency', 'date', 'email', 'link', 'showlink', 'checkbox', 'select', 'actions'),
						'unformat' => array(),
						'sorttype' => array('int','integer', 'float','number', 'currency', 'date', 'text'),
						'unformat' => array(),
						'dataInit' => array(),
						'fn' => array(),
						'custom_element' => array(),
						'custom_value' => array(),
						'custom_func' => array(),
						'buildSelect' => array(),
						'dataInit' => array(),
						'summaryType' => array('sum','count','avg','min','max'),
						'rowattr' => array(),
						'converter' => array(),
					),
);
