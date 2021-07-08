<template>
    <div class="card card-hover shadow-sm" @click="modalOccurrenceShow = true">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <span class="fs-7 fw-bold">{{ occurrence.title }}</span>
                </div>

                <div v-if="occurrence.transition.user" class="col-auto">
                    <Avatar :username="occurrence.transition.user.name" :size="25" class="bg-gray-200 border-gray-600 text-gray-600 border" />
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
                            <span class="fs-8">{{ dateFormat(occurrence.transition.doc_due_date) }}</span>
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

        <ModalOccurrenceInvoice v-if="modalOccurrenceShow" @modal-closed="modalOccurrenceClosed" @open-modal-task-new-edit="openModalTaskNewEdit" :style="{'z-index': modalTaskNewEdit ? 1 : 1060}" :occurrence-id="occurrence.id" ref="modalOccurrenceInvoice" />
        <ModalTaskNewEdit v-if="modalTaskNewEdit" @modal-closed="modalTaskNewEditClosed" :occurrence-id="occurrence.id" :task-id="taskIdToEdit" :mode="taskIdToEdit ? 'EDIT' : 'NEW'" />
    </div>
</template>

<script>
    export default {
        props: {
            occurrence: Object
        },
        data() {
            return {
                modalOccurrenceShow: false,
                modalTaskNewEdit: false,
                taskIdToEdit: null,
            }
        },
        mounted() {
            Echo.channel('occurrences_occurrence')
                .listen('.occurrence.stepchanged', (e) => {
                    console.log('meu evento aqui 5');
                });
        },
        methods: {
            dateFormat(date) {
                return moment(date).format('DD/MM/YYYY') + ' às ' + moment(date).format('HH:MM:SS');
            },
            openModalTaskNewEdit(event) {
                if (event && event.taskId) {
                    this.taskIdToEdit = event.taskId;
                }
                this.modalTaskNewEdit = true;
            },
            modalOccurrenceClosed() {
                this.modalOccurrenceShow = false;
            },
            modalTaskNewEditClosed() {
                this.modalTaskNewEdit = false;
                this.taskIdToEdit = null;
                this.$refs.modalOccurrenceInvoice.$el.focus();
            }
        }
    }
</script>

<style scoped>
    .card-hover {
        cursor: pointer;
    }
</style>
