import axios from 'axios';
window.axios = axios;

import 'flowbite';


initTWE({ Collapse, Dropdown, Ripple });

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
