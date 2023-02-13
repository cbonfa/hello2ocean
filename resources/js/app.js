import './bootstrap';

// Echo.channel('notifications')
//     .listen('FisherSessionChanged', (e) => {
//         console.log(e);
//     });

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'

window.Alpine = Alpine;
Alpine.plugin(mask);
Alpine.start();

window.TomSelect = require('tom-select');
