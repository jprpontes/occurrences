<template>
    <div class="dropdown">
        <div :class="{ 'form-select': !disabled, 'form-control': disabled, 'disabled': disabled }" data-bs-toggle="dropdown" :disabled="disabled">
            <div class="d-flex align-items-center" v-if="responsible">
                <Avatar :username="responsible.name" :size="23" class="bg-gray-200 border-gray-600 text-gray-600 border" />
                <span class="ms-2">{{ responsible.name }}</span>
            </div>
            <div class="d-flex align-items-center" v-else>
                <span>Não atribuído</span>
            </div>
        </div>
        <ul class="dropdown-menu responsible-menu">
            <li class="px-2 pb-1">
                <input type="text" class="form-control" id="responsible" v-model="search" placeholder="Busque por nome.">
            </li>
            <li>
                <div class="dropdown-item d-flex align-items-center" @click="setResponsible(null)">
                    <span>Não atribuído</span>
                </div>
            </li>
            <li v-for="responsibleItem in responsibles" :key="responsibleItem.id">
                <div class="dropdown-item d-flex align-items-center" @click="setResponsible(responsibleItem)">
                    <Avatar :username="responsibleItem.name" :size="23" class="bg-gray-200 border-gray-600 text-gray-600 border" />
                    <span class="ms-2">{{ responsibleItem.name }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            responsible: Object,
            disabled: Boolean
        },
        data() {
            return {
                search: '',
                responsibles: []
            }
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers() {
                axios.get(route('occurrences.getusers', { search: this.search }))
                    .then(res => {
                        this.responsibles = res.data.users;
                    })
            },
            setResponsible(selectedResponsible) {
                this.$emit('responsible-changed', { responsible: selectedResponsible });
            },
            searchResponsibles() {
                axios.get(route('occurrences.responsibles', { search: this.search }))
                    .then(res => {
                        this.responsibles = res.data.responsibles;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
        },
        watch: {
            search(value) {
                this.getUsers();
            }
        }
    }
</script>
<style scoped lang="scss">
.responsible-menu {
    transform: translate3d(0px, 42px, 0px) !important;
}
</style>
