<template>
    <div class="h-screen relative overflow-hidden bg-gradient-to-r from-[#161A26] to-[#040207]">
        <div class="flex items-center min-h-[100vh]">
            <div class="flex w-9/12 py-8 mt-[-10em] max-[1024px]:mt-[-5em] max-[540px]:mt-[-7em] max-[375px]:mt-[-3.7em]">
                <div class="shrink w-1/8 m-auto max-[428px]:mx-[20px] max-[280px]:mx-[12px]">
                    <ConfettiExplosion
                    v-if="$root.goalProgress >= 100 && balance.octa !== null && balance.usdt !== null && balance.busd !== null"
                    />
                    <div class="inline-flex mb-3">
                        <a
                        title="OctaSpace"
                        class="w-[60px] max-[280px]:w-[48px]"
                        href="https://octa.space/"
                        >
                            <img :src="OctaSpaceLogo" alt="octa logo">
                        </a>
                    </div>
                    <div class="mb-7 max-[540px]:mb-5 max-[280px]:mb-3">
                        <h1 class="va-h1 text-octa text-[var(--va-white-primary)!important] max-[540px]:text-octa-sm max-[280px]:text-octa-sm-fold">
                            Octa<span class="text-[var(--va-accent-third)]">.</span>Space
                        </h1>
                    </div>
                    <div class="mb-12 max-[540px]:mb-7 max-[540px]:ml-0.5">
                        <div class="font-light text-[2.07em] max-[540px]:text-[1.67em] max-[280px]:text-[1.27em] max-[280px]:mr-[25px] text-white">
                            Exchange listing crowdfund
                        </div>
                    </div>
                    <div class="text-white mb-[10px] max-[540px]:mb-[15px]">
                        <va-progress-bar
                        :model-value="100"
                        class="mb-2"
                        color="#6F185D"
                        size="large"
                        content-inside
                        >
                            {{ balance.octa ? formatValuetoLocale(balance.octa) : formatValuetoLocale(0) }} OCTA
                        </va-progress-bar>
                    </div>
                    <div class="text-white mb-[3rem] max-[540px]:mb-[2.3rem]">
                        <div
                        id="octausdt-progress-bar-label-percent"
                        class="flex mb-[3px] max-[540px]:mb-[1px] max-[280px]:text-[13px]"
                        >
                            <div class="va-title text-right">
                                {{ formatValuetoLocale($root.goalProgress) }}%
                            </div>
                        </div>
                        <va-progress-bar
                        v-if="$root.goalProgress >= 100"
                        :model-value="$root.goalProgress"
                        class="mb-2"
                        color="#F0B90B"
                        size="large"
                        content-inside
                        >
                            {{
                                balance.usdt && balance.busd ?
                                formatValuetoLocale($root.goalAmount - (balance.usdt + balance.busd)) : formatValuetoLocale(0)
                            }}
                            USDT
                        </va-progress-bar>
                        <va-progress-bar
                        v-else
                        :model-value="$root.goalProgress"
                        :indeterminate="!isCached && !balance.usdt && !balance.busd"
                        color="#F0B90B"
                        size="0.6em"
                        />
                        <div
                        id="octausdt-progress-bar-label-left"
                        v-if="rateLimitedBscScan"
                        class="flex mt-[3px] max-[540px]:mt-[3px] max-[280px]:text-[13px]"
                        >
                            <div class="va-title text-left">
                                {{ invalidBscScanAPIKEY ? 'Error!' : 'Rate Limited' }}
                            </div>
                            <div class="va-title text-right">
                                {{ invalidBscScanAPIKEY ? 'Invalid API key' : 'Please refresh page!' }}
                            </div>
                        </div>
                        <div
                        id="octausdt-progress-bar-label-right"
                        v-else
                        class="flex mt-[3px] max-[540px]:mt-[3px] max-[280px]:text-[13px]"
                        >
                            <div v-if="$root.goalProgress >= 100" class="va-title text-left">
                                Goal Reached
                            </div>
                            <div v-else class="va-title text-left">
                                {{
                                    balance.usdt && balance.busd ?
                                    formatValuetoLocale($root.goalAmount - (balance.usdt + balance.busd)) : formatValuetoLocale(0)
                                }}
                                USDT remaining...
                            </div>
                            <div v-if="$root.goalProgress >= 100" class="va-title text-right">
                                Thank you for your support!
                            </div>
                            <div v-else class="va-title text-right">
                                {{
                                    balance.usdt && balance.busd ?
                                    formatValuetoLocale(balance.usdt + balance.busd) : formatValuetoLocale(0)
                                }}
                                /
                                {{
                                    formatValuetoLocale($root.goalAmount)
                                }}
                                USDT
                            </div>
                        </div>
                    </div>
                    <div id="octaaddress-container">
                        <p class="text-white mb-[4.5px] max-[540px]:text-[16px] max-[280px]:text-[14px]">
                            To support the listing of the project on CEX, you can contribute via:
                        </p>
                        <va-input
                        id="octawallet-address"
                        :type="screenWidth <= 412 ? 'textarea' : 'text'"
                        v-model="$root.accountAddress"
                        class="w-full"
                        label="Wallet Address"
                        readonly
                        >
                            <template #appendInner>
                                <va-icon
                                class="hover:text-[#6F185D!important]"
                                title="Copy"
                                name="content_copy"
                                size="small"
                                color="#6B158D"
                                @click="$root.copyWalletAddress()"
                                />
                            </template>
                        </va-input>
                        <div class="flex my-[6px] max-[540px]:my-[7px]">
                            <div class="text-left">
                                <va-chip
                                class="mr-[7px] hover:bg-[#3FD959!important]"
                                color="#34B34A"
                                size="small"
                                square
                                >
                                    <a
                                    class="va-title"
                                    title="Linktree"
                                    href="https://linktr.ee/octaspace"
                                    >
                                        LINKTREE
                                    </a>
                                </va-chip>
                            </div>
                            <div class="text-right">
                                <va-chip
                                class="ml-[7px] hover:bg-[#95207D!important]"
                                color="#6F185D"
                                size="small"
                                square
                                >
                                    <a
                                    class="va-title"
                                    title="Octaexplorer"
                                    href="https://explorer.octa.space/address/0x325E5411a63fE64603EC881ce0F6AB78235E8C61"
                                    >
                                        OCTA
                                    </a>
                                </va-chip>
                                <va-chip
                                class="ml-[7px] hover:bg-[#FFD40B!important]"
                                color="#F0B90B"
                                size="small"
                                square
                                >
                                    <a
                                    class="va-title"
                                    title="Bscscan"
                                    href="https://bscscan.com/address/0x325E5411a63fE64603EC881ce0F6AB78235E8C61"
                                    >
                                        USDT(BSC)
                                    </a>
                                </va-chip>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
        v-if="$root.showCreator"
        >
            <div class="va-title text-white text-center absolute left-1/2 transform -translate-x-1/2 bottom-3">
                <a title="@kakigorimochi '23" href="https://twitter.com/kakigorimochi">
                    @kakigorimochi '23
                </a>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
* {
    font-family: 'Space Grotesk', sans-serif;
}
.va-chip--small {
    padding: 0;
    height: 18px;
    border-radius: 2px;
}
.va-chip:hover:not(.va-chip--readonly) {
    opacity: 1;
}
.va-input-wrapper__label {
    color: var(--va-accent-primary)!important;
}
.va-input-wrapper__field {
    border-color: var(--va-background-element);
}
.va-input-wrapper__field textarea {
    overflow: hidden;
    margin-bottom: 0;
}
#octausdt-progress-bar-label-left .va-title,
#octausdt-progress-bar-label-right .va-title,
#octausdt-progress-bar-label-percent .va-title {
    font-size: .8rem;
}
@media (max-width: 540px) {
    #octausdt-progress-bar-label-left .va-title,
    #octausdt-progress-bar-label-right .va-title,
    #octausdt-progress-bar-label-percent .va-title  {
        font-size: .710rem;
    }
}
</style>

<script setup>
import OctaSpaceLogo from '../../img/logo.png'
</script>

<script>
import ConfettiExplosion from "vue-confetti-explosion"

export default {
    data () {
        return {
            balance: {
                octa: null,
                usdt: null,
                busd: null,
            },
            isCached: false,
            rateLimitedBscScan: false,
            invalidBscScanAPIKEY: false,
            screenWidth: window.innerWidth,
        };
    },
    components: {
        ConfettiExplosion
    },
    mounted() {
        (this.balance.octa === null) && axios({
            method: 'POST',
            type: 'JSON',
            url: '/api',
            data: {
                api: 'octa',
                address: this.$root.accountAddress,
            }
        }).then(response => {
            if (response.data.status == 1) {
                this.balance.octa = this.$root.convertWeiToUnit(response.data.result);
            } else {
                this.$root.prompt(response.data.result);
                this.balance.octa = 0.00;
            }
        }).catch(error => {
            this.$root.prompt(error.response);
            this.balance.octa = 0.00;
        });

        (this.balance.usdt === null) && axios({
            method: 'POST',
            type: 'JSON',
            url: '/api',
            data: {
                api: 'bsc',
                contractAddress: this.$root.usdtBEP20ContractAddress,
                address: this.$root.accountAddress,
            }
        }).then(response => {
            if (response.data.status == 1) {
                this.balance.usdt = this.$root.convertWeiToUnit(response.data.result);
                this.updateProgressPercentage();
            } else {
                this.$root.prompt(response.data.result);
                this.balance.usdt = 0.00;

                response.data.result === 'Invalid API Key' && (this.invalidBscScanAPIKEY = true);
                this.rateLimitedBscScan = true;
            }
        }).catch(error => {
            this.$root.prompt(error.response);
            this.balance.usdt = 0.00;
        });

        (this.balance.busd === null) && axios({
            method: 'POST',
            type: 'JSON',
            url: '/api',
            data: {
                api: 'bsc',
                contractAddress: this.$root.busdBEP20ContractAddress,
                address: this.$root.accountAddress,
            }
        }).then(response => {
            if (response.data.status == 1) {
                this.balance.busd = this.$root.convertWeiToUnit(response.data.result);
                this.updateProgressPercentage(response.data.result.cached);
            } else {
                this.$root.prompt(response.data.result);
                this.balance.busd = 0.00;

                response.data.result === 'Invalid API Key' && (this.invalidBscScanAPIKEY = true);
                this.rateLimitedBscScan = true;
            }
        }).catch(error => {
            this.$root.prompt(error.response);
            this.balance.busd = 0.00;
        });
    },
    methods: {
        updateProgressPercentage(cached=null) {
            this.balance.usdt !== null && this.balance.busd !== null && (
                this.$root.goalProgress = (this.balance.usdt + this.balance.busd) / this.$root.goalAmount * 100
            )
            cached && (this.isCached = true);
        },
        formatValuetoLocale(value) {
            return value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },
    },
}
</script>
