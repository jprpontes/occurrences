<template>
    <div class="container">
        <div class="row">
            <div class="col d-flex align-items-center mb-3">
                <h1 class="m-0 d-flex align-items-center"><i class="mdi mdi-family-tree pe-2"></i>Setores</h1>
            </div>
            <div class="col-auto d-flex align-items-center mb-3">
                <button class="btn btn-primary btn-icon" @click="modalSectorNewEdit = true"><i class="mdi mdi-plus"></i>Novo</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-5">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                    <input type="text" class="form-control" v-model="searchValue" placeholder="Busque pelo nome do setor." @keypress.enter="search">
                </div>
            </div>
        </div>

        <SectorList ref="sectorList" />
        <ModalSectorNewEdit v-if="modalSectorNewEdit" @modal-closed="modalSectorNewEditClosed" @inserted="sectorInserted" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modalSectorNewEdit: false,
                searchValue: ''
            }
        },
        mounted() {

        },
        methods: {
            modalSectorNewEditClosed() {
                this.modalSectorNewEdit = false;
            },
            sectorInserted() {
                this.$refs.sectorList.refresh();
            },
            search() {
                this.$refs.sectorList.search(this.searchValue);
            }
        }
    }
</script>
