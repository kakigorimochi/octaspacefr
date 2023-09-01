<template>
    <!-- <div>
        <div>OctaSpace Fund Raising</div>
        <br />
        <div>{{ content.balance_octa }} OCTA</div>
        <div>{{ content.balance_usdt }}/30,000 USDT</div>
    </div> -->
    <div style="margin: 30px;">
        <h2
        class="va-h2 text-center"
        style="margin-bottom: 80px;"
        >
            OctaSpace Fund Raising
        </h2>
        <h4
        class="va-h4 text-center"
        style="margin-bottom: 30px;"
        >
            {{ content.balance_octa }} OCTA
        </h4>
        <va-progress-bar
        :size="25"
        :model-value="goalProgress"
        content-inside
        show-percent
        />
        <h6 class="va-h6 text-center mb-4">
            {{ content.balance_usdt }} / 30,000.00 USDT
        </h6>
        <div class="text-center">Donation Address (OCTA and USDT-BEP20)</div>
        <h4 class="va-h4 text-center">
            <span class="va-text-code">{{ accountAddress }}</span>
        </h4>
    </div>
</template>

<script>
export default {
    data () {
        return {
            content: {},
            updatedContent: {
                balance_octa: null,
                balance_usdt: null,
            },
            goalProgress: 0,
            goalAmount: 30000,
            accountAddress: '0x325E5411a63fE64603EC881ce0F6AB78235E8C61',
            usdtContractAddress: '0x55d398326f99059fF775485246999027B3197955'
        };
    },
    mounted() {
        this.getContent();
    },
    methods: {
        convertWeiToCoin(value) {
            const weiValue = value.toString();
            const CoinValue = (parseFloat(weiValue) / Math.pow(10, 18)).toFixed(18);

            return CoinValue.replace(/\.?0+$/, '');
        },
        updContent() {
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/upd_content',
                data: this.content.id
            }).then(response => {
                if (response.data.status == 1) {
                    this.getContent();
                } else this.$root.prompt(response.data.text);
            }).catch(error => {
                this.$root.prompt(error.response.data.message);
            });
        },
        getContent() {
            axios({
                method: 'GET',
                type: 'JSON',
                url: '/get_content'
            }).then(response => {
                if (response.data.status == 1) {
                    this.content = response.data.result;
                } else this.$root.prompt(response.data.text);
            }).catch(error => {
                this.$root.prompt(error.response.data.message);
            });

            if (this.updatedContent.balance_octa === null) {
                axios({
                    method: 'GET',
                    type: 'JSON',
                    url: 'https://explorer.octa.space/api?module=account&action=balance&address=' + this.accountAddress
                }).then(response => {
                    if (response.data.status == 1) {
                        this.updatedContent.balance_octa = this.convertWeiToCoin(response.data.result);
                        this.content.balance_octa = parseFloat(this.updatedContent.balance_octa).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    } else this.$root.prompt(response.data.message);
                }).catch(error => {
                    this.$root.prompt(error.response);
                });
            }

            if (this.updatedContent.balance_usdt === null) {
                axios({
                    method: 'POST',
                    type: 'JSON',
                    url: '/get_bscscanapi',
                    data: {
                        address: this.accountAddress,
                        contractAddress: this.usdtContractAddress
                    }
                }).then(response => {
                    if (response.data.status == 1) {
                        this.updatedContent.balance_usdt = this.convertWeiToCoin(response.data.result);
                        this.content.balance_usdt = parseFloat(this.updatedContent.balance_usdt).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                        this.goalProgress = parseFloat((parseFloat(this.content.balance_usdt.replace(/,/g, '')) / this.goalAmount * 100).toFixed(2));
                        console.log(this.goalProgress)
                    } else this.$root.prompt(response.data.message);
                }).catch(error => {
                    this.$root.prompt(error.response);
                });
            }
        }
    }
}
</script>
