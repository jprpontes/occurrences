<template>
    <div class="modal fade" tabindex="-1" id="modal-task-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ mode === 'NEW' ? 'Nova tarefa' : 'Alteração de tarefa' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="atividade" class="form-label">Atividade</label>
                            <select type="text" class="form-select" :class="{ 'is-invalid': !form.activity.valid }" id="atividade" v-model="form.activity.value">
                                <option v-for="activity in activities" :key="activity.id" :value="activity">{{ activity.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ form.activity.message }}</div>
                        </div>

                        <!-- <div class="col-12 mb-3">
                            <label for="task-data" class="form-label">Data</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': !form.date.valid }" id="task-data" placeholder="__/__/____ __:__:__">
                            <div class="invalid-feedback">{{ form.date.message }}</div>
                        </div> -->

                        <div class="col-12 mb-3">
                            <label for="executor" class="form-label">Executor</label>
                            <select type="text" class="form-select" :class="{ 'is-invalid': !form.user.valid }" id="executor" v-model="form.user.value">
                                <option v-for="user in users" :key="user.id" :value="user">{{ user.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ form.user.message }}</div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea type="text" class="form-control" :class="{ 'is-invalid': !form.anotation.valid }" v-model="form.anotation.value" id="descricao" rows="5" placeholder="Informe uma descrição com no máximo 200 caractéres."></textarea>
                            <div class="invalid-feedback">{{ form.anotation.message }}</div>
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
            taskId: Number,
            occurrenceId: Number,
            mode: {
                type: String,
                default: () => 'NEW' //NEW | EDIT,
            },
        },
        data() {
            return {
                activities: [],
                users: [],
                loadingSaveRequest: false,
                form: {
                    activity: {
                        value: null,
                        valid: true,
                        message: ''
                    },/*
                    date: {
                        value: null,
                        valid: true,
                        message: ''
                    },*/
                    user: {
                        value: null,
                        valid: true,
                        message: ''
                    },
                    anotation: {
                        value: null,
                        valid: true,
                        message: ''
                    },
                }
            }
        },
        mounted() {
            $("#modal-task-new-edit").on('hidden.bs.modal', (event) => {
                this.$root.$emit('modal-task-new-edit-closed');
            })

            $("#modal-task-new-edit").modal('show');

            $('#task-data').datepicker({
                language: "pt-BR",
                autoclose: true,
                todayHighlight: true
            }).on('changeDate', this.taskDateChanged);

            if (this.mode === 'EDIT') {
                this.edit();
            }

            this.getActivities();
            this.getUsers();
        },
        methods: {
            getUsers() {
                axios.get(route('tasks.getusers'))
                    .then(res => {
                        this.users = res.data.users;
                    });
            },
            // taskDateChanged(event) {
            //     this.form.date.value = event.date;
            // },
            edit() {
                axios.get(route('tasks.edit', { id: this.taskId }))
                    .then(res => {
                        this.form.activity.value = res.data.task.activity;
                        // this.form.date.value     = res.data.task.date;
                        this.form.user.value     = res.data.task.user;
                        this.form.anotation.value     = res.data.task.anotation;
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
                axios.post(route('tasks.store'), this.payloadToStore())
                    .then(res => {
                        this.$emit('inserted');

                        $("#modal-task-new-edit").modal('hide');

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
                            title: 'Ops! Não foi possível salvar tarefa.',
                            showConfirmButton: true,
                        })
                    })
                    .finally(() => {
                        this.loadingSaveRequest = false;
                    });
            },
            update() {
                axios.put(route('tasks.update', { id: this.taskId }), this.payloadToUpdate())
                    .then(res => {
                        this.$emit('updated');

                        $("#modal-task-new-edit").modal('hide');

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
                            title: 'Ops! Não foi possível salvar tarefa.',
                            showConfirmButton: true,
                        })
                    })
                    .finally(() => {
                        this.loadingSaveRequest = false;
                    });
            },
            formValidate() {
                var isValid = true;

                if (!this.form.activity.value) {
                    isValid = false;
                    this.form.activity.valid = false;
                    this.form.activity.message = 'Informe uma atividade.';
                } else {
                    this.form.activity.valid = true;
                    this.form.activity.message = '';
                }

                // if (!this.form.date.value) {
                //     isValid = false;
                //     this.form.date.valid = false;
                //     this.form.date.message = 'Informe uma data.';
                // } else {
                //     this.form.date.valid = true;
                //     this.form.date.message = '';
                // }

                if (!this.form.user.value) {
                    isValid = false;
                    this.form.user.valid = false;
                    this.form.user.message = 'Selecione um executor.';
                } else {
                    this.form.user.valid = true;
                    this.form.user.message = '';
                }

                return isValid;
            },
            formValidateReset() {
                this.form.activity.valid = true;
                this.form.activity.message = '';
                // this.form.date.valid = true;
                // this.form.date.message = '';
                this.form.user.valid = true;
                this.form.user.message = '';
            },
            payloadToStore() {
                return {
                    occurrence_id: this.occurrenceId,
                    activity_id: this.form.activity.value.id,
                    // date: this.form.date.value,
                    user_id: this.form.user.value.id,
                    anotation: this.form.anotation.value,
                }
            },
            payloadToUpdate() {
                return {
                    activity_id: this.form.activity.value.id,
                    // date: this.form.date.value,
                    user_id: this.form.user.value.id,
                    anotation: this.form.anotation.value,
                }
            },
            getActivities() {
                axios.get(route('tasks.getactivities'))
                    .then(res => {
                        this.activities = res.data.activities;
                    });
            }
        }
    }
</script>
