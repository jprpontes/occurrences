<template>
    <div class="modal fade" tabindex="-1" id="modal-activities">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atividades do setor {{ sectorName }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ActivityList @open-modal-activity-new-edit="$emit('open-modal-activity-new-edit')" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            sectorName: {
                type: String,
                default: () => 'Setor 1'
            }
        },
        mounted() {
            $("#modal-activities").on('hidden.bs.modal', (event) => {
                this.$emit('modal-closed');
            })

            $("#modal-activities").modal('show');
        },
    }
</script>
