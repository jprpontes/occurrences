<template>
    <div>
        <UserListItem class="mb-1" v-for="user in users" :key="user.id" :user="user" @edit="userEdit" />

        <div class="row" v-if="verMais">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-link my-3" @click="paginate">Ver mais...</button>
            </div>
        </div>

        <ModalUserNewEdit v-if="modalUserNewEdit" @modal-closed="modalUserNewEdit = false" :mode="'EDIT'" :user-id="userSelected.id" @updated="userUpdated" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                verMais: true,
                userSelected: null,
                modalUserNewEdit: false,
                searchValue: ''
            }
        },
        mounted() {
            this.paginate();
        },
        methods: {
            userUpdated() {
                this.refresh();
            },
            userEdit(user) {
                this.modalUserNewEdit = true;
                this.userSelected = user;
            },
            paginate() {
                axios.get(route('users.getusers', { offset: this.users.length, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.users = this.users.concat(res.data.users);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            refresh() {
                axios.get(route('users.getusers', { offset: 0, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.users = this.users = res.data.users;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            search(value) {
                this.searchValue = value;
                axios.get(route('users.getusers', { offset: 0, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.users = this.users = res.data.users;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            }
        }
    }
</script>
