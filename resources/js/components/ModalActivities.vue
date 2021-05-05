<template>
    <div class="modal fade" tabindex="-1" id="modal-activities">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title flex-fill">Atividades do setor {{ sector.name }}</h5>
                    <button class="btn btn-primary btn-icon mx-4" @click="$emit('create')"><i class="mdi mdi-plus"></i>Novo</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ActivityList @edit="$emit('edit', $event)" ref="activityList" :sector-id="sector.id" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            sector: Object
        },
        mounted() {
            $("#modal-activities").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-activities").modal('show');
        },
        methods: {
            refreshActivityList() {
                this.$refs.activityList.refresh();
            }
        }
    }
</script>
