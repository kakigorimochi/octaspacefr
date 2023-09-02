<template>
    <div class="h-screen relative overflow-hidden bg-gradient-to-r from-[#161A26] to-[#040207]">
        <div class="flex items-start min-h-[100vh)]">
            <div class="flex items-center w-9/12 md:mx-5 py-8 min-h-[100vh]">
                <div class="shrink w-1/8 m-auto max-[540px]:mx-[20px] max-[280px]:mx-[12px]">
                    <ConfettiExplosion
                    v-if="$root.goalProgress === 100 && balance.octa !== null && balance.usdt !== null"
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
                    <div class="mb-7 max-[540px]:mb-5 max-[540px]:mb-3">
                        <h1 class="va-h1 text-octa max-[540px]:text-octa-sm max-[280px]:text-octa-sm-fold text-[var(--va-white-primary)!important]">
                            Octa<span class="text-[var(--va-accent-third)]">.</span>Space
                        </h1>
                    </div>
                    <div class="mb-12 max-[540px]:mb-7 max-[540px]:ml-0.5">
                        <div class="font-light text-[2.07em] max-[540px]:text-[1.67em] max-[280px]:text-[1.27em] max-[280px]:mr-[25px] text-white">
                            Exchange enlistment, Fund Raising
                        </div>
                    </div>
                    <div class="text-white mb-[10px] max-[540px]:mb-[15px]">
                        <div></div>
                        <va-progress-bar
                        :model-value="100"
                        class="mb-2"
                        color="#6F158D"
                        size="large"
                        content-inside
                        >
                            {{ balance.octa ? balance.octa : parseFloat(0).toFixed(2) }} OCTA
                        </va-progress-bar>
                    </div>
                    <div class="text-white mb-[3rem] max-[540px]:mb-[2.3rem]">
                        <div class="flex mb-[1px] max-[540px]:mb-[1px] max-[280px]:text-[13px]">
                            <div class="va-title text-right">
                                {{ $root.goalProgress ? $root.goalProgress.toFixed(2) : parseFloat(0).toFixed(2) }}%
                            </div>
                        </div>
                        <va-progress-bar
                        v-if="$root.goalProgress === 100"
                        :model-value="$root.goalProgress"
                        class="mb-2"
                        color="#F0B90B"
                        size="large"
                        content-inside
                        >
                            {{ balance.usdt ? balance.usdt : parseFloat(0).toFixed(2) }} USDT
                        </va-progress-bar>
                        <va-progress-bar
                        v-else
                        :model-value="$root.goalProgress"
                        color="#F0B90B"
                        size="0.6em"
                        />
                        <div class="flex mt-[3px] max-[540px]:mt-[3px] max-[280px]:text-[13px]">
                            <div v-if="$root.goalProgress === 100" class="va-title text-left">
                                Goal Reached
                            </div>
                            <div v-else class="va-title text-left">
                                {{
                                    balance.usdt ?
                                    (
                                        $root.goalAmount - parseFloat(balance.usdt.replace(/,/g, ''))
                                    ).toLocaleString(undefined, {
                                        minimumFractionDigits: 2, maximumFractionDigits: 2
                                    }) :
                                    parseFloat(0).toFixed(2)
                                }}
                                USDT remaining...
                            </div>
                            <div v-if="$root.goalProgress === 100" class="va-title text-right">
                                Thank you for your support!
                            </div>
                            <div v-else class="va-title text-right">
                                {{ balance.usdt ? balance.usdt : parseFloat(0).toFixed(2) }}
                                /
                                {{
                                    (
                                        parseFloat($root.goalAmount)
                                    ).toLocaleString(undefined, {
                                        minimumFractionDigits: 2, maximumFractionDigits: 2
                                    })
                                }}
                                USDT
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-white mb-[5px] max-[540px]:mb-[7px] max-[540px]:text-[16px] max-[280px]:text-[15px]">
                            To support the listing of the project on CEX, you can contribute to:
                        </p>
                        <va-input
                        id="octawallet-address"
                        :type="screenWidth <= 540 ? 'textarea' : 'text'"
                        v-model="$root.accountAddress"
                        class="w-full"
                        label="Wallet Address"
                        readonly
                        >
                            <template #appendInner>
                                <va-icon
                                class="hover:text-[#6F158D!important]"
                                title="Copy"
                                name="content_copy"
                                size="small"
                                color="#6B158D"
                                @click="$root.copyWalletAddress()"
                                />
                            </template>
                        </va-input>
                        <div class="my-[5px] max-[540px]:my-[4px]">
                            <div class="inline-flex float-left">
                                <a
                                id="linktree-badge"
                                title="Linktree"
                                href="https://linktr.ee/octaspace"
                                >
                                    <va-badge
                                    text="Linktree"
                                    color="#34B34A"
                                    class="mr-[7px] max-[540px]:mr-[6px]"
                                    />
                                </a>
                            </div>
                            <div class="inline-flex float-right">
                                <a
                                id="octa-badge"
                                title="Octaexplorer"
                                href="https://explorer.octa.space/address/0x325E5411a63fE64603EC881ce0F6AB78235E8C61"
                                >
                                    <va-badge
                                    text="OCTA"
                                    color="#6F185D"
                                    class="ml-[7px] max-[540px]:ml-[6px]"
                                    />
                                </a>
                                <a
                                id="bsc-badge"
                                title="Bscscan"
                                href="https://bscscan.com/address/0x325E5411a63fE64603EC881ce0F6AB78235E8C61"
                                >
                                    <va-badge
                                    text="USDT(BSC)"
                                    color="#F0B90B"
                                    class="ml-[7px] max-[540px]:ml-[6px]"
                                    />
                                </a>
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
    font-family: 'Jost', sans-serif;
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
a#linktree-badge .va-badge__text-wrapper:hover {
    border-color: #3FD959!important;
    background-color: #3FD959!important;
}
a#octa-badge .va-badge__text-wrapper:hover {
    border-color: #95207D!important;
    background-color: #95207D!important;
}
a#bsc-badge .va-badge__text-wrapper:hover {
    border-color: #FFD40B!important;
    background-color: #FFD40B!important;
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
                usdt: null
            },
            screenWidth: window.innerWidth,
        };
    },
    components: {
        ConfettiExplosion
    },
    mounted() {
        (this.balance.octa === null) && axios({
            method: 'GET',
            type: 'JSON',
            url: 'https://explorer.octa.space/api?module=account&action=balance&address=' + this.$root.accountAddress
        }).then(response => {
            if (response.data.status == 1) {
                const octa = this.$root.convertWeiToUnit(response.data.result);

                this.balance.octa = parseFloat(octa).toLocaleString(undefined, {
                    minimumFractionDigits: 2, maximumFractionDigits: 2
                });
            } else {
                this.$root.prompt(response.data.message);

                this.balance.octa = parseFloat(0).toLocaleString(undefined, {
                    minimumFractionDigits: 2, maximumFractionDigits: 2
                });
            }
        }).catch(error => {
            this.$root.prompt(error.response);

            this.balance.octa = parseFloat(0).toLocaleString(undefined, {
                minimumFractionDigits: 2, maximumFractionDigits: 2
            });
        });

        (this.balance.usdt === null) && axios({
            method: 'POST',
            type: 'JSON',
            url: '/bscscan',
            data: {
                contractAddress: this.$root.usdtBEP20ContractAddress,
                address: this.$root.accountAddress,
            }
        }).then(response => {
            if (response.data.status == 1) {
                const usdt = this.$root.convertWeiToUnit(response.data.result);

                this.balance.usdt = parseFloat(usdt).toLocaleString(undefined, {
                    minimumFractionDigits: 2, maximumFractionDigits: 2
                });

                this.$root.goalProgress = parseFloat((
                        parseFloat(this.balance.usdt.replace(/,/g, '')) / this.$root.goalAmount * 100
                    ).toFixed(2)
                );
            } else {
                this.$root.prompt(response.data.message);

                this.balance.usdt = parseFloat(0).toLocaleString(undefined, {
                    minimumFractionDigits: 2, maximumFractionDigits: 2
                });
            }
        }).catch(error => {
            this.$root.prompt(error.response);

            this.balance.usdt = parseFloat(0).toLocaleString(undefined, {
                minimumFractionDigits: 2, maximumFractionDigits: 2
            });
        });
    },
}
</script>
