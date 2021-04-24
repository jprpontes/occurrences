<template>
    <div class="modal fade" tabindex="-1" id="modal-sector-new-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo setor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" placeholder="Informe o nome do setor.">
                        </div>

                        <div class="col-12">
                            <label for="tp-doc" class="form-label">Tipo de documento</label>
                            <select type="text" class="form-control" id="tp-doc">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            $("#modal-sector-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-sector-new-edit").modal('show');
        },
    }
</script>
