<template>
    <div>
        <div class="row">
            <div class="col-12 d-flex align-items-center mb-2">
                <div class="form-check me-2">
                    <input type="radio" name="radio-suf" id="radio-suf-alloweds" class="form-check-input" value="ALLOWEDS" v-model="stepUsersFilter">
                    <label for="radio-suf-random" class="form-check-label">Exibir somente usuários permitidos</label>
                </div>
                <div class="form-check me-2">
                    <input type="radio" name="radio-suf" id="radio-suf-all" class="form-check-input" value="ALL" v-model="stepUsersFilter">
                    <label for="radio-suf-all" class="form-check-label">Exibir todos</label>
                </div>
            </div>
        </div>

        <StepUsersListItem class="mb-1" v-for="user in users" :key="user.id" :user="user" :user-allowed="userAllowed(user)" @add-user-to-step="$emit('add-user-to-step', $event)" @remove-user-from-step="$emit('remove-user-from-step', $event)" />

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
            stepId: Number,
            stepUsers: Array
        },
        data() {
            return {
                users: [],
                verMais: true,
                searchValue: '',
                stepUsersFilter: 'ALLOWEDS',
            }
        },
        mounted() {
            this.paginate();
        },
        watch: {
            stepUsersFilter(value) {
                this.refresh();
            }
        },
        methods: {
            userAllowed(user) {
                let allowed = false;
                this.stepUsers.forEach(element => {
                    if (user.id === element) {
                        allowed = true;
                    }
                });
                return allowed;
            },
            paginate() {
                axios.get(route('usersteps.getusers', { offset: this.users.length, search: this.searchValue, stepId: this.stepId, filter: this.stepUsersFilter }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.users = this.users.concat(res.data.users);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            refresh() {
                axios.get(route('usersteps.getusers', { offset: 0, search: this.searchValue, stepId: this.stepId, filter: this.stepUsersFilter }))
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
                axios.get(route('usersteps.getusers', { offset: 0, search: this.searchValue, stepId: this.stepId, filter: this.stepUsersFilter }))
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
