import './bootstrap';
import 'vuestic-ui/css';

import { createApp } from 'vue';
import { createVuestic } from 'vuestic-ui';

import indexModule from './pages/index.vue';

const app = createApp({
    data () {
        return {

        };
    },
    components: {
        'index': indexModule,
    },
    methods: {
        prompt(msg = "Something went wrong.") {
            this.$vaToast.init({
                message: msg,
                position: 'bottom-right'
            });
        },
    },
});

app.use(createVuestic()).mount('#app');
