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
        </div>
        <div v-if="notFound">
            <div class="title-form">
                We didn't found your project
            </div>
            <div class="title-info-client">
                Contact us for more information
            </div>
            <div class="button-contact">
                <s-button :buttonText="'Contact us'" @clickAction="clicContact"></s-button>
            </div>
        </div>
        <div v-if="loadingProject">
            <div class="title-form">
                Loading project...
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data () {
        return {
            notFound: false,
            loadingProject: true,
            name: '',
            description: '',
            start_date: '',
            end_date: '',
            budget: '',
            constraints: '',
            final_cost: '',
            client: null,
            members: []
        }
    },
    mounted() {
        this.$nextTick(function () {
            if(this.$route.params.hash){
                this.getProjectInfo()
            }else{
                this.notFound = true
            }
        })
    },
    methods: {
        clicContact () {
            document.location='https://signifly.com/contact/'
        },
        getProjectInfo() {
            this.loadingProject = true
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
                        this.notFound = true
                        this.loadingProject = false
                    }
                })
                .catch(error => {
                    console.log(error)
                    this.notFound = true
                    this.loadingProject = false
                })
        }
    }
}
</script>

<style scoped>
.button-contact {
    text-align: center;
}
</style>
