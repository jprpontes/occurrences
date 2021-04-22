<template>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="input-group mb-3">
                    <span class="input-group-text">Pesquisar</span>
                    <input type="text" class="form-control" placeholder="Busque por código, nome da pessoa ou do contrato.">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Setor</span>
                    <select class="form-control">
                        <option value="1" selected>Todos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height: calc(100vh - 110px);">
                <StepColumn />
            </div>
            <div class="col-md-3" style="height: calc(100vh - 110px);">
                <StepColumn />
            </div>
        </div>

        <ModalOcurrenceInvoice />
    </div>
</template>

<script>
    export default {
        mounted() {

        }
    }
</script>
