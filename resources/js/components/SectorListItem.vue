<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <span>Setor 1</span>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-primary">Atividades</button>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-primary btn-icon" @click="modalSectorNewEdit = true"><i class="mdi mdi-pencil"></i>Editar</button>
                </div>
            </div>
        </div>

        <ModalSectorNewEdit v-if="modalSectorNewEdit" @modal-closed="modalSectorNewEdit = false" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modalSectorNewEdit: false
            }
        },
        mounted() {

        },
    }
</script>
