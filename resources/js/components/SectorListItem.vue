<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <span>{{ sector.name }}</span>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-primary" @click="$emit('activies', sector)">Atividades</button>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-primary btn-icon" @click="$emit('edit', sector)"><i class="mdi mdi-pencil"></i>Editar</button>
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
    }
</script>
