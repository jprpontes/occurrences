<template>
    <div class="row">
        <div class="col-auto d-flex align-items-center">
            <div style="width: 2px; height: 100%" class="bg-gray-200"></div>
            <div style="width: 12px; height: 12px; border-radius: 100%; margin-left: -50%;" class="bg-gray-200"></div>
        </div>
        <div class="col d-flex flex-column ps-0 py-3">
            <div class="d-flex align-items-center">
                <span class="flex-fill fw-bold">{{ data.user }}</span>
                <span class="fs-8">{{ data.date }}</span>
            </div>
            <span class="text-gray-600 fw-bold">{{ data.event }}</span>
            <span>{{ data.description }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            data: Object
        },
        data() {
            return {
            }
        },
        mounted() {

        },
    }
</script>
