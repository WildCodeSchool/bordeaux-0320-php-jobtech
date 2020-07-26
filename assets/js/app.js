/* eslint-disable */
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// Font Awesome
import '@fortawesome/fontawesome-free/js/all';

// SCSS Compiler
require('../scss/app.scss');

// jQuery
const $ = require('jquery');

// Bootstrap
require('bootstrap');

// Other Library
require('select2/dist/js/select2.min')
require('bootstrap-datepicker/js/bootstrap-datepicker')
require('bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min')

// JS JobTech
require('./form');
require('./bookmark');
