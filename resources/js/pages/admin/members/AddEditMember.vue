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
                <s-input-text :label="'Email'" v-model="email"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Phone'" v-model="phone"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-input-text :label="'Position'" v-model="position"></s-input-text>
            </div>
            <div class="flex-container-col">
                <s-file-input v-model="picture" :label="'Picture'"></s-file-input>
            </div>
            <div class="flex-container-col">
                <img style="max-width: 100px" :src="'/members/' + picturePath" v-if="picturePath">
            </div>
        </div>
        <div>
            <s-textarea :label="'Background'" v-model="description"></s-textarea>
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
                picturePath: ''
			}
        },
        mounted () {
            this.$nextTick(function () {
                if (!_.isEmpty(this.$route.params)) {
                    this.editMode = true
                    this.memberId = this.$route.params.id
                    this.getMemberData()
                }
            })
        },
		methods: {
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
                            this.$refs.snackbar.showSnack(info.message)
                            setTimeout(() => {
                                this.$goRouter('admin.members')
                            }, 2000)
                        }
                    })
                    .catch(error => {
                        this.$refs.snackbar.showSnack(('Error getting member data') + ': ' + error)
                    })
            },
			clickSaveMember () {
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

                if(!this.editMode){
                    axios.post('/api/v1/members', formData)
                        .then(response => {
                            if(response.data.status === 'SUCCESS') {
                                this.$goRouter('admin.members')
                            } else {
                                this.$refs.snackbar.showSnack(response.data.message)
                            }
                        })
                        .catch(error => {
                            this.$refs.snackbar.showSnack(error)
                        })
                }else{
                    formData.append('_method','put');
                    axios.post('/api/v1/members/' + this.memberId, formData)
                        .then(response => {
                            if(response.data.status === 'SUCCESS') {
                                this.$goRouter('admin.members')
                            } else {
                                this.$refs.snackbar.showSnack(response.data.message)
                            }
                        })
                        .catch(error => {
                            this.$refs.snackbar.showSnack(error)
                        })
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
