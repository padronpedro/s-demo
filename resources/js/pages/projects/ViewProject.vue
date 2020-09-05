<template>
    <div>
        <div v-if="$route.params.hash && !notFound">
            <project-template
                :name="name"
                :description="description"
                :start_date="start_date"
                :end_date="end_date"
                :budget="budget"
                :constraints="constraints"
                :final_cost="final_cost"
                :client="client"
                :members="members"
            />
            view project
        </div>
        <div v-if="!$route.params.hash || (notFound && !loadingProject)">
            Project not found
        </div>
        <div v-if="loadingProject">
            Loading project
        </div>
    </div>
</template>

<script>

export default {
    data () {
        return {
            notFound: true,
            loadingProject: true,
            name: '',
            description: '',
            start_date: '',
            end_date: '',
            budget: '',
            constraints: '',
            final_cost: '',
            client: [],
            members: []
        }
    },
    mounted() {
        this.$nextTick(function () {
            if(this.$route.params.hash){
                this.getProjectInfo()
            }
        })
    },
    methods: {
        getProjectInfo() {
            axios.get('/api/v1/projects/hash/' + this.$route.params.hash, {})
                .then(response => {
                    let info = response.data
                    if(info.status === 'SUCCESS') {
                        this.notFound = false
                        this.name = info.data.name;
                        this.description = info.data.description;
                        this.start_date = info.data.start_date;
                        this.end_date = info.data.end_date;
                        this.budget = info.data.budget;
                        this.constraints = info.data.constraints;
                        this.final_cost = info.data.final_cost;
                        this.client = info.data.client;
                        this.members = info.data.members;
                        this.project_link = this.$getLinkProject(info.data.project_link)
                        let aux = info.data.members;
                        if(aux){
                            this.teamMembers = info.data.members.map(elemen => {
                                return elemen.id;
                            })
                        }
                        this.loadingProject = false
                    } else {
                        this.$refs.snackbar.showSnack(info.message, 'error')
                        this.notFound = true
                    }
                })
                .catch(error => {
                    this.$refs.snackbar.showSnack(('Error getting project data') + ': ' + error, 'error')
                })
        }
    }
}
</script>
