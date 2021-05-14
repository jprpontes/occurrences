<template>
    <div class="modal fade" tabindex="-1" id="modal-step-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title">{{ mode === 'NEW' ? 'Nova etapa' : 'Alteração de etapa' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="row">
                        <div class="col-12 px-0 mb-3">
                            <ul class="nav nav-tabs px-2">
                                <li class="nav-item">
                                    <a class="nav-link" :class="{ active: tab === 'GERAL' }" @click="tab = 'GERAL'" aria-current="page" style="cursor: pointer">Geral</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" :class="{ active: tab === 'USUARIO' }" @click="tab = 'USUARIO'" style="cursor: pointer">
                                        Usuários permitidos
                                        <span class="badge bg-gray-200 text-gray-600 border-gray-600 border ms-2">{{ stepUsers.length }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div v-if="tab === 'GERAL'" class="row">
                        <div class="col-12 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': !form.name.valid }" id="nome" v-model="form.name.value" placeholder="Informe o nome da etapa.">
                            <div class="invalid-feedback">{{ form.name.message }}</div>
                        </div>

                        <div class="col-12">
                            <label for="tp-doc" class="form-label">Setor</label>
                            <select type="text" class="form-select" :class="{ 'is-invalid': !form.sector.valid }" id="tp-doc" v-model="form.sector.value">
                                <option v-for="sector in sectors" :key="sector.id" :value="sector">{{ sector.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ form.sector.message }}</div>
                        </div>
                    </div>
                    <div v-else-if="tab === 'USUARIO'" class="row">
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                                <input type="text" class="form-control" v-model="searchUsersValue" placeholder="Busque usuários para adicionar à lista." @keypress.enter="searchUsers">
                            </div>
                        </div>

                        <div class="col-12">
                            <StepUsersList ref="stepUsersList" @add-user-to-step="addUserToStep" @remove-user-from-step="removeUserFromStep" :step-id="stepId" :step-users="stepUsers" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="save" type="button" class="btn btn-primary btn-icon" :disabled="loadingSaveRequest">
                        <div v-if="loadingSaveRequest" class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <div v-else>
                            <i class="mdi mdi-check"></i>Salvar
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            mode: {
                type: String,
                default: () => 'NEW' //NEW | EDIT,
            },
            stepId: {
                type: Number,
                default: () => -1
            },
        },
        data() {
            return {
                sectors: [],
                stepUsers: [],
                loadingSaveRequest: false,
                tab: 'GERAL', //USUARIOS
                form: {
                    name: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                    sector: {
                        value: null,
                        valid: true,
                        message: ''
                    },
                },
                searchUsersValue: ''
            }
        },
        mounted() {
            $("#modal-step-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-step-new-edit").modal('show');

            if (this.mode === 'NEW') {
                this.create();
            } else {
                this.edit();
            }
        },
        methods: {
            addUserToStep(user) {
                this.stepUsers.push(user.id);
            },
            removeUserFromStep(user) {
                var index = [];
                this.stepUsers.forEach((element, i) => {
                    if (element === user.id) {
                        index.push(i);
                    }
                });
                index.forEach(element => {
                    this.stepUsers.splice(element, 1);
                });
            },
            create() {
                axios.get(route('steps.create'))
                    .then(res => {
                        this.sectors = res.data.sectors;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            edit() {
                axios.get(route('steps.edit', { id: this.stepId }))
                    .then(res => {
                        this.sectors = res.data.sectors;
                        this.stepUsers = res.data.stepUsers;
                        this.form.name.value = res.data.step.name;
                        this.sectors.forEach(element => {
                            if (res.data.step.sector_id === element.id) {
                                this.form.sector.value = element;
                            }
                        });
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            save() {
                if (!this.formValidate()) {
                    return;
                }
                this.formValidateReset();

                this.loadingSaveRequest = true;

                if (this.mode === 'NEW') {
                    this.insert();
                } else {
                    this.update();
                }
            },
            insert() {
                axios.post(route('steps.store'), this.payloadToStore())
                    .then(res => {
                        this.$emit('inserted');

                        $("#modal-step-new-edit").modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Salvo com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Ops! Não foi possível salvar etapa.',
                            showConfirmButton: true,
                        })
                    })
                    .finally(() => {
                        this.loadingSaveRequest = false;
                    });
            },
            update() {
                axios.put(route('steps.update', { id: this.stepId }), this.payloadToStore())
                    .then(res => {
                        this.$emit('updated');

                        $("#modal-step-new-edit").modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Salvo com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Ops! Não foi possível salvar etapa.',
                            showConfirmButton: true,
                        })
                    })
                    .finally(() => {
                        this.loadingSaveRequest = false;
                    });
            },
            formValidate() {
                var isValid = true;

                if (!this.form.name.value) {
                    isValid = false;
                    this.form.name.valid = false;
                    this.form.name.message = 'Informe um nome.';
                } else {
                    this.form.name.valid = true;
                    this.form.name.message = '';
                }

                if (!this.form.sector.value) {
                    isValid = false;
                    this.form.sector.valid = false;
                    this.form.sector.message = 'Selecione um setor.';
                } else {
                    this.form.sector.valid = true;
                    this.form.sector.message = '';
                }

                return isValid;
            },
            formValidateReset() {
                this.form.name.valid = true;
                this.form.name.message = '';
                this.form.sector.valid = true;
                this.form.sector.message = '';
            },
            payloadToStore() {
                return {
                    name: this.form.name.value,
                    sector_id: this.form.sector.value.id,
                    step_users: this.stepUsers
                }
            },
            searchUsers() {
                this.$refs.stepUsersList.search(this.searchUsersValue);
            }
        }
    }
</script>
