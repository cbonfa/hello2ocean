import './bootstrap';

// Echo.channel('notifications')
//     .listen('FisherSessionChanged', (e) => {
//         console.log(e);
//     });

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.TomSelect = require('tom-select');

Alpine.start();
