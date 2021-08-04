<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="input-group mb-3">
                        <span class="input-group-text"
                            ><i class="mdi mdi-magnify"></i
                        ></span>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Busque por código, nome da pessoa ou do contrato."
                        />
                    </div>
                </div>
                <div class="col-12 col-md-4" v-if="$hasRole('admin')">
                    <div class="input-group mb-3">
                        <span class="input-group-text"
                            ><i class="mdi mdi-account-group"></i
                        ></span>
                        <select
                            class="form-select"
                            v-model="selectedSector"
                            @change="getSteps"
                        >
                            <option :value="null" selected>
                                Todos os setores
                            </option>
                            <option
                                v-for="sector in sectors"
                                :key="sector.id"
                                :value="sector"
                            >
                                {{ sector.name }}
                            </option>
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

        <ModalOccurrenceInvoice
            v-if="modalOccurrenceOptions.show"
            :style="{ 'z-index': modalTaskNewEditOptions.show ? 1 : 1060 }"
            :occurrence-id="modalOccurrenceOptions.occurrenceId"
            ref="modalOccurrenceInvoice"
        />

        <ModalTaskNewEdit
            v-if="modalTaskNewEditOptions.show"
            :occurrence-id="modalTaskNewEditOptions.occurrenceId"
            :task-id="modalTaskNewEditOptions.taskId"
            :mode="modalTaskNewEditOptions.taskId ? 'EDIT' : 'NEW'"
        />
    </div>
</template>

<script>
export default {
    data() {
        return {
            sectors: [],
            steps: [],
            selectedSector: null,
            modalOccurrenceOptions: {
                show: false,
                occurrenceId: null,
            },
            modalTaskNewEditOptions: {
                show: false,
                occurrenceId: null,
                taskId: null,
            },
        };
    },
    mounted() {
        this.getSectors();

        this.getSteps();

        this.$root.$on("open-modal-occurrence", (event) => {
            this.modalOccurrenceOptions.occurrenceId = event.occurrenceId;
            this.modalOccurrenceOptions.show = true;
        });

        this.$root.$on("modal-occurrence-closed", () => {
            this.modalOccurrenceOptions.occurrenceId = null;
            this.modalOccurrenceOptions.show = false;
        });

        this.$root.$on("open-modal-task-new-edit", (event) => {
            if (event && event.taskId) {
                this.modalTaskNewEditOptions.taskId = event.taskId;
            }
            if (event && event.occurrenceId) {
                this.modalTaskNewEditOptions.occurrenceId = event.occurrenceId;
            }
            this.modalTaskNewEditOptions.show = true;
        });

        this.$root.$on("modal-task-new-edit-closed", () => {
            this.modalTaskNewEditOptions.taskId = null;
            this.modalTaskNewEditOptions.occurrenceId = null;
            this.modalTaskNewEditOptions.show = false;
            this.$refs.modalOccurrenceInvoice.$el.focus();
        });
    },
    methods: {
        modalOccurrenceClosed() {
            this.modalOccurrenceOptions.show = false;
        },
        getSectors() {
            axios
                .get(route("workspaces.getsectorsoptions"))
                .then((res) => {
                    this.sectors = res.data.sectors;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        getSteps() {
            console.log(this.selectedSector);
            axios
                .get(
                    route("workspaces.getsteps", {
                        sectorId: this.selectedSector
                            ? this.selectedSector.id
                            : null,
                    })
                )
                .then((res) => {
                    this.steps = res.data.steps;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
    },
};
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
