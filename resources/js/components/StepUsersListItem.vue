<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="fw-bold me-1">{{ user.name }}</span>
                        <span class="fs-7">({{ user.email }})</span>
                    </div>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button v-if="user.adicionado" class="btn btn-sm btn-outline-danger btn-icon" @click="$emit('remove-from-step', user)"><i class="mdi mdi-close"></i>Revogar</button>
                    <button v-else class="btn btn-sm btn-primary btn-icon" @click="$emit('add-to-step', user)"><i class="mdi mdi-check"></i>Permitir</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object
        },
    }
</script>
