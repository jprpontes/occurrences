<template>
    <div class="container">
        <div class="row">
            <div class="col d-flex align-items-center mb-3">
                <h1 class="m-0">ETAPAS</h1>
            </div>
            <div class="col-auto d-flex align-items-center mb-3">
                <button class="btn btn-primary" @click="modalStepNewEdit = true">Novo</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-5">
                <div class="input-group mb-3">
                    <span class="input-group-text">Pesquisar</span>
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
