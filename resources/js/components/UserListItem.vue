<template>
    <div class="card">
        <div class="card-body px-3 py-2">
            <div class="row">
                <div class="col-auto d-flex align-items-center">
                    <Avatar :username="user.name" :size="30" class="bg-gray-200 border-gray-600 text-gray-600 border"></Avatar>
                </div>

                <div class="col d-flex align-items-center">
                    <div class="d-flex flex-column">
                        <span class="fw-bold">{{ user.name }}</span>
                        <span class="fs-7">{{ user.email }}</span>
                    </div>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-primary btn-icon" @click="$emit('edit', user)"><i class="mdi mdi-pencil"></i>Editar</button>
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
