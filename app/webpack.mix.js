const mix = require('laravel-mix')
require( 'laravel-mix-stylelint' )
require('laravel-mix-eslint')

require('dotenv').config()
const theme = process.env.WP_DEFAULT_THEME;

mix.setResourceRoot('../');
mix.setPublicPath(`public/themes/${theme}/public`);

mix
  .js(`public/themes/${theme}/app/js/app.js`, 'bundle.js')
  .eslint({
    fix: true,
    extensions: ['js']
  })
  .sass(`public/themes/${theme}/app/scss/style.scss`, 'app.css')
  .sourceMaps()
  .stylelint()
