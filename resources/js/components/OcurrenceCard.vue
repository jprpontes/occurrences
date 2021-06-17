<template>
    <div class="card card-hover shadow-sm" @click="modalOcurrenceShow = true">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <span class="fs-7 fw-bold">CASA-BRUNO JAVIER AVILA O.</span>
                </div>

                <div v-if="ocurrence.transition.user" class="col-auto">
                    <Avatar :username="ocurrence.transition.user.name" :size="25" class="bg-gray-200 border-gray-600 text-gray-600 border" />
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

        <ModalOcurrenceInvoice v-if="modalOcurrenceShow" @modal-closed="modalOcurrenceClosed" @open-modal-task-new-edit="modalTaskNewEdit = true" :style="{'z-index': modalTaskNewEdit ? 1 : 1060}" :ocurrence-id="ocurrence.id" ref="modalOcurrenceInvoice" />
        <ModalTaskNewEdit v-if="modalTaskNewEdit" @modal-closed="modalTaskNewEditClosed" />
    </div>
</template>

<script>
    export default {
        props: {
            ocurrence: Object
        },
        data() {
            return {
                modalOcurrenceShow: false,
                modalTaskNewEdit: false
            }
        },
        mounted() {

        },
        methods: {
            modalOcurrenceClosed() {
                this.modalOcurrenceShow = false;
            },
            modalTaskNewEditClosed() {
                this.modalTaskNewEdit = false;
                this.$refs.modalOcurrenceInvoice.$el.focus();
            }
        }
    }
</script>

<style scoped>
    .card-hover {
        cursor: pointer;
    }
</style>
