<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col-auto d-flex align-items-center">
                    <Avatar username="User" :size="30" class="bg-gray-200 border-gray-600 text-gray-600 border"></Avatar>
                </div>

                <div class="col d-flex align-items-center">
                    <span>User 1</span>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <span class="mx-1">Setor:</span>
                    <span class="badge bg-gray-500">Setor 1</span>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-primary btn-icon" @click="modalUserNewEdit = true"><i class="mdi mdi-pencil"></i>Editar</button>
                </div>
            </div>
        </div>

        <ModalUserNewEdit v-if="modalUserNewEdit" @modal-closed="modalUserNewEdit = false" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modalUserNewEdit: false,
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
