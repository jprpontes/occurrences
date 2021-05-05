<template>
    <div>
        <ActivityListItem v-for="activity in activities" :key="activity.id" :activity="activity" class="mb-1" @edit="$emit('edit', $event)" />

        <div class="row" v-if="verMais">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-link my-3" @click="paginate">Ver mais...</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            sectorId: Number
        },
        data() {
            return {
                activities: [],
                verMais: true,
                searchValue: ''
            }
        },
        mounted() {
            this.paginate();
        },
        methods: {
            paginate() {
                axios.get(route('activities.getactivities', { offset: this.activities.length, sectorId: this.sectorId, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.activities = this.activities.concat(res.data.activities);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            refresh() {
                axios.get(route('activities.getactivities', { offset: 0, sectorId: this.sectorId, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.activities = this.activities = res.data.activities;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            search(value) {
                this.searchValue = value;
                axios.get(route('activities.getactivities', { offset: 0, sectorId: this.sectorId, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.activities = this.activities = res.data.activities;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
        }
    }
</script>
