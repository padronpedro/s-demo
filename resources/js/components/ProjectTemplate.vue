<template>
    <div>
        <div>{{name}}</div>
        <div>{{description}}</div>
        <div>{{start_date}}</div>
        <div>{{end_date}}</div>
        <div>{{budget}}</div>
        <div>{{constraints}}</div>
        <div>{{final_cost}}</div>
        <div>{{client}}</div>
        <div v-for="(oneItem,index) in members" :key="index" class="pic-team-list">
            <s-team-card
                :name="oneItem.name"
                :position="oneItem.position"
                :picture="oneItem.picture"
                :initialValues="[]"
                :hideCheck="true"
                :id="oneItem.id"  />
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {

        }
    },
    props: {
        name: {
            type: String,
            required: true
        },
        description: {
            type: String,
            required: true
        },
        start_date: {
            type: String,
            required: false
        },
        end_date: {
            type: String,
            required: false
        },
        budget: {
            type: String,
            required: false
        },
        constraints: {
            type: String,
            required: false
        },
        final_cost: {
            type: String,
            required: false
        },
        client: {
            type: Object,
            required: false
        },
        members: {
            type: Array,
            required: false
        }
    }
}
</script>
<style scoped>
.pic-team-list {
    display: inline-block;

}
</style>
