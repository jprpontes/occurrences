<template>
    <div class="modal fade" tabindex="-1" id="modal-ocurrence-invoice">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CASA-BRUNO JAVIER AVILA O.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row m-0">
                    <div class="col p-3">
                        <div class="row">
                            <div class="col-12">
                                <p class="mt-1 mb-4">
                                    Realizar cobrança referente ao contrato X.
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col d-flex align-items-center">
                                <span>Histórico</span>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-sm px-2 py-0">+</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-1" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <TimelineOcurrenceInvoice />
                            </div>
                        </div>
                    </div>
                    <div class="col bg-gray-200 p-3" style="max-width: 250px">
                        <div class="row">
                            <div class="col-12">
                                <label for="step" class="form-label mb-0 mt-2 fs-8">Etapa</label>
                                <select class="form-control" id="step">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="responsible" class="form-label mb-0 mt-2 fs-8">Responsável</label>
                                <input type="text" class="form-control" id="responsible">
                            </div>

                            <div class="col-12">
                                <label for="expectation" class="form-label mb-0 mt-2 fs-8">Expectativa</label>
                                <input type="text" class="form-control" id="expectation">
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary col-12">Assumir</button>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary col-12 mt-3">Próxima etapa</button>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary col-12 mt-3">Histórico de ocorrências</button>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12">
                                <label for="open-ocurrences-list" class="form-label mb-0 fs-8">Ocorrências abertas</label>
                                <div class="card" id="open-ocurrences-list">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">An item</li>
                                        <li class="list-group-item">A second item</li>
                                        <li class="list-group-item">A third item</li>
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
import TimelineOcurrenceInvoice from './TimelineOcurrenceInvoice.vue';
    export default {
    components: { TimelineOcurrenceInvoice },
        mounted() {
            $("#modal-ocurrence-invoice").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-ocurrence-invoice").modal('show');
        },
    }
</script>
