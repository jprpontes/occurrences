<template>
    <div>
        <StepListItem
            class="mb-1"
            v-for="step in steps"
            :key="step.id"
            :step="step"
            @edit="stepEdit"
        />

        <ModalStepNewEdit
            v-if="modalStepNewEdit"
            @modal-closed="modalStepNewEdit = false"
            :mode="'EDIT'"
            :step-id="stepSelected.id"
            @updated="stepUpdated"
        />
    </div>
</template>

<script>
export default {
    data() {
        return {
            steps: [],
            stepSelected: null,
            modalStepNewEdit: false,
            searchValue: "",
        };
    },
    mounted() {
        this.refresh();
    },
    methods: {
        stepUpdated() {
            this.refresh();
        },
        stepEdit(step) {
            this.modalStepNewEdit = true;
            this.stepSelected = step;
        },
        refresh() {
            axios
                .get(
                    route("steps.getsteps", {
                        search: this.searchValue,
                    })
                )
                .then((res) => {
                    this.steps = res.data.steps;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        search(value) {
            this.searchValue = value;
            this.refresh();
        },
    },
};
</script>
