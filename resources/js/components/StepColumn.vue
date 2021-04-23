<template>
    <div class="card h-100">
        <div class="card-header d-flex flex-column bg-transparent border-0">
            <span class="card-title m-0 fw-bold">Step 1</span>
            <span class="card-text fs-8 text-gray-600">2 ocorrências</span>
        </div>

        <div class="card-body">
            <OcurrenceCard class="mb-2" />
            <OcurrenceCard class="mb-2"/>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        }
    }
</script>
