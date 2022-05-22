const mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
| file for the application as well as bundling up all the JS files.
|
*/

mix.js('resources/js/notificacoes.js', 'public/js')
.js('resources/js/validacoes.js', 'public/js')
.js('resources/js/endereco.js', 'public/js')
.js('resources/views/usuarios/index.js', 'public/js/usuarios')
.js('resources/views/funcionarios/index.js', 'public/js/funcionarios')
.js('resources/views/clientes/index.js', 'public/js/clientes')
.css('resources/css/style-custom.css', 'css/style-custom.css');