<template>
    <div class="card h-100">
        <div class="card-header d-flex flex-column">
            <span class="card-title m-0 fw-bold">{{ step.name }}</span>
            <span class="card-text fs-8 text-gray-600">2 ocorrências</span>
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
                        this.getOccurrence(e.occurrenceId);
                    }
                });
        },
        methods: {
            getOccurrence(occurrenceId) {
                axios.get(route('workspaces.getoccurrence', { id: occurrenceId }))
                    .then(res => {
                        this.occurrences.splice(0, 0, res.data.occurrence);
                    });
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
