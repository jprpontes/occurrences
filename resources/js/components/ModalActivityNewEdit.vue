<template>
    <div class="modal fade" tabindex="-1" id="modal-activity-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova atividade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Informe o título da atividade.">
                        </div>

                        <div class="col-12">
                            <label for="tp-doc" class="form-label">Setor</label>
                            <select type="text" class="form-control" id="tp-doc">

                            </select>
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
            $("#modal-activity-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-activity-new-edit").modal('show');
        },
    }
</script>