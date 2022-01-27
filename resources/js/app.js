require('./bootstrap');

import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue'
import ApplicationFormComponent from './components/ApplicationFormComponent.vue'
import axios from 'axios';

createApp({
    components: {
        ExampleComponent,
        ApplicationFormComponent,
    }
}).mount('#app')