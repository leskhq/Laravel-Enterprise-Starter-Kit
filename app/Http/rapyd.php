<?php

//dataform routing
Burp::post(null, 'process=1', array('as'=>'save', function() {
    BurpEvent::queue('dataform.save');
}));

//datagrid routing
Burp::get(null, 'page/(\d+)', array('as'=>'page', function($page) {
    BurpEvent::queue('dataset.page', array($page));
}));
Burp::get(null, 'ord=(-?)(\w+)', array('as'=>'orderby', function($direction, $field) {
    $direction = ($direction == '-') ? "DESC" : "ASC";
    BurpEvent::queue('dataset.sort', array($direction, $field));
}))->remove('page');

//todo: dataedit  


if (version_compare(app()->version(), '5.2')>0)
{
    Route::group(['middleware' => 'web'], function () {
        Route::get('rapyd-ajax/{hash}', array('as' => 'rapyd.remote', 'uses' => '\Zofe\Rapyd\Controllers\AjaxController@getRemote'));
        if (version_compare(app()->version(), '5.3')>0)
        {
//            Route::resource('rapyd-demo', '\Zofe\Rapyd\Demo\DemoController');
            Route::get  ('rapyd-demo',           ['as' => 'rapyd-demo.index',   'uses' => '\Zofe\Rapyd\Demo\DemoController@getIndex'  ]);
            Route::get  ('rapyd-demo/schema',    ['as' => 'rapyd-demo.schema',   'uses' => '\Zofe\Rapyd\Demo\DemoController@getSchema'  ]);
            Route::get  ('rapyd-demo/models',    ['as' => 'rapyd-demo.models',   'uses' => '\Zofe\Rapyd\Demo\DemoController@getModels'  ]);
            Route::get  ('rapyd-demo/set',       ['as' => 'rapyd-demo.set',   'uses' => '\Zofe\Rapyd\Demo\DemoController@getSet'  ]);
            Route::get  ('rapyd-demo/grid',      ['as' => 'rapyd-demo.grid',   'uses' => '\Zofe\Rapyd\Demo\DemoController@getGrid'  ]);
            Route::get  ('rapyd-demo/edit',      ['as' => 'rapyd-demo.edit',  'uses' => '\Zofe\Rapyd\Demo\DemoController@anyEdit' ]);
            Route::post ('rapyd-demo/edit',      ['as' => 'rapyd-demo.edit_post',  'uses' => '\Zofe\Rapyd\Demo\DemoController@anyEdit' ]);
            Route::get  ('rapyd-demo/filter',    ['as' => 'rapyd-demo.filter',   'uses' => '\Zofe\Rapyd\Demo\DemoController@getFilter'  ]);

        } else {
            Route::controller('rapyd-demo', '\Zofe\Rapyd\Demo\DemoController');
        }
    });
} else {
    Route::get('rapyd-ajax/{hash}', array('as' => 'rapyd.remote', 'uses' => '\Zofe\Rapyd\Controllers\AjaxController@getRemote'));
    //Route::controller('rapyd-demo', '\Zofe\Rapyd\Demo\DemoController');
}
