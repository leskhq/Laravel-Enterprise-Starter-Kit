process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

// TODO: Include all other CSS and JS files: JQuery, Bootstrap, Select2, etc...
elixir(function(mix) {
    // Compile our SASS file to CSS.
    mix.sass('d-shop/style.scss', 'resources/assets/css/');
    // Combine the various CSS into one.
    mix.styles([
        'd-shop/font-awesome.css',
        'd-shop/bootstrap.css',
        'd-shop/jquery.smartmenus.bootstrap.css',
        'd-shop/jquery.simpleLens.css',
        'd-shop/slick.css',
        'd-shop/nouislider.css',
        'style.css'
    ], 'public/css/app.css');

    // Compile our Coffee file to JS.
    // mix.coffee('app.coffee');
    // Combine the various JS into one.
    mix.scripts([
        'd-shop/bootstrap.js',
        'd-shop/jquery.smartmenus.js',
        'd-shop/jquery.smartmenus.bootstrap.js',
        'd-shop/jquery.simpleGallery.js',
        'd-shop/jquery.simpleLens.js',
        'd-shop/slick.js',
        'd-shop/nouislider.js',
        'd-shop/custom.js'
    ], 'public/js/d-shop/store.js');

    // Enable cache busting versions.
    // mix.version(['css/store.css', 'js/store.js']);
});
