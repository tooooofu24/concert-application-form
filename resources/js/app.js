require('./bootstrap');

import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue';
import ApplicationFormComponent from './components/ApplicationFormComponent.vue';
import TicketComponent from './components/TicketComponent.vue';
import axios from 'axios';

createApp({
    components: {
        ExampleComponent,
        ApplicationFormComponent,
        TicketComponent,
    }
}).mount('#app')