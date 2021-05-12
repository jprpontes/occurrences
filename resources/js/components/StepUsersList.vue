<template>
    <div>
        <StepUsersListItem class="mb-1" v-for="user in users" :key="user.id" :user="user" @add-to-step="$emit('add-to-step', $event)" />

        <div class="row" v-if="verMais">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-link my-3" @click="paginate">Ver mais...</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            stepId: Number
        },
        data() {
            return {
                users: [],
                verMais: true,
                searchValue: ''
            }
        },
        mounted() {
            this.paginate();
        },
        methods: {
            paginate() {
                axios.get(route('usersteps.getusers', { offset: this.users.length, search: this.searchValue, stepId: this.stepId }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.users = this.users.concat(res.data.users);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            refresh() {
                axios.get(route('usersteps.getusers', { offset: 0, search: this.searchValue, stepId: this.stepId }))
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
                axios.get(route('usersteps.getusers', { offset: 0, search: this.searchValue, stepId: this.stepId }))
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
