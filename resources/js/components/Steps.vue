<template>
    <div class="container">
        <div class="row">
            <div class="col d-flex align-items-center mb-3">
                <h1 class="m-0 d-flex align-items-center"><i class="mdi mdi-ray-start-vertex-end pe-2"></i>Etapas</h1>
            </div>
            <div class="col-auto d-flex align-items-center mb-3">
                <button class="btn btn-primary btn-icon" @click="modalStepNewEdit = true"><i class="mdi mdi-plus"></i>Novo</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-5">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                    <input type="text" class="form-control" placeholder="Busque pelo nome da etapa.">
                </div>
            </div>
        </div>

        <StepList />
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
