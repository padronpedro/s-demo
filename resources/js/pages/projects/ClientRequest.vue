<template>
    <div>
        <div>
            <div class="title-form">
                Project Request
            </div>
            <span>
                Already have a digital project in mind? Or simply have a digital challenge you’re not sure how to solve. We would be happy to help you!.
                Fill out the form, and we look forward to build your project.
            </span>
        </div>

        <div class="title-info-client">
            Tell us about you and your company to be able to contact you soon.
        </div>
        <div class="flex-container">
            <div class="flex-container-col">
                <s-input-text
                    :label="'Company name'"
                    v-model="client_name"
                    :name="'client_name'"
                    :isRequired="true"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text
                    :label="'Contact name'"
                    v-model="client_contact"
                    :name="'client_contact'"
                    :isRequired="true"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text
                    :label="'Address'"
                    v-model="client_address"
                    :name="'client_address'"
                    :isRequired="true"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text
                    :label="'Email'"
                    v-model="client_email"
                    :typeInput="'email'"
                    :isRequired="true"
                    :name="'client_email'"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text
                    :label="'Phone'"
                    v-model="client_phone"
                    :name="'client_phone'"
                    @reportError="processError">
                </s-input-text>
            </div>
        </div>

        <div class="title-info-client">
            Now you can tell us about the project that you want to have.
        </div>

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
                    :label="'Estimated start date'"
                    :typeInput="'date'"
                    v-model="start_date"
                    :name="'start_date'"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text
                    :label="'Budget'"
                    v-model="budget"
                    :typeInput="'number'"
                    :name="'budget'"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-textarea
                    :label="'Description'"
                    v-model="description"
                    :isRequired="true"
                    :name="'description'"
                    @reportError="processError">
                </s-textarea>
            </div>
            <div class="flex-container-col">
                <s-textarea
                    :label="'Constraints'"
                    v-model="constraints"
                    :name="'constraints'"
                    @reportError="processError">
                </s-textarea>
            </div>
        </div>


        <div class="title-info-client">
            Our team is composed of experts in the fields of strategy, design and technology. We design strong concepts and bring them to life through confident digital craftsmanship.
            You can build your dream team to build your project!.
        </div>
        <div style="margin-bottom: 10px">
            <h4>Select your build team</h4>

            <div v-for="(oneItem,index) in dataTable" :key="index" class="pic-team-list">
                <s-team-card
                    :name="oneItem.name"
                    :position="oneItem.position"
                    :picture="oneItem.picture"
                    @checkboxResult="setTeamMembers"
                    :initialValues="[]"
                    :id="oneItem.id"  />
            </div>

        </div>
        <div class="box-bottom">
            <s-button :buttonText="'Send Request'" @clickAction="clickSendRequest"></s-button>
            <s-button :buttonText="'Cancel'" @clickAction="clickCancelRequest"></s-button>
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
            budget: '',
            constraints: '',
            teamMembers: [],
            dataTable: [],
            snackText: '',
            client_name: '',
            client_contact: '',
            client_address: '',
            client_phone: '',
            client_email: '',
            formErrors: []
        }
    },
    computed: {
        isFormValid () {
            if ((this.formErrors.length === 0) && this.client_name && this.client_contact && this.client_address && this.name && this.description){
                return true
            }else{
                return false
            }
        }
    },
    mounted () {
        this.$nextTick(function () {
            this.getTeamList()
            this.formErrors = ['client_name', 'client_contact', 'client_address', 'name', 'description']
        })
    },
    methods: {
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
        clickSendRequest () {
            if(this.isFormValid){
                let formDataClient = {
                    name: this.client_name,
                    contact: this.client_contact,
                    address: this.client_address,
                    phone: this.client_phone,
                    email: this.client_email
                }
                // Save client information
                axios.post('/api/v1/clients', formDataClient)
                    .then(response => {
                        if(response.data.status === 'SUCCESS' || response.data.data.id) {
                            this.project_link = this.$encryptWithAES(this.name + new Date())
                            let formData = {
                                name: this.name,
                                description: this.description,
                                start_date: this.start_date,
                                budget: this.budget,
                                constraints: this.constraints,
                                client_id: response.data.data.id,
                                teamMembers: this.teamMembers,
                                project_link: this.project_link
                            }

                            this.$refs.snackbar.showSnack('Sending your request, wait a moment please', 'success')
                            // Save project request information
                            axios.post('/api/v1/projects', formData)
                                .then(response_project => {
                                    if(response_project.data.status === 'SUCCESS') {
                                        this.$refs.snackbar.showSnack('Project request sent successfully', 'success')
                                        setTimeout(() => {
                                            this.$goRouter('home')
                                        }, 2000)
                                    } else {
                                        this.$refs.snackbar.showSnack(response_project.data.message, 'error')
                                    }
                                })
                                .catch(error => {
                                    this.$refs.snackbar.showSnack(error, 'error')
                                })

                        } else {
                            this.$refs.snackbar.showSnack(response.data.message, 'error')
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(error, 'error')
                    })
            }else{
                this.$refs.snackbar.showSnack('Please complete the required fields', 'error')
            }
        },
        clickCancelRequest () {
            this.$goRouter('home')
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
                    this.$refs.snackbar.showSnack(('Error getting members data') + ': ' + error, 'error')
                })
        },
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
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
