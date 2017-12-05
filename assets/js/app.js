require('../css/app.scss');


var $ = require('jquery');
// require('bootstrap-sass')

require('popper.js');

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');

pace = require('pace-progress');
pace.start()

// require('@coreui/ajax/Static_Starter_GULP/src/js/app.js')

// require('@coreui/ajax')

require('./coreui-app.js');

$(document).ready(function () {

    console.log("Load document... ");
});
