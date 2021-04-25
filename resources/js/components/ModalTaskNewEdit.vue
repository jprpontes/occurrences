<template>
    <div class="modal fade" tabindex="-1" id="modal-task-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="atividade" class="form-label">Atividade</label>
                            <select type="text" class="form-control" id="atividade">

                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="text" class="form-control" id="data" placeholder="__/__/____ __:__:__">
                        </div>

                        <div class="col-12">
                            <label for="executor" class="form-label">Executor</label>
                            <select type="text" class="form-control" id="executor">

                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea type="text" class="form-control" id="descricao" rows="5" placeholder="Informe uma descrição com no máximo 200 caractéres."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-icon"><i class="mdi mdi-check"></i>Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            $("#modal-task-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-task-new-edit").modal('show');
        },
    }
</script>
