<template>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                    <input type="text" class="form-control" placeholder="Busque por código, nome da pessoa ou do contrato.">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="mdi mdi-account-group"></i></span>
                    <select class="form-select">
                        <option value="1" selected>Todos os setores</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div v-for="step in steps" :key="step.id" class="col-md-3" style="height: calc(100vh - 160px);">
                <StepColumn :step="step" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                steps: []
            }
        },
        mounted() {
            this.getSteps();
        },
        methods: {
            getSteps() {
                axios.get(route('workspaces.getsteps'))
                    .then(res => {
                        this.steps = res.data.steps;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
        }
    }
</script>
