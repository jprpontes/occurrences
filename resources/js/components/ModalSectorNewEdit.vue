<template>
    <div class="modal fade" tabindex="-1" id="modal-sector-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ mode === 'NEW' ? 'Novo setor' : 'Alteração de setor' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': !form.name.valid }" id="nome" v-model="form.name.value" placeholder="Informe o nome do setor.">
                            <div class="invalid-feedback">{{ form.name.message }}</div>
                        </div>

                        <div class="col-12">
                            <label for="tp-doc" class="form-label">Tipo de documento</label>
                            <select type="text" class="form-select" :class="{ 'is-invalid': !form.documentType.valid }" id="tp-doc" v-model="form.documentType.value">
                                <option v-for="documentType in documentTypeList" :key="documentType.id" :value="documentType">{{ documentType.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ form.documentType.message }}</div>
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
            sectorId: {
                type: Number,
                default: () => -1
            },
        },
        data() {
            return {
                documentTypeList: [],
                loadingSaveRequest: false,
                form: {
                    name: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                    documentType: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                }
            }
        },
        mounted() {
            $("#modal-sector-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-sector-new-edit").modal('show');

            if (this.mode === 'NEW') {
                this.create();
            } else {
                this.edit();
            }
        },
        methods: {
            create() {
                axios.get(route('sectors.create'))
                    .then(res => {
                        this.documentTypeList = res.data.documentTypeList;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            edit() {
                axios.get(route('sectors.edit', { id: this.sectorId }))
                    .then(res => {
                        this.documentTypeList = res.data.documentTypeList;
                        this.form.name.value = res.data.sector.name;
                        this.documentTypeList.forEach(element => {
                            if (res.data.sector.document_type === element.id) {
                                this.form.documentType.value = element;
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
                axios.post(route('sectors.store'), this.payloadToStore())
                    .then(res => {
                        this.$emit('inserted');

                        $("#modal-sector-new-edit").modal('hide');

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
                            title: 'Ops! Não foi possível salvar setor.',
                            showConfirmButton: true,
                        })
                    })
                    .finally(() => {
                        this.loadingSaveRequest = false;
                    });
            },
            update() {
                axios.put(route('sectors.update', { id: this.sectorId }), this.payloadToStore())
                    .then(res => {
                        this.$emit('updated');

                        $("#modal-sector-new-edit").modal('hide');

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
                            title: 'Ops! Não foi possível salvar setor.',
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

                if (!this.form.documentType.value) {
                    isValid = false;
                    this.form.documentType.valid = false;
                    this.form.documentType.message = 'Selecione um tipo de documento.';
                } else {
                    this.form.documentType.valid = true;
                    this.form.documentType.message = '';
                }

                return isValid;
            },
            formValidateReset() {
                this.form.name.valid = true;
                this.form.name.message = '';
                this.form.documentType.valid = true;
                this.form.documentType.message = '';
            },
            payloadToStore() {
                return {
                    name: this.form.name.value,
                    document_type: this.form.documentType.value.id,
                }
            }
        }
    }
</script>
