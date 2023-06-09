/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
import $ from 'jquery'

// You can specify which plugins you need
import {Tooltip, Toast, Popover} from 'bootstrap';

// start the Stimulus application
import './bootstrap';

import 'jquery';
import 'bootstrap'

import menuRideau from './js/menuRideau'
import modalConnected from './js/modal'
import home from './js/home'


menuRideau.init();
modalConnected.init();
home.init();

















