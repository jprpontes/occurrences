<template>
    <div class="container">
        <div class="row">
            <div class="col d-flex align-items-center mb-3">
                <h1 class="m-0 d-flex align-items-center"><i class="mdi mdi-account-group pe-2"></i>Usuários</h1>
            </div>
            <div class="col-auto d-flex align-items-center mb-3">
                <button class="btn btn-primary btn-icon" @click="modalUserNewEdit = true"><i class="mdi mdi-plus"></i>Novo</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-5">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                    <input type="text" class="form-control" v-model="searchValue" placeholder="Busque pelo nome ou email do usuário." @keypress.enter="search">
                </div>
            </div>
        </div>

        <UserList ref="userList" />
        <ModalUserNewEdit v-if="modalUserNewEdit" @modal-closed="modalUserNewEditClosed" @inserted="userInserted" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modalUserNewEdit: false,
                searchValue: ''
            }
        },
        mounted() {

        },
        methods: {
            modalUserNewEditClosed() {
                this.modalUserNewEdit = false;
            },
            userInserted() {
                this.$refs.userList.refresh();
            },
            search() {
                this.$refs.userList.search(this.searchValue);
            }
        }
    }
</script>
