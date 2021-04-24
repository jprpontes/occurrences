<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <span>Etapa 1</span>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-primary" @click="modalStepNewEdit = true">Editar</button>
                </div>
            </div>
        </div>

        <ModalStepNewEdit v-if="modalStepNewEdit" @modal-closed="modalStepNewEdit = false" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modalStepNewEdit: false
            }
        },
        mounted() {

        }
    }
</script>
