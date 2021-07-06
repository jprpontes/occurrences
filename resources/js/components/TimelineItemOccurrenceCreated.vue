<template>
    <div class="row">
        <div class="col-auto d-flex align-items-center pe-1">
            <div style="width: 2px; height: 100%" class="bg-gray-200"></div>
            <div style="width: 14px; height: 14px; border-radius: 100%; margin-left: -50%;" class="border-gray-600 border border-2 bg-white"></div>
        </div>
        <div class="col d-flex flex-column ps-0 pe-0 me-3 py-3" style="border-bottom: 1px solid #e9ecef">
            <div class="d-flex align-items-center">
                <span class="flex-fill fw-bold">{{ data.updatedBy ? data.updatedBy.name : 'BOT' }}</span>
                <span class="fs-8">{{ formattedDate }}</span>
            </div>
            <span class="text-gray-600 fw-bold">{{ data.event }}</span>
            <span>{{ formattedDescription }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            data: Object
        },
        computed: {
            formattedDescription() {
                return 'Ocorrência criada.';
            },
            formattedDate() {
                return moment(this.data.date).format('DD/MM/YYYY') + ' às ' + moment(this.data.date).format('HH:MM:SS');
            }
        },
        mounted() {

        },
    }
</script>
