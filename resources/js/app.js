import './bootstrap.js';
import 'vuestic-ui/css';

import { createApp } from 'vue';
import { createVuestic } from 'vuestic-ui';

import index from './pages/index.vue';

const app = createApp({
    data () {
        return {
            goalProgress: 0,
            goalAmount: 30000,
						goalAmountPercentage: 0,
            accountAddress: '0x325E5411a63fE64603EC881ce0F6AB78235E8C61',
            usdtBEP20ContractAddress: '0x55d398326f99059fF775485246999027B3197955',
            busdBEP20ContractAddress: '0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56',
            showCreator: Math.random() < 0.5, // Randomized true or false
        };
    },
    components: {
        'index': index,
    },
    methods: {
        convertWeiToUnit(value) {
            return parseFloat(value.toString()) / Math.pow(10, 18).toFixed(18);
        },
        prompt(msg = "Something went wrong.") {
            this.$vaToast.init({
                message: msg,
                color: '#6F158D',
                position: 'bottom-right'
            });
        },
        copyWalletAddress() {
            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.value = this.accountAddress;
            document.body.appendChild(tempInput);

            // Select and copy the text in the input
            tempInput.select();
            document.execCommand('copy');

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            this.prompt("Copied to clipboard");
        }
    }
});

app.use(createVuestic({
    config: {
        colors: {
            variables: {
                accentPrimary: "#6F158D",
                accentSecondary: "#6B185D",
                accentThird: "#C31A98",
                darkPrimary: "#151924",
                whitePrimary: "#FFFFFF",
                whiteSecondary:"#FDFDFD",
                gray: "#B8B8B8"
            },
        }
    }
})).mount('#app');
