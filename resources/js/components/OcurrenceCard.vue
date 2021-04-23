<template>
    <div class="card card-hover" @click="openModalOcurrence">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <span class="fs-7 fw-bold">CASA-BRUNO JAVIER AVILA O.</span>
                </div>

                <div class="col-auto">
                    <Avatar username="Fulano de Tal" :size="25" class="bg-gray-200 border-gray-600 text-gray-600 border" />
                </div>
            </div>

            <div class="row text-gray-600">
                <div class="col-auto">
                    <div class="row">
                        <div class="col-auto pe-1 lh-sm">
                            <span class="fs-8 fw-bold">Expectativa:</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto pe-1 lh-sm">
                            <span class="fs-8 fw-bold">Última atividade:</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto pe-1 lh-sm">
                            <span class="fs-8 fw-bold">Próxima atividade:</span>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        <div class="col-auto ps-0 lh-sm">
                            <span class="fs-8">01/01/2022 00:00:00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ps-0 lh-sm">
                            <span class="fs-8">01/01/2022 00:00:00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ps-0 lh-sm">
                            <span class="fs-8">01/01/2022 00:00:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ModalOcurrenceInvoice v-if="modalOcurrenceShow" @modal-closed="modalOcurrenceShow = false" />
    </div>
</template>

<script>
    import Avatar from 'vue-avatar';
    export default {
        components: {
            Avatar
        },
        data() {
            return {
                modalOcurrenceShow: false
            }
        },
        mounted() {

        },
        methods: {
            openModalOcurrence() {
                this.modalOcurrenceShow = true;
            }
        }
    }
</script>

<style scoped>
    .card-hover {
        cursor: pointer;
    }
</style>
