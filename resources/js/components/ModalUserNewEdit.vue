<template>
    <div class="modal fade" tabindex="-1" id="modal-user-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': !form.name.valid }" id="nome" v-model="form.name.value" placeholder="Informe o nome do usuário.">
                            <div class="invalid-feedback">{{ form.name.message }}</div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': !form.email.valid }" id="email" v-model="form.email.value" placeholder="Informe o email do usuário.">
                            <div class="invalid-feedback">{{ form.email.message }}</div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="tp-doc" class="form-label">Setor</label>
                            <select type="text" class="form-control" :class="{ 'is-invalid': !form.sector.valid }" id="tp-doc" v-model="form.sector.value">
                                <option value="">Nenhum setor</option>
                                <option v-for="sector in sectors" :key="sector.id" :value="sector">{{ sector.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ form.sector.message }}</div>
                        </div>

                        <div class="col-12 d-flex align-items-center mb-3">
                            <div class="form-check me-2">
                                <input type="radio" name="radio-senha-op" id="radio-senha-op1" class="form-check-input" value="RANDOM" v-model="passwordMode">
                                <label for="radio-senha-op1" class="form-check-label">Gerar senha aleatório</label>
                            </div>
                            <div class="form-check mx-2">
                                <input type="radio" name="radio-senha-op" id="radio-senha-op2" class="form-check-input" value="INFORMAR" v-model="passwordMode">
                                <label for="radio-senha-op2" class="form-check-label">Informar senha</label>
                            </div>
                        </div>

                        <div class="col-12 mb-3" v-if="passwordMode === 'INFORMAR'">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" :class="{ 'is-invalid': !form.password.valid }" id="senha" v-model="form.password.value" placeholder="Informe uma senha com no mínimo 8 digitos." min="8">
                            <div class="invalid-feedback">{{ form.password.message }}</div>
                        </div>

                        <div class="col-12 mb-3" v-if="passwordMode === 'INFORMAR'">
                            <label for="senha_repeat" class="form-label">Repita a Senha</label>
                            <input type="password" class="form-control" :class="{ 'is-invalid': !form.passwordRepeat.valid }" id="senha_repeat" v-model="form.passwordRepeat.value" placeholder="Informe a senha novamente." min="8">
                            <div class="invalid-feedback">{{ form.passwordRepeat.message }}</div>
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
        data() {
            return {
                passwordMode: 'RANDOM',
                sectors: [],
                loadingSaveRequest: false,
                form: {
                    name: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                    email: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                    sector: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                    password: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                    passwordRepeat: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                }
            }
        },
        mounted() {
            $("#modal-user-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-user-new-edit").modal('show');

            this.init();
        },
        methods: {
            init() {
                axios.get(route('users.create'))
                    .then(res => {
                        this.sectors = res.data.sectors;
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

                axios.post(route('users.store'), this.payloadToStore())
                    .then(res => {
                        $("#modal-user-new-edit").modal('hide');

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
                            title: 'Ops! Não foi possível salvar usuário.',
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

                if (!this.form.email.value) {
                    isValid = false;
                    this.form.email.valid = false;
                    this.form.email.message = 'Informe um email.';
                } else {
                    this.form.email.valid = true;
                    this.form.email.message = '';
                }

                if (!this.form.sector.value) {
                    isValid = false;
                    this.form.sector.valid = false;
                    this.form.sector.message = 'Selecione um setor.';
                } else {
                    this.form.sector.valid = true;
                    this.form.sector.message = '';
                }

                if (this.passwordMode === 'INFORMAR' && !this.form.password.value) {
                    isValid = false;
                    this.form.password.valid = false;
                    this.form.password.message = 'Informe um password.';
                } else {
                    this.form.password.valid = true;
                    this.form.password.message = '';
                }

                if (this.passwordMode === 'INFORMAR' && !this.form.passwordRepeat.value) {
                    isValid = false;
                    this.form.passwordRepeat.valid = false;
                    this.form.passwordRepeat.message = 'Repita a senha.';
                } else {
                    this.form.passwordRepeat.valid = true;
                    this.form.passwordRepeat.message = '';
                }

                if (this.passwordMode === 'INFORMAR' && this.form.password.value !== this.form.passwordRepeat.value) {
                    isValid = false;
                    this.form.passwordRepeat.valid = false;
                    this.form.passwordRepeat.message = 'As senhas não são iguais.';
                } else {
                    this.form.passwordRepeat.valid = true;
                    this.form.passwordRepeat.message = '';
                }

                return isValid;
            },
            formValidateReset() {
                this.form.name.valid = true;
                this.form.name.message = '';

                this.form.email.valid = true;
                this.form.email.message = '';

                this.form.sector.valid = true;
                this.form.sector.message = '';

                this.form.password.valid = true;
                this.form.password.message = '';

                this.form.passwordRepeat.valid = true;
                this.form.passwordRepeat.message = '';
            },
            payloadToStore() {
                return {
                    name: this.form.name.value,
                    email: this.form.email.value,
                    sector_id: this.form.sector.value.id,
                    password: this.form.password.value,
                    passwordMode: this.passwordMode
                }
            }
        }
    }
</script>
