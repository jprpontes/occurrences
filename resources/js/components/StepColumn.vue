<template>
    <div class="card h-100">
        <div class="card-header d-flex flex-column">
            <span class="card-title m-0 fw-bold">{{ step.name }}</span>
            <span class="card-text fs-8 text-gray-600">2 ocorrências</span>
        </div>

        <div class="card-body p-2" style="overflow-y: auto">
            <OcurrenceCard v-for="ocurrence in ocurrences" :key="ocurrence.id" :ocurrence="ocurrence" class="mb-2" />
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
                ocurrences: []
            }
        },
        mounted() {
            this.paginateOucurrences();
        },
        methods: {
            paginateOucurrences() {
                axios.get(route('workspaces.getocurrences', { offset: this.ocurrences.length, stepId: this.step.id }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.ocurrences = this.ocurrences.concat(res.data.ocurrences);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
        }
    }
</script>
