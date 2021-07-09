<template>
    <div class="modal fade" tabindex="-1" id="modal-occurrence-invoice">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row m-0">
                    <div class="col p-3">
                        <!-- <div class="row">
                            <div class="col-12">
                                <h5 for="descricao">Descrição</h5>
                            </div>

                            <div class="col-12">
                                <textarea type="text" class="form-control mt-1 mb-4 col-12" id="descricao" style="resize: none;" readonly>Realizar cobrança referente ao contrato X.</textarea>
                            </div>
                        </div> -->

                        <div class="row mb-2">
                            <div class="col d-flex align-items-center">
                                <h5>Histórico</h5>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-primary btn-sm btn-icon" @click="openModalTaskNewEdit"><i class="mdi mdi-plus"></i>Nova tarefa</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <TimelineOccurrence :occurrence-id="occurrenceId" />
                            </div>
                        </div>
                    </div>
                    <div class="col bg-gray-100 p-3" style="max-width: 250px">
                        <div class="row">
                            <div class="col-12">
                                <label for="step" class="form-label mb-0 mt-2">Etapa</label>
                                <select class="form-select" id="step" v-model="step" @change="stepChange">
                                    <option v-for="stepsOption in stepsOptions" :value="stepsOption" :key="stepsOption.id">{{ stepsOption.name }}</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="responsible" class="form-label mb-0 mt-2">Responsável</label>
                                <ResponsibleInput :responsible="responsible" @responsible-changed="responsibleChanged" />
                            </div>

                            <div class="col-12">
                                <label for="expectation" class="form-label mb-0 mt-2">Expectativa</label>
                                <input type="text" class="form-control" id="expectation">
                            </div>

                            <div class="col-12">
                                <label class="form-label mb-0 mt-2">Ações</label>
                            </div>

                            <div class="col-12" v-if="!responsible">
                                <button class="btn btn-outline-primary btn-icon col-12 mb-2 justify-content-start" @click="toAssume"><i class="mdi mdi-human-greeting"></i>Assumir</button>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-outline-primary btn-icon col-12 justify-content-start" @click="changeToNextStep"><i class="mdi mdi-ray-start-arrow"></i>Próxima etapa</button>
                            </div>

                            <div class="col-12">
                                <label for="open-occurrences-list" class="form-label mb-0 mt-3">Ocorrências abertas</label>
                                <div class="card" id="open-occurrences-list">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex">
                                            <span class="flex-fill text-center">1</span>
                                            <span class="flex-fill text-center">$10,00</span>
                                        </li>
                                        <li class="list-group-item d-flex">
                                            <span class="flex-fill text-center">1</span>
                                            <span class="flex-fill text-center">$10,00</span>
                                        </li>
                                        <li class="list-group-item d-flex">
                                            <span class="flex-fill text-center">1</span>
                                            <span class="flex-fill text-center">$10,00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            occurrenceId: Number
        },
        data() {
            return {
                stepsOptions: [],
                title: '',
                responsible: null,
                oldResponsible: null,
                step: null,
                oldStep: null,
                expectation: null,
                oldExpectation: null
            }
        },
        mounted() {
            $("#modal-occurrence-invoice").on('hidden.bs.modal', (event) => {
                this.$root.$emit('modal-occurrence-closed');
            })

            $("#modal-occurrence-invoice").modal('show');

            if (this.occurrenceId) {
                this.edit()
                    .then(() => {
                        $('#expectation').on('changeDate', this.expectationChanged);
                    });
            }
            this.getStepsOptions();

            $('#expectation').datepicker({
                language: "pt-BR",
                autoclose: true,
                todayHighlight: true
            });
        },
        methods: {
            openModalTaskNewEdit() {
                this.$root.$emit('open-modal-task-new-edit', { occurrenceId: this.occurrenceId });
            },
            expectationChanged(event) {
                this.expectation = event.date;
                axios.put(route('occurrences.changeexpectation', { id: this.occurrenceId }), { newExpectation: moment(this.expectation).format('YYYY-MM-DD') })
                    .then(res => {

                    })
                    .catch(err => {
                        this.expectation = this.oldExpectation;
                        $('#expectation').off('changeDate');
                        $('#expectation').datepicker("setDate", this.expectation);
                        $('#expectation').on('changeDate', this.expectationChanged);
                    });
            },
            stepChange() {
                axios.put(route('occurrences.changestep', { id: this.occurrenceId }), { newStepId: this.step.id })
                    .then(res => {

                    })
                    .catch(err => {
                        this.step = this.oldStep;
                    });
            },
            changeToNextStep() {
                axios.put(route('occurrences.nextstep', { id: this.occurrenceId }))
                    .then(res => {
                        this.step = res.data.newStep;
                    });
            },
            responsibleChanged(event) {
                this.responsible = event.responsible;

                axios.put(route('occurrences.changeresponsible', { id: this.occurrenceId }), { newResponsibleId: this.responsible ? this.responsible.id : null })
                    .then(res => {

                    })
                    .catch(err => {
                        this.responsible = this.oldResponsible;
                    });
            },
            toAssume() {
                axios.post(route('occurrences.toassume', { id: this.occurrenceId }))
                    .then(res => {
                        this.responsible = res.data.responsible;
                    });
            },
            edit() {
                return axios.get(route('occurrences.edit', { id: this.occurrenceId }))
                    .then(res => {
                        this.title       = res.data.occurrence.title;
                        this.step        = res.data.occurrence.transition.step;
                        this.responsible = res.data.occurrence.transition.user;
                        $('#expectation').datepicker("setDate", moment(res.data.occurrence.transition.doc_due_date, 'YYYY-MM-DD hh:mm:ss').toDate());
                    });
            },
            getStepsOptions() {
                axios.get(route('workspaces.getstepsoptions'))
                    .then(res => {
                        this.stepsOptions = res.data.steps;
                    });
            }
        },
        watch: {
            step(newValue, oldValue) {
                this.oldStep = oldValue;
            },
            responsible(newValue, oldValue) {
                this.oldResponsible = oldValue;
            },
            expectation(newValue, oldValue) {
                this.oldExpectation = oldValue;
            }
        }
    }
</script>
