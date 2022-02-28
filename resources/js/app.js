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

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})