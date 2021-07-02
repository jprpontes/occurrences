<template>
    <div class="dropdown">
        <div class="form-select" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center" v-if="selectedResponsible">
                <Avatar :username="selectedResponsible.name" :size="23" class="bg-gray-200 border-gray-600 text-gray-600 border" />
                <span class="ms-2">{{ selectedResponsible.name }}</span>
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
            <li v-for="responsible in responsibles" :key="responsible.id">
                <div class="dropdown-item d-flex align-items-center" @click="setResponsible(responsible)">
                    <Avatar :username="responsible.name" :size="23" class="bg-gray-200 border-gray-600 text-gray-600 border" />
                    <span class="ms-2">{{ responsible.name }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {

        },
        data() {
            return {
                search: '',
                selectedResponsible: null,
                responsibles: [
                    {
                        id: 1,
                        name: 'Fulano'
                    },
                    {
                        id: 2,
                        name: 'Siclano'
                    },
                    {
                        id: 3,
                        name: 'Beltrano'
                    },
                ]
            }
        },
        methods: {
            setResponsible(responsible) {
                this.selectedResponsible = responsible;
            },
            searchResponsibles() {
                axios.get(route('ocurrences.responsibles', { search: this.search }))
                    .then(res => {
                        this.responsibles = res.data.responsibles;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
        }
    }
</script>
<style scoped lang="scss">
.responsible-menu {
    transform: translate3d(0px, 42px, 0px) !important;
}
</style>
