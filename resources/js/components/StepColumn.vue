<template>
    <div class="card h-100">
        <div class="card-header d-flex flex-column">
            <span class="card-title m-0 fw-bold">{{ step.name }}</span>
            <div class="d-flex">
                <span class="card-text fs-8 text-gray-600">{{ occurrences.length }} ocorrências</span>
                <span class="card-text fs-8 text-gray-600 ms-3"><i class="mdi mdi-family-tree" style="font-size: 13px !important;"></i> {{ step.sector.name }}</span>
            </div>
        </div>

        <div class="card-body p-2" style="overflow-y: auto">
            <OccurrenceCard v-for="occurrence in occurrences" :key="occurrence.id" :occurrence="occurrence" class="mb-2" />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            step: Object
        },
        data() {
            return {
                verMais: false,
                occurrences: []
            }
        },
        mounted() {
            this.paginateOucurrences();

            Echo.channel('occurrences_occurrence')
                .listen('.occurrence.stepchanged', (e) => {
                    if (this.step.id === e.oldStepId) {
                        this.occurrences = this.occurrences.filter((item) => {
                            return item.id !== e.occurrenceId;
                        });
                    }
                    if (this.step.id === e.newStepId) {
                        this.getOccurrence(e.occurrenceId)
                            .then(res => {
                                this.occurrences.splice(0, 0, res.data.occurrence);
                            });
                    }
                });

            Echo.channel('occurrences_occurrence')
                .listen('.occurrence.responsiblechanged', (e) => {
                    this.occurrences.forEach((element, index) => {
                        if (element.id === e.occurrenceId) {
                            this.getOccurrence(e.occurrenceId)
                                .then(res => {
                                    this.$set(this.occurrences, index, res.data.occurrence);
                                });
                        }
                    });
                });
        },
        methods: {
            getOccurrence(occurrenceId) {
                return axios.get(route('workspaces.getoccurrence', { id: occurrenceId }));
            },
            paginateOucurrences() {
                axios.get(route('workspaces.getoccurrences', { offset: this.occurrences.length, stepId: this.step.id }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.occurrences = this.occurrences.concat(res.data.occurrences);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
        }
    }
</script>
