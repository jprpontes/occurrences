<template>
    <div>
        <SectorListItem class="mb-1" v-for="sector in sectors" :key="sector.id" :sector="sector" @edit="sectorEdit" @activies="activies" />

        <div class="row" v-if="verMais">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-link my-3" @click="paginate">Ver mais...</button>
            </div>
        </div>

        <ModalSectorNewEdit v-if="modalSectorNewEdit" @modal-closed="modalSectorNewEdit = false" :mode="'EDIT'" :sector-id="sectorSelected.id" @updated="sectorUpdated" />
        <ModalActivities v-if="modalActivities" @modal-closed="modalActivities = false" @create="activityCreate" @edit="activityEdit" :style="{'z-index': modalActivityNewEdit ? 1 : 1060}" ref="modalActivities" :sector="sectorSelected" />
        <ModalActivityNewEdit v-if="modalActivityNewEdit" @modal-closed="modalActivityNewEditClosed" :activity-id="activitySelected ? activitySelected.id : -1" :mode="activityMode" @inserted="activityInserted" @updated="activityUpdated" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                sectors: [],
                verMais: true,
                sectorSelected: null,
                activitySelected: null,
                modalSectorNewEdit: false,
                modalActivities: false,
                modalActivityNewEdit: false,
                searchValue: '',
                activityMode: 'NEW'
            }
        },
        mounted() {
            this.paginate();
        },
        methods: {
            activityCreate() {
                this.activityMode = 'NEW';
                this.modalActivityNewEdit = true;
                this.activitySelected = -1;
            },
            activityEdit(activity) {
                this.activityMode = 'EDIT';
                this.modalActivityNewEdit = true;
                this.activitySelected = activity;
            },
            activies(sector) {
                this.modalActivities = true;
                this.sectorSelected = sector;
            },
            activityInserted() {
                this.$refs.modalActivities.refreshActivityList();
            },
            activityUpdated() {
                this.$refs.modalActivities.refreshActivityList();
            },
            sectorUpdated() {
                this.refresh();
            },
            sectorEdit(sector) {
                this.modalSectorNewEdit = true;
                this.sectorSelected = sector;
            },
            paginate() {
                axios.get(route('sectors.getsectors', { offset: this.sectors.length, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.sectors = this.sectors.concat(res.data.sectors);
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            refresh() {
                axios.get(route('sectors.getsectors', { offset: 0, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.sectors = this.sectors = res.data.sectors;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            search(value) {
                this.searchValue = value;
                axios.get(route('sectors.getsectors', { offset: 0, search: this.searchValue }))
                    .then(res => {
                        this.verMais = res.data.verMais;
                        this.sectors = this.sectors = res.data.sectors;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            modalActivityNewEditClosed() {
                this.modalActivityNewEdit = false;
                this.$refs.modalActivities.$el.focus();
            }
        }
    }
</script>
