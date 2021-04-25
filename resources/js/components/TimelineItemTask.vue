<template>
    <div class="row">
        <div class="col-auto d-flex align-items-center pe-1">
            <div style="width: 2px; height: 100%" class="bg-gray-200"></div>
            <div style="width: 14px; height: 14px; border-radius: 100%; margin-left: -50%;" class="border-gray-600 border border-2 bg-white"></div>
        </div>
        <div class="col d-flex flex-column ps-0 pe-0 me-3 py-3" style="border-bottom: 1px solid #e9ecef">
            <div class="d-flex align-items-center">
                <span class="flex-fill fw-bold">{{ data.user }}</span>
                <span class="fs-8">{{ data.date }}</span>
            </div>
            <span class="text-gray-600 fw-bold">{{ data.event }}</span>
            <span>{{ data.description }}</span>
            <div class="d-flex">
                <button class="btn btn-outline-primary btn-sm btn-icon mt-3"><i class="mdi mdi-pencil"></i>Editar</button>
            </div>
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
