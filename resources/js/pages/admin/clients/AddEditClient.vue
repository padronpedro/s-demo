<template>
  <div>
    <Menu />
    <div class="box-main-content">
      <div class="box-main-content-container">
        <div class="flex-container">
            <div class="flex-container-col">
                <s-input-text :label="'Name'" v-model="name"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Contact'" v-model="contact"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Address'" v-model="address"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Phone'" v-model="phone"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Email'" v-model="email"></s-input-text>
            </div>
            <div class="flex-container-col">
            </div>
        </div>
        <div>
            <s-textarea :label="'Notes'" v-model="notes"></s-textarea>
        </div>
        <div class="box-bottom">
            <s-button :buttonText="'Save'" @clickAction="clickSaveClient"></s-button>
            <s-button :buttonText="'Cancel'" @clickAction="clickCancelClient"></s-button>
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
				email: '',
				phone: '',
				contact: '',
				address: '',
				notes: '',
                editMode: false,
                snackText: '',
                clientId: ''
			}
        },
        mounted () {
            this.$nextTick(function () {
                if (!_.isEmpty(this.$route.params)) {
                    this.editMode = true
                    this.clientId = this.$route.params.id
                    this.getClientData()
                }
            })
        },
		methods: {
            getClientData () {
                axios.get('/api/v1/clients/' + this.clientId, {})
                    .then(response => {
                        let info = response.data
                        if(info.status === 'SUCCESS') {
                            this.name = info.data.name;
                            this.email = info.data.email;
                            this.phone = info.data.phone;
                            this.contact = info.data.contact;
                            this.address = info.data.address;
                            this.notes = info.data.notes;

                        } else {
                            this.$refs.snackbar.showSnack(info.message)
                            setTimeout(() => {
                                this.$goRouter('admin.clients')
                            }, 2000)
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(('Error getting client data') + ': ' + error)
                    })
            },
			clickSaveClient () {
                let formData = {
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                    contact: this.contact,
                    address: this.address,
                    notes: this.notes
                }
                if(!this.editMode){
                    axios.post('/api/v1/clients', formData)
                        .then(response => {
                            if(response.data.status === 'SUCCESS') {
                                this.$goRouter('admin.clients')
                            } else {
                                this.$refs.snackbar.showSnack(response.data.message)
                            }
                        })
                        .catch(error => {
                            this.$refs.snackbar.showSnack(error)
                        })
                }else{
                    axios.put('/api/v1/clients/' + this.clientId, formData)
                        .then(response => {
                            if(response.data.status === 'SUCCESS') {
                                this.$goRouter('admin.clients')
                            } else {
                                this.$refs.snackbar.showSnack(response.data.message)
                            }
                        })
                        .catch(error => {
                            this.$refs.snackbar.showSnack(error)
                        })
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
