<template>
    <div class="container">
        <div class="row">
            <div class="col d-flex align-items-center mb-3">
                <h1 class="m-0">SETORES</h1>
            </div>
            <div class="col-auto d-flex align-items-center mb-3">
                <button class="btn btn-primary" @click="modalSectorNewEdit = true">Novo</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-5">
                <div class="input-group mb-3">
                    <span class="input-group-text">Pesquisar</span>
                    <input type="text" class="form-control" placeholder="Busque pelo nome do setor.">
                </div>
            </div>
        </div>

        <SectorList />
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

        }
    }
</script>
