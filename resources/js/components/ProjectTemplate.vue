<template>
    <div>
        <div>
            <div class="title-form">
                Project details
            </div>
             <span>
                Thank you for being part of our distinguished clients. Below you will find the detailed and updated information of your project. If you have any questions, do not hesitate to contact us.
            </span>
        </div>
        <div class="project-name">{{name}}</div>
        <div class="project-client">{{client ? client.name : ''}}</div>
        <div>{{description}}</div>
        <div class="project-constraints" v-if="constraints">Constraints</div>
        <div>{{constraints}}</div>
        <div class="project-constraints">Estimation</div>
        <div class="project-estimation">
            <div>
                <div>
                    {{start_date ? start_date: 'TBD'}}
                </div>
                <div class="project-subtitle">
                    Start date
                </div>
            </div>
            <div>
                <div>
                    {{end_date ? end_date: 'TBD'}}
                </div>
                <div class="project-subtitle">
                    End date
                </div>
            </div>
            <div>
                <div>
                    CAD {{budget ? budget: 'TBD'}}
                </div>
                <div class="project-subtitle">
                    Budget
                </div>
            </div>
            <div>
                <div>
                    CAD {{final_cost ? final_cost: 'TBD'}}
                </div>
                <div class="project-subtitle">
                    Final cost
                </div>
            </div>
        </div>
        <div class="project-constraints">Project team</div>

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
    },
}
</script>
<style scoped>
.pic-team-list {
    display: inline-block;
}
.project-name {
    font-size: 30px;
    text-transform: uppercase;
    line-height: 70px;
    margin-top: 30px;
    font-family: 'Anton', sans-serif;
    color: black;
}
.project-client {
    font-size: 18px;
    text-transform: uppercase;
    line-height: 70px;
    margin-bottom: 4px;
    font-family: 'Anton', sans-serif;
    color: black;
}
.project-constraints{
    font-size: 14px;
    line-height: 70px;
    margin-bottom: 4px;
    font-family: 'Anton', sans-serif;
    color: black;
}
.project-estimation {
    display: flex;
}
.project-estimation > div {
    flex: 20%;
    text-align: center;
}
.project-subtitle{
    font-size: 12px;
    font-weight: bold;
}
</style>
