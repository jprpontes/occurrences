<template>
    <div>
        <ActivityListItem class="mb-1" @open-modal-activity-new-edit="$emit('open-modal-activity-new-edit')" />
        <ActivityListItem class="mb-1" @open-modal-activity-new-edit="$emit('open-modal-activity-new-edit')" />

        <div class="row">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-link my-3">Ver mais...</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        }
    }
</script>
