<template>
    <div>
        <div class="container-fluid">
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
        </div>
        <div class="container-fluid steps-container">
            <div v-for="step in steps" :key="step.id" class="step-col">
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

            Echo.channel('occurrences_occurrence')
                .listen('.occurrence.stepchanged', (e) => {
                    console.log('meu evento aqui 3');
                });
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
<style scoped>
    .steps-container {
        display: inline-flex;
        width: 100%;
        overflow-x: auto;
        padding-bottom: 25px;
    }

    .step-col {
        height: calc(100vh - 165px);
        min-width: 300px;
        max-width: 300px;
        margin-left: 5px;
        margin-right: 5px;
    }
</style>
