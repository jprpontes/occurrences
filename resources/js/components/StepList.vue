<template>
    <div>
        <draggable v-model="steps" group="steps" @start="drag=true" @end="drag=false" class="list-group" ghost-class="ghost" handle=".handle">
            <transition-group type="transition" name="flip-list">
                <StepListItem class="mb-1" v-for="step in steps" :key="step.id" :step="step" @edit="stepEdit" />
            </transition-group>
        </draggable>

        <div class="row" v-if="verMais">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-link my-3" @click="paginate">Ver mais...</button>
            </div>
        </div>

        <ModalStepNewEdit v-if="modalStepNewEdit" @modal-closed="modalStepNewEdit = false" :mode="'EDIT'" :step-id="stepSelected.id" @updated="stepUpdated" />
    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    export default {
        components: {
            draggable,
        },
        data() {
            return {
                steps: [],
                verMais: true,
                stepSelected: null,
                modalStepNewEdit: false,
                searchValue: ''
            }
        },
        mounted() {
            this.paginate();
        },
        methods: {
            stepUpdated() {
                this.refresh();
            },
            stepEdit(step) {
                this.modalStepNewEdit = true;
                this.stepSelected = step;
            },
            paginate() {
                axios.get(route('steps.getsteps', { offset: this.steps.length, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.steps = this.steps.concat(res.data.steps);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            refresh() {
                axios.get(route('steps.getsteps', { offset: 0, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.steps   = res.data.steps;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            search(value) {
                this.searchValue = value;
                axios.get(route('steps.getsteps', { offset: 0, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.steps = this.steps = res.data.steps;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            }
        }
    }
</script>
<style lang="scss" scoped>
    @import '@/resources/sass/_variables';
    .ghost {
        opacity: 0.5;
        background: $gray-300;
    }
    .flip-list-move {
        transition: transform 0.5s;
    }
</style>
