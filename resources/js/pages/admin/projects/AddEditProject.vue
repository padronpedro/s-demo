<template>
  <div>
    <Menu />
    <div class="box-main-content">
      <div class="box-main-content-container">
        <div class="top-module">
            <s-bread-crumbs :listLink="breadCrumbs" />
        </div>

        <div class="flex-container">
            <div class="flex-container-col">
                <s-input-text :label="'Name'" v-model="name"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Start Date'" v-model="start_date"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'End Date'" v-model="end_date"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Budget'" v-model="budget"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Final Cost'" v-model="final_cost"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Project Link'" v-model="project_link"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-textarea :label="'Constraints'" v-model="constraints"></s-textarea>
            </div>
            <div class="flex-container-col">
                <s-textarea :label="'Description'" v-model="description"></s-textarea>
            </div>
            <div class="flex-container-col" style="  position: relative;">
                <s-dropdown :label="'Client'" v-model="client_id" :optionItems="clientList"  style="position: absolute;bottom: 0;"></s-dropdown>
            </div>
        </div>
        <div style="margin-bottom: 10px">
            <h4>Team members</h4>

            <div v-for="(oneItem,index) in dataTable" :key="index" class="pic-team-list">
                <s-team-card
                    :name="oneItem.name"
                    :position="oneItem.position"
                    :picture="oneItem.picture"
                    @checkboxResult="setTeamMembers"
                    :initialValues="teamMembers"
                    :id="oneItem.id"  />
            </div>

        </div>
        <div class="box-bottom">
            <s-button :buttonText="'Save'" @clickAction="clickSaveProject"></s-button>
            <s-button :buttonText="'Cancel'" @clickAction="clickCancelProject"></s-button>
        </div>
      </div>
    </div>
    <snack-bar ref="snackbar" :textToShow="snackText"/>
  </div>
</template>

<script>
  export default {
		data () {
			return {
				name: '',
				description: '',
				start_date: '',
				end_date: '',
				budget: '',
                constraints: '',
                final_cost: '',
                project_link: '',
                client_id: '',
                editMode: false,
                snackText: '',
                projectId: '',
                clientList: [],
                dataTable: [],
                dataTableHeader: [
                    { name: 'Picture' },
                    { name: 'Name' },
                    { name: 'Position' }
                ],
                teamMembers: []
                breadCrumbs: [
                    { text: 'Home', link: 'admin.home'},
                    { text: 'Projects', link: 'admin.projects'},
                    { text: 'Project information', link: ''},
                ]
			}
        },
        mounted () {
            this.$nextTick(function () {
                if (!_.isEmpty(this.$route.params)) {
                    this.editMode = true
                    this.projectId = this.$route.params.id
                    this.getProjectData()
                }
                this.getClientList()
                this.getTeamList()
            })
        },
		methods: {
            setTeamMembers (isChecked, value){
                console.log('isChecked',isChecked, 'value',value)
                if(isChecked){
                    this.teamMembers.push(Number(value))
                }else{
                    let aux = this.teamMembers.findIndex(elemen=>{
                        return elemen === value
                    })
                    if(aux>=0){
                        this.teamMembers.splice(aux,1)
                    console.log('aux',aux,'list',this.teamMembers)
                    }
                }
            },
            getTeamList () {
                axios.get('/api/v1/members', {})
                    .then(response => {
                        let info = response.data
                        if(info.status === 'SUCCESS') {
                            this.dataTable = info.data
                        } else {
                            this.$refs.snackbar.showSnack(info.message)
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(('Error getting members data') + ': ' + error)
                    })
            },
            getClientList () {
                axios.get('/api/v1/clients', {})
                    .then(response => {
                        let info = response.data
                        if(info.status === 'SUCCESS') {
                            this.clientList = info.data
                            if(this.clientList.length>0){
                                this.client_id = this.clientList[0].id
                            }
                        } else {
                            this.$refs.snackbar.showSnack(info.message)
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(('Error getting clients data') + ': ' + error)
                    })
            },
            getProjectData () {
                axios.get('/api/v1/projects/' + this.projectId, {})
                    .then(response => {
                        let info = response.data
                        if(info.status === 'SUCCESS') {
                            this.name = info.data.name;
                            this.description = info.data.description;
                            this.start_date = info.data.start_date;
                            this.end_date = info.data.end_date;
                            this.budget = info.data.budget;
                            this.constraints = info.data.constraints;
                            this.final_cost = info.data.final_cost;
                            this.project_link = info.data.project_link;
                            this.client_id = info.data.client_id;
                            let aux = info.data.members;
                            if(aux){
                                this.teamMembers = info.data.members.map(elemen => {
                                    return elemen.id;
                                })
                            }
                        } else {
                            this.$refs.snackbar.showSnack(info.message)
                            setTimeout(() => {
                                this.$goRouter('admin.projects')
                            }, 2000)
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(('Error getting project data') + ': ' + error)
                    })
            },
			clickSaveProject () {
                let formData = {
                    name: this.name,
                    description: this.description,
                    start_date: this.start_date,
                    end_date: this.end_date,
                    budget: this.budget,
                    constraints: this.constraints,
                    final_cost: this.final_cost,
                    project_link: this.project_link,
                    client_id: this.client_id,
                    teamMembers: this.teamMembers
                }
                if(!this.editMode){
                    axios.post('/api/v1/projects', formData)
                        .then(response => {
                            if(response.data.status === 'SUCCESS') {
                                this.$goRouter('admin.projects')
                            } else {
                                this.$refs.snackbar.showSnack(response.data.message)
                            }
                        })
                        .catch(error => {
                            this.$refs.snackbar.showSnack(error)
                        })
                }else{
                    axios.put('/api/v1/projects/' + this.projectId, formData)
                        .then(response => {
                            if(response.data.status === 'SUCCESS') {
                                this.$goRouter('admin.projects')
                            } else {
                                this.$refs.snackbar.showSnack(response.data.message)
                            }
                        })
                        .catch(error => {
                            this.$refs.snackbar.showSnack(error)
                        })
                }
			},
			clickCancelProject () {
				this.$goRouter('admin.projects')
			}
		}
  }
</script>

<style scoped>
.flex-container {
  display: flex;
  flex-wrap: wrap;
}

.flex-container-col {
  flex: 25%;
  margin: 10px;
  text-align: center;
  font-size: 30px;
}

@media screen and (max-width: 992px) {
  .flex-container-col {
    flex: 50%;
  }
}

@media screen and (max-width: 600px) {
  .flex-container-col {
    flex-direction: column;
  }
}

.pic-team-list {
    display: inline-block;

}
</style>
