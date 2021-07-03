<template>
    <div class="dropdown">
        <div class="form-select" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center">
                <span>{{ step ? step.name : 'Não atribuído' }}</span>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-down step-menu">
            <li class="px-2 pb-1">
                <input type="text" class="form-control" v-model="search" placeholder="Busque por nome.">
            </li>
            <li>
                <div class="dropdown-item d-flex align-items-center" @click="setStep(null)">
                    <span>Não atribuído</span>
                </div>
            </li>
            <li v-for="stepItem in steps" :key="stepItem.id">
                <div class="dropdown-item d-flex align-items-center" @click="setStep(stepItem)">
                    <span>{{ stepItem.name }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            step: Object
        },
        data() {
            return {
                search: '',
                steps: []
            }
        },
        mounted() {
            this.searchSteps();
        },
        methods: {
            setStep(selectedStep) {
                this.$emit('step-changed', { step: selectedStep });
            },
            searchSteps() {
                axios.get(route('steps.getstepstoprevnext', { search: this.search }))
                    .then(res => {
                        this.steps = res.data.steps;
                    })
            },
        },
        watch: {
            search(value) {
                this.searchSteps();
            }
        }
    }
</script>
<style scoped lang="scss">
.step-menu {
    transform: translate3d(0px, 42px, 0px) !important;
    min-width: 29.1rem !important;
}
</style>
