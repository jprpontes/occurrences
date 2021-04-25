<template>
    <div class="row">
        <div class="col-12" v-for="(item, index) in timeline" :key="index">
            <TimelineItemDefault v-if="item.type === 'DEFAULT'" :data="item.data" />
            <TimelineItemTask v-else-if="item.type === 'TASK'" :data="item.data" @open-modal-task-new-edit="$emit('open-modal-task-new-edit')" />
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                timeline: [
                    {
                         type: 'DEFAULT',
                         data: {
                             user: 'Fulano de Tal da Silva',
                             event: 'REAGENDADO PARA 01/02/2022',
                             description: 'Secretária atendeu e  informou que o responsável pelo financeiro está de folga.',
                             date: '01/01/2021 10:21:23'
                         }
                    },
                    {
                         type: 'TASK',
                         data: {
                             task_id: 1,
                             user: 'Fulano de Tal da Silva',
                             event: 'LIGOU',
                             description: 'Tentativa de ligação não obteve retorno. Tentarei ligar a tarde.',
                             date: '01/01/2021 10:21:23'
                         }
                    },
                ]
            }
        },
        mounted() {

        },
        methods: {
            componentName(type) {
                switch (type) {
                    case 'DEFAULT':
                        return 'TimelineItemDefault'
                    case 'TASK':
                        return 'TimelineItemTask'

                    default:
                        return null
                        break;
                }
            }
        }
    }
</script>
