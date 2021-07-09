<template>
    <div class="row">
        <div class="col-12" v-for="(item, index) in timeline" :key="index">
            <TimelineItemOccurrenceCreated v-if="item.type === 'OCCURRENCE_CREATED'" :data="item" />
            <TimelineItemOccurrenceChangedStep v-else-if="item.type === 'OCCURRENCE_CHANGED_STEP'" :data="item" />
            <TimelineItemOccurrenceChangedUser v-else-if="item.type === 'OCCURRENCE_CHANGED_USER'" :data="item" />
            <TimelineItemTask v-else-if="item.type === 'TASK'" :data="item" />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            occurrenceId: Number
        },
        data() {
            return {
                timeline: []
            }
        },
        mounted() {
            this.getTimeline();
        },
        methods: {
            getTimeline() {
                axios.get(route('occurrences.timeline', { id: this.occurrenceId }))
                    .then(res => {
                        this.timeline = res.data.timeline;
                    });
            },
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
