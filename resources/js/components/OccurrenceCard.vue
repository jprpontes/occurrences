<template>
    <div class="card card-hover shadow-sm" @click="openModalOccurrence">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <span class="fs-7 fw-bold">{{ occurrence.title }}</span>
                </div>

                <div v-if="occurrence.transition.user" class="col-auto">
                    <Avatar :username="occurrence.transition.user.name" :size="25" class="bg-gray-200 border-gray-600 text-gray-600 border" />
                </div>
            </div>

            <div class="row text-gray-600">
                <div class="col-auto">
                    <div class="row">
                        <div class="col-auto pe-1 lh-sm">
                            <span class="fs-8 fw-bold">Expectativa:</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto pe-1 lh-sm">
                            <span class="fs-8 fw-bold">Última atividade:</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto pe-1 lh-sm">
                            <span class="fs-8 fw-bold">Próxima atividade:</span>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        <div class="col-auto ps-0 lh-sm">
                            <span class="fs-8">{{ dateFormat(occurrence.transition.doc_due_date) }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ps-0 lh-sm">
                            <span class="fs-8">01/01/2022 00:00:00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ps-0 lh-sm">
                            <span class="fs-8">01/01/2022 00:00:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            occurrence: Object
        },
        methods: {
            openModalOccurrence() {
                this.$root.$emit('open-modal-occurrence', {
                    occurrenceId: this.occurrence.id
                });
            },
            dateFormat(date) {
                return moment(date).format('DD/MM/YYYY') + ' às ' + moment(date).format('HH:MM:SS');
            }
        }
    }
</script>

<style scoped>
    .card-hover {
        cursor: pointer;
    }
</style>
