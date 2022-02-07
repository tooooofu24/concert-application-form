window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');

import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue';
import ApplicationFormComponent from './components/ApplicationFormComponent.vue';
import TicketComponent from './components/TicketComponent.vue';

createApp({
    components: {
        ExampleComponent,
        ApplicationFormComponent,
        TicketComponent,
    }
}).mount('#app')