<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <span>Setor 1</span>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-primary" @click="modalActivities = true">Atividades</button>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-primary btn-icon" @click="modalSectorNewEdit = true"><i class="mdi mdi-pencil"></i>Editar</button>
                </div>
            </div>
        </div>

        <ModalSectorNewEdit v-if="modalSectorNewEdit" @modal-closed="modalSectorNewEdit = false" />
        <ModalActivities v-if="modalActivities" @modal-closed="modalActivities = false" @open-modal-activity-new-edit="modalActivityNewEdit = true" :style="{'z-index': modalActivityNewEdit ? 1 : 1060}" ref="modalActivities" />
        <ModalActivityNewEdit v-if="modalActivityNewEdit" @modal-closed="modalActivityNewEditClosed" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modalSectorNewEdit: false,
                modalActivities: false,
                modalActivityNewEdit: false,
            }
        },
        mounted() {

        },
        methods: {
            modalActivityNewEditClosed() {
                this.modalActivityNewEdit = false;
                this.$refs.modalActivities.$el.focus();
            }
        }
    }
</script>
