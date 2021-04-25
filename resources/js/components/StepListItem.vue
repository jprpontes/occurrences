<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <span>Etapa 1</span>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <span class="mx-1">Setor:</span>
                    <span class="badge bg-gray-500">Setor 1</span>
                </div>

                <div class="col-auto d-flex align-items-center pe-0">
                    <button class="btn btn-sm btn-outline-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Mover para cima"><i class="mdi mdi-arrow-up p-0"></i></button>
                </div>

                <div class="col-auto d-flex align-items-center ps-1">
                    <button class="btn btn-sm btn-outline-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Mover para baixo"><i class="mdi mdi-arrow-down p-0"></i></button>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-primary btn-icon" @click="modalStepNewEdit = true"><i class="mdi mdi-pencil"></i>Editar</button>
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
