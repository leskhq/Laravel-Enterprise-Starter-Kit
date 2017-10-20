<?php

namespace App\Http\Controllers;

use App\Exceptions\FileNotFoundException;
use App\Libraries\Arr;
use App\Libraries\Utils;
use Auth;
use Flash;
use Illuminate\Http\Request;
use Settings;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataSet;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        $settings = Arr::dot($settings);
        $settingsFiltered = Utils::FilterOutUserSettings($settings);
        $settingsSorted = Arr::sortRecursive($settingsFiltered);
        $settingsDataArr = Arr::assoc_to_index(function($k, $v) {
            $newRow['data_name']  = $k;
            $newRow['data_value'] = $v;
            return $newRow;
        }, $settingsSorted);

        $grid = DataGrid::source($settingsDataArr);

        $grid->add('select', $this->getToggleCheckboxCell())->cell(function ($value, $row) {
            $name = $row['data_name'];
            $cellValue = "<input type='checkbox' name='chkSetting[]' id='" . $name . " 'value='" . $name . "' >";
            return $cellValue;
        });

        if (Auth::user()->hasPermission('core.p.users.read')) {
            $grid->add('{{ link_to_route(\'admin.settings.show\', $data_name, [$data_name], []) }}', 'Name', false);
        } else {
            $grid->add('data_name', 'data_name', false);
        }

        $grid->add('{!! App\Libraries\Str::head($data_value, 70, "...") !!}', 'Value', false);

        $grid->add('{!! App\Libraries\Utils::settingActionslinks($data_name) !!}', 'Actions');

        $page_title = trans('admin/settings/general.page.index.title'); // "Admin | Settings";
        $page_description = trans('admin/settings/general.page.index.description'); // "List of Settings";

        return view('admin.settings.index', compact('filter', 'grid', 'page_title', 'page_description'));

    }

    public function show($key)
    {
        $value = Settings::get($key);

        if (is_bool($value)) {
            $value = ($value)? "true":"false";
        }

        $page_title = trans('admin/settings/general.page.show.title');
        $page_description = trans('admin/settings/general.page.show.description', ['key' => $key]);

        return view('admin.settings.show', compact('key', 'value', 'page_title', 'page_description'));
    }

    public function create()
    {
        $page_title = trans('admin/settings/general.page.create.title');
        $page_description = trans('admin/settings/general.page.create.description');

        $key = '';
        $value = '';

        return view('admin.settings.create', compact('key', 'value', 'page_title', 'page_description'));
    }


    public function store(Request $request)
    {
        $this->validate($request, array('key'       => 'required',
            'value'     => 'required',
            'encrypted' => 'required'));

        $attributes = $request->all();

        Settings::set($attributes['key'], $attributes['value'], $attributes['encrypted']);

        Flash::success( trans('admin/settings/general.status.created') );

        return redirect('/admin/settings');
    }

    public function edit($key)
    {
        $value = Settings::get($key);

        if (is_bool($value)) {
            $value = ($value)? "true":"false";
        }

        $page_title = trans('admin/settings/general.page.edit.title');
        $page_description = trans('admin/settings/general.page.edit.description', ['key' => $key]);

        return view('admin.settings.edit', compact('key', 'value', 'page_title', 'page_description'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [ 'orgKey'    => 'required',
            'key'       => 'required',
            'value'     => 'required',
            'encrypted' => 'required']);

        $attributes = $request->all();
        $orgKey = $attributes['orgKey'];
        $key = $attributes['key'];
        $value = $attributes['value'];
        $encrypted = $attributes['encrypted'];

        Settings::set($key, $value, $encrypted);
        if ($orgKey != $key) {
            Settings::forget($orgKey);
        }

        Flash::success( trans('admin/settings/general.status.updated') );

        return redirect('/admin/settings');
    }


    public function destroy($key)
    {
        Settings::forget($key);

        Flash::success( trans('admin/settings/general.status.deleted') );

        return redirect('/admin/settings');
    }

    public function getModalDelete($key)
    {
        $error = null;

        $modal_title = trans('admin/settings/dialog.delete-confirm.title');
        $modal_onclick = '';
        $modal_href = route('admin.settings.delete', ['key' => $key]);
        $modal_body = trans('admin/settings/dialog.delete-confirm.body', ['key' => $key]);

        return view('modal_confirmation', compact('error', 'modal_href', 'modal_onclick', 'modal_title', 'modal_body'));
    }

    public function load()
    {
        $envName = env('APP_ENV', 'production');

        try {
            $cnt = Settings::load($envName);
            if (0 == $cnt) {
                Flash::warning(trans('admin/settings/general.status.no-settings-loaded', ['env' => $envName]) );
            } else {
                Flash::success(trans('admin/settings/general.status.settings-loaded', ['number' => $cnt, 'env' => $envName]) );
            }
        } catch (FileNotFoundException $fnfx) {
            Flash::error(trans('admin/settings/general.status.settings-file-not-found', ['env' => $envName]) );
        }

        return redirect('/admin/settings');

    }

    /**
     * Delete Confirm
     *
     * @return  View
     */
    public function getModalDeleteSelected(Request $request)
    {
        $error = null;

        $modal_title = trans('admin/settings/dialog.delete-selected-confirm.title');
        $modal_href = "#";
        $modal_onclick = "document.forms['frmSettingList'].action = '" . route('admin.settings.destroy-selected') . "';  document.forms['frmSettingList'].submit(); return false;";
        $modal_body = trans('admin/settings/dialog.delete-selected-confirm.body');

        return view('modal_confirmation', compact('error', 'modal_href', 'modal_onclick', 'modal_title', 'modal_body'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function destroySelected(Request $request)
    {
        $chkSettings = $request->input('chkSetting');

        if (isset($chkSettings))
        {
            foreach ($chkSettings as $setting_name)
            {
                Settings::forget($setting_name);
            }
            Flash::success(trans('admin/settings/general.status.selected-settings-deleted'));
        }
        else
        {
            Flash::warning(trans('admin/settings/general.status.no-settings-selected'));
        }

        return redirect('/admin/settings');
    }




    private function getToggleCheckboxCell()
    {
        $cell = "<a class=\"btn\" href=\"#\" onclick=\"toggleCheckbox(); return false;\" title=\"". trans('general.button.toggle-select') ."\">
                                            <i class=\"fa fa-check-square-o\"></i>
                                        </a>";
        return $cell;
    }

}
