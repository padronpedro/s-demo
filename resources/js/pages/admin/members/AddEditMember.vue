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
                <s-input-text
                    :label="'Name'"
                    v-model="name"
                    :name="'name'"
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
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text
                    :label="'Position'"
                    v-model="position"
                    :name="'position'"
                    :isRequired="true"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text
                    :label="'Phone'"
                    v-model="phone"
                    :name="'phone'"
                    @reportError="processError">
                </s-input-text>
            </div>
            <div class="flex-container-col">
                <s-file-input
                    v-model="picture"
                    :label="'Picture'">
                </s-file-input>
            </div>
            <div class="flex-container-col">
                <img
                    style="max-width: 100px"
                    :src="'/members/' + picturePath"
                    v-if="picturePath" />
            </div>
        </div>
        <div>
            <s-textarea
                :label="'Background'"
                v-model="description"
                :name="'description'"
                @reportError="processError">
            </s-textarea>
        </div>
        <div class="box-bottom">
            <s-button :buttonText="'Save'" @clickAction="clickSaveMember"></s-button>
            <s-button :buttonText="'Cancel'" @clickAction="clickCancelMember"></s-button>
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
				position: '',
				description: '',
                editMode: false,
                snackText: '',
                memberId: '',
                picture: null,
                picturePath: '',
                formErrors: [],
                breadCrumbs: [
                    { text: 'Home', link: 'admin.home'},
                    { text: 'Members', link: 'admin.members'},
                    { text: 'Member information', link: ''},
                ]
			}
        },
        computed: {
            isFormValid () {
                if ((this.formErrors.length === 0) && this.name && this.position && this.email){
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
                    this.memberId = this.$route.params.id
                    this.getMemberData()
                }else{
                    this.formErrors = ['name', 'position', 'email']
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
            getMemberData () {
                axios.get('/api/v1/members/' + this.memberId, {})
                    .then(response => {
                        let info = response.data
                        if(info.status === 'SUCCESS') {
                            this.name = info.data.name;
                            this.email = info.data.email;
                            this.phone = info.data.phone;
                            this.position = info.data.position;
                            this.description = info.data.description;
                            this.picturePath = info.data.picture;
                        } else {
                            this.$refs.snackbar.showSnack(info.message, 'error')
                            setTimeout(() => {
                                this.$goRouter('admin.members')
                            }, 2000)
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(('Error getting member data') + ': ' + error, 'error')
                    })
            },
			clickSaveMember () {
                if(this.isFormValid){
                    let formData = new FormData();
                    if(this.picture)
                    {
                        formData.append('picture',this.picture, this.picture.name);
                    }

                    formData.append('name', this.name);
                    formData.append('email', this.email);
                    formData.append('phone', this.phone);
                    formData.append('position', this.position);
                    formData.append('description', this.description);

                    this.$refs.snackbar.showSnack('Saving member information, wait a moment please', 'success')

                    if(!this.editMode){
                        axios.post('/api/v1/members', formData)
                            .then(response => {
                                if(response.data.status === 'SUCCESS') {
                                    this.$goRouter('admin.members')
                                } else {
                                    this.$refs.snackbar.showSnack(response.data.message, 'error')
                                }
                            })
                            .catch(error => {
                                this.$refs.snackbar.showSnack(error, 'error')
                            })
                    }else{
                        formData.append('_method','put');
                        axios.post('/api/v1/members/' + this.memberId, formData)
                            .then(response => {
                                if(response.data.status === 'SUCCESS') {
                                    this.$goRouter('admin.members')
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
			clickCancelMember () {
				this.$goRouter('admin.members')
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
