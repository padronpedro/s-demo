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
                        :label="'Client name'"
                        v-model="name"
                        :name="'name'"
                        :isRequired="true"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Contact name'"
                        v-model="contact"
                        :name="'contact'"
                        :isRequired="true"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Address'"
                        v-model="address"
                        :name="'address'"
                        :isRequired="true"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Email'"
                        v-model="email"
                        :name="'email'"
                        :isRequired="true"
                        :typeInput="'email'"
                        @reportError="processError">
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                    <s-input-text
                        :label="'Phone'"
                        v-model="phone"
                        :name="'phone'"
                        @reportError="processError" >
                    </s-input-text>
                </div>
                <div class="flex-container-col">
                </div>
            </div>
            <div>
                <s-textarea
                    :label="'Notes'"
                    v-model="notes"
                    :name="'notes'"
                    @reportError="processError">
                </s-textarea>
            </div>
            <div class="box-bottom">
                <s-button :buttonText="'Save'" @clickAction="clickSaveClient"></s-button>
                <s-button :buttonText="'Cancel'" @clickAction="clickCancelClient"></s-button>
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
				email: '',
				phone: '',
				contact: '',
				address: '',
				notes: '',
                editMode: false,
                snackText: '',
                clientId: '',
                formErrors: [],
                breadCrumbs: [
                    { text: 'Home', link: 'home'},
                    { text: 'Clients', link: 'admin.clients'},
                    { text: 'Client information', link: ''},
                ]
			}
        },
        computed: {
            isFormValid () {
                if ((this.formErrors.length === 0) && this.name && this.contact && this.address && this.email){
                    return true
                }else{
                    return false
                }
            }
        },
        mounted () {
            this.$nextTick(function () {
                if (!_.isEmpty(this.$route.params)) {
                    this.editMode = true
                    this.clientId = this.$route.params.id
                    this.getClientData()
                    this.loadSkeleton = true
                }else{
                    this.formErrors = ['name', 'contact', 'address', 'email']
                }
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
            getClientData () {
                axios.get('/api/v1/clients/' + this.clientId, {})
                    .then(response => {
                        this.loadSkeleton = false
                        let info = response.data
                        if(info.status === 'SUCCESS') {
                            this.name = info.data.name;
                            this.email = info.data.email;
                            this.phone = info.data.phone;
                            this.contact = info.data.contact;
                            this.address = info.data.address;
                            this.notes = info.data.notes;

                        } else {
                            this.$refs.snackbar.showSnack(info.message, 'error')
                            setTimeout(() => {
                                this.$goRouter('admin.clients')
                            }, 2000)
                        }
                    })
                    .catch(error => {
                        this.loadSkeleton = false
                        this.$refs.snackbar.showSnack(('Error getting client data') + ': ' + error, 'error')
                    })
            },
			clickSaveClient () {
                if(this.isFormValid){

                    let formData = {
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        contact: this.contact,
                        address: this.address,
                        notes: this.notes
                    }
                    this.$refs.snackbar.showSnack('Saving client information, wait a moment please', 'success')
                    if(!this.editMode){
                        axios.post('/api/v1/clients', formData)
                            .then(response => {
                                if(response.data.status === 'SUCCESS') {
                                    this.$goRouter('admin.clients')
                                } else {
                                    this.$refs.snackbar.showSnack(response.data.message, 'error')
                                }
                            })
                            .catch(error => {
                                this.$refs.snackbar.showSnack(error, 'error')
                            })
                    }else{
                        axios.put('/api/v1/clients/' + this.clientId, formData)
                            .then(response => {
                                if(response.data.status === 'SUCCESS') {
                                    this.$goRouter('admin.clients')
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
			clickCancelClient () {
				this.$goRouter('admin.clients')
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
</style>
