require('./bootstrap');
const ujs = require('@rails/ujs');
ujs.start();

require('select2');
$(document).ready(() => $('.multiselect-started').select2());
