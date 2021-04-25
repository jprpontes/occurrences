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
                            <input type="text" class="form-control" id="nome" placeholder="Informe o nome do usuário.">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" id="email" placeholder="Informe o email do usuário.">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="tp-doc" class="form-label">Setor</label>
                            <select type="text" class="form-control" id="tp-doc">
                                <option value="">Nenhum setor</option>
                            </select>
                        </div>

                        <div class="col-12 d-flex align-items-center mb-3">
                            <div class="form-check me-2">
                                <input type="radio" name="radio-senha-op" id="radio-senha-op1" class="form-check-input" value="EMAIL" v-model="senhaModo">
                                <label for="radio-senha-op1" class="form-check-label">Enviar senha por e-mail</label>
                            </div>
                            <div class="form-check mx-2">
                                <input type="radio" name="radio-senha-op" id="radio-senha-op2" class="form-check-input" value="INFORMAR" v-model="senhaModo">
                                <label for="radio-senha-op2" class="form-check-label">Informar senha</label>
                            </div>
                        </div>

                        <div class="col-12 mb-3" v-if="senhaModo === 'INFORMAR'">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="text" class="form-control" id="senha" placeholder="Informe uma senha com no mínimo 8 digitos." min="8">
                        </div>

                        <div class="col-12 mb-3" v-if="senhaModo === 'INFORMAR'">
                            <label for="senha" class="form-label">Repita a Senha</label>
                            <input type="text" class="form-control" id="senha" placeholder="Informe a senha novamente." min="8">
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
        data() {
            return {
                senhaModo: 'EMAIL'
            }
        },
        mounted() {
            $("#modal-user-new-edit").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-user-new-edit").modal('show');
        },
    }
</script>
