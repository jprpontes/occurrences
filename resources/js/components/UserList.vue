<template>
    <div>
        <UserListItem class="mb-1" v-for="user in users" :key="user.id" :user="user" />

        <div class="row" v-if="verMais">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-link my-3" @click="paginate">Ver mais...</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                verMais: true
            }
        },
        mounted() {
            this.paginate();
        },
        methods: {
            paginate() {
                axios.get(route('users.pagination', { 'offset': this.users.length }))
                .then(res => {
                    this.users = this.users.concat(res.data.users);
                    this.verMais = res.data.verMais;
                })
                .catch(err => {
                    console.error(err);
                });
            },
            refresh() {
                this.users = [];
                this.paginate();
            }
        }
    }
</script>
