<template>
    <div class="modal fade" tabindex="-1" id="modal-activity-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ mode === 'NEW' ? 'Nova atividade' : 'Alteração de atividade' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': !form.name.valid }" id="titulo" v-model="form.name.value" placeholder="Informe o título da atividade.">
                            <div class="invalid-feedback">{{ form.name.message }}</div>
                        </div>

                        <div class="col-12">
                            <label for="sector" class="form-label">Setor</label>
                            <select type="text" class="form-select" :class="{ 'is-invalid': !form.sector.valid }" id="sector" v-model="form.sector.value">
                                <option v-for="sector in sectors" :key="sector.id" :value="sector">{{ sector.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ form.sector.message }}</div>
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
            activityId: {
                type: Number,
                default: () => -1
            },
        },
        data() {
            return {
                sectors: [],
                loadingSaveRequest: false,
                form: {
                    name: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                    sector: {
                        value: '',
                        valid: true,
                        message: ''
                    },
                }
            }
        },
        mounted() {
            $("#modal-activity-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-activity-new-edit").modal('show');

            if (this.mode === 'NEW') {
                this.create();
            } else {
                this.edit();
            }
        },
        methods: {
            create() {
                axios.get(route('activities.create'))
                    .then(res => {
                        this.sectors = res.data.sectors;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            edit() {
                axios.get(route('activities.edit', { id: this.activityId }))
                    .then(res => {
                        this.sectors = res.data.sectors;
                        this.form.name.value = res.data.activity.name;
                        this.sectors.forEach(element => {
                            if (res.data.activity.sector_id === element.id) {
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
                axios.post(route('activities.store'), this.payloadToStore())
                    .then(res => {
                        this.$emit('inserted');

                        $("#modal-activity-new-edit").modal('hide');

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
                            title: 'Ops! Não foi possível salvar atividade.',
                            showConfirmButton: true,
                        })
                    })
                    .finally(() => {
                        this.loadingSaveRequest = false;
                    });
            },
            update() {
                axios.put(route('activities.update', { id: this.activityId }), this.payloadToStore())
                    .then(res => {
                        this.$emit('updated');

                        $("#modal-activity-new-edit").modal('hide');

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
                            title: 'Ops! Não foi possível salvar atividade.',
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
                }
            }
        }
    }
</script>
