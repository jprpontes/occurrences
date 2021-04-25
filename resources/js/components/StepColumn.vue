<template>
    <div class="card h-100">
        <div class="card-header d-flex flex-column">
            <span class="card-title m-0 fw-bold">Step 1</span>
            <span class="card-text fs-8 text-gray-600">2 ocorrências</span>
        </div>

        <div class="card-body p-2" style="overflow-y: auto">
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
