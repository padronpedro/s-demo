<template>
  <div>
    <div class="box-main-content">
      <div class="box-main-content-container">
        <div class="top-module">
            <s-bread-crumbs :listLink="breadCrumbs" />
        </div>
        <div style="margin-top:20px" v-if="loadSkeleton">
            <template-skeleton loading/>
        </div>
        <div v-else>
            <div class="flex-container">
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Project name'"
                        v-model="name"
                        :name="'name'"
                        :isRequired="true"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Start date'"
                        :typeInput="'date'"
                        v-model="start_date"
                        :name="'start_date'"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'End date'"
                        :typeInput="'date'"
                        v-model="end_date"
                        :name="'end_date'"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Budget'"
                        :typeInput="'number'"
                        v-model="budget"
                        :name="'budget'"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Final cost'"
                        :typeInput="'number'"
                        v-model="final_cost"
                        :name="'final_cost'"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <div>
                        <s-input-text
                            :label="'Project link'"
                            v-model="project_link"
                            :name="'project_link'"
                            :readOnly="true"
                            @reportError="processError"
                            >
                        </s-input-text>
                    </div>
                    <div v-if="project_link">
                        <s-button @clickAction="copyToClipboard" :buttonText="'Copy'"></s-button>
                    </div>
                </div>
                <div class="flex-container-col">
                    <s-textarea
                        :label="'Constraints'"
                        v-model="constraints"
                        :name="'constraints'"
                        @reportError="processError">
                    </s-textarea>
                </div>
                <div class="flex-container-col">
                    <s-textarea
                        :label="'Description'"
                        v-model="description"
                        :name="'description'"
                        :isRequired="true"
                        @reportError="processError">
                    </s-textarea>
                </div>
                <div class="flex-container-col" style="  position: relative;">
                    <s-dropdown
                        :label="'Client'"
                        v-model="client_id"
                        :optionItems="clientList"
                        style="position: absolute;bottom: 0;">
                    </s-dropdown>
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
                <input type="hidden" id="testing-code" :value="testingCode">
            </div>
            <div class="box-bottom">
                <s-button :buttonText="'Save'" @clickAction="clickSaveProject"></s-button>
                <s-button :buttonText="'Cancel'" @clickAction="clickCancelProject"></s-button>
            </div>
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
                loadSkeleton: false,
				name: '',
				description: '',
				start_date: '',
				end_date: '',
				budget: '',
                constraints: '',
                final_cost: '',
                client_id: '',
                editMode: false,
                snackText: '',
                projectId: '',
                clientList: [],
                dataTable: [],
                project_link: '',
                dataTableHeader: [
                    { name: 'Picture' },
                    { name: 'Name' },
                    { name: 'Position' }
                ],
                teamMembers: [],
                formErrors: [],
                breadCrumbs: [
                    { text: 'Home', link: 'home'},
                    { text: 'Projects', link: 'admin.projects'},
                    { text: 'Project information', link: ''},
                ]
			}
        },
        computed: {
            isFormValid () {
                if ((this.formErrors.length === 0) && this.name && this.description){
                    return true
                }else{
                    return false
                }
            },
            testingCode () {
                return this.project_link
            }
        },
        mounted () {
            this.$nextTick(function () {
                if (!_.isEmpty(this.$route.params)) {
                    this.editMode = true
                    this.projectId = this.$route.params.id
                    this.getProjectData()
                    this.loadSkeleton = true
                }else{
                    this.formErrors = ['name', 'description']
                }
                this.getClientList()
                this.getTeamList()
            })
        },
		methods: {
            copyToClipboard () {
                if(this.project_link){
                    let testingCodeToCopy = document.querySelector('#testing-code')
                    testingCodeToCopy.setAttribute('type', 'text')
                    testingCodeToCopy.select()
                    try {
                        var successful = document.execCommand('copy');
                        var msg = successful ? 'successful' : 'unsuccessful';
                        this.$refs.snackbar.showSnack('Project link copied to clipboard', 'success')
                    } catch (err) {
                        this.$refs.snackbar.showSnack('Error copying project link to clipboard', 'error')
                    }
                    testingCodeToCopy.setAttribute('type', 'hidden')
                    window.getSelection().removeAllRanges()
                }
            },
            processError (element, addDelete){
                let aux = this.formErrors.findIndex(item => {
                    return item === element
                })
                if(addDelete){
                    if(aux === -1){
                        this.formErrors.push(element)
                    }
                }else{
                    if(aux>=0){
                        this.formErrors.splice(aux,1)
                    }
                }
            },
            setTeamMembers (isChecked, value){
                if(isChecked){
                    this.teamMembers.push(Number(value))
                }else{
                    let aux = this.teamMembers.findIndex(elemen=>{
                        return elemen === value
                    })
                    if(aux>=0){
                        this.teamMembers.splice(aux,1)
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
                            this.$refs.snackbar.showSnack(info.message, 'error')
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
                            this.$refs.snackbar.showSnack(info.message, 'error')
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(('Error getting clients data') + ': ' + error)
                    })
            },
            getProjectData () {
                axios.get('/api/v1/projects/' + this.projectId, {})
                    .then(response => {
                        this.loadSkeleton = false
                        let info = response.data
                        if(info.status === 'SUCCESS') {
                            this.name = info.data.name;
                            this.description = info.data.description;
                            this.start_date = info.data.start_date;
                            this.end_date = info.data.end_date;
                            this.budget = info.data.budget;
                            this.constraints = info.data.constraints;
                            this.final_cost = info.data.final_cost;
                            this.client_id = info.data.client_id;
                            this.project_link = this.$getLinkProject(info.data.project_link)
                            let aux = info.data.members;
                            if(aux){
                                this.teamMembers = info.data.members.map(elemen => {
                                    return elemen.id;
                                })
                            }
                        } else {
                            this.$refs.snackbar.showSnack(info.message, 'error')
                            setTimeout(() => {
                                this.$goRouter('admin.projects')
                            }, 2000)
                        }
                    })
                    .catch(error => {
                        this.loadSkeleton = false
                        this.$refs.snackbar.showSnack(('Error getting project data') + ': ' + error, 'error')
                    })
            },
			clickSaveProject () {
                if(this.isFormValid){
                    this.project_link = this.$encryptWithAES(this.name + new Date())
                    let formData = {
                        name: this.name,
                        description: this.description,
                        start_date: this.start_date,
                        end_date: this.end_date,
                        budget: this.budget,
                        constraints: this.constraints,
                        final_cost: this.final_cost,
                        client_id: this.client_id,
                        teamMembers: this.teamMembers,
                        project_link: this.project_link
                    }
                    this.$refs.snackbar.showSnack('Saving project, wait a moment please', 'success')
                    if(!this.editMode){
                        axios.post('/api/v1/projects', formData)
                            .then(response => {
                                if(response.data.status === 'SUCCESS') {
                                    this.$goRouter('admin.projects')
                                } else {
                                    this.$refs.snackbar.showSnack(response.data.message, 'error')
                                }
                            })
                            .catch(error => {
                                this.$refs.snackbar.showSnack(error, 'error')
                            })
                    }else{
                        axios.put('/api/v1/projects/' + this.projectId, formData)
                            .then(response => {
                                if(response.data.status === 'SUCCESS') {
                                    this.$goRouter('admin.projects')
                                } else {
                                    this.$refs.snackbar.showSnack(response.data.message, 'error')
                                }
                            })
                            .catch(error => {
                                this.$refs.snackbar.showSnack(error, 'error')
                            })
                    }
                }else{
                    this.$refs.snackbar.showSnack('Please complete the required fields', 'error')
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
