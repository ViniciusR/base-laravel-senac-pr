require('./bootstrap');
require('./commons');

window.Vue = require('vue');

import Snotify, { SnotifyPosition } from 'vue-snotify';
import vSelect from 'vue-select';

const snotify_options = {
  toast: {
    timeout: 3000,
    showProgressBar: false,
    position: SnotifyPosition.centerTop
  }
}

Vue.use(Snotify, snotify_options);
Vue.component('v-select', vSelect)

require('./components');
