<template>
  <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="top">
                <div class="logo"><img src="../assets/signifly.svg" width="30%"></div>
                <div class="top-titles">
                    <div class="title">{{name}}</div>
                    <div class="subtitle">{{position}}</div>
                    <div class="subtitle2">{{email}}  {{phone}}</div>
                </div>
            </div>
            <div class="modal-main-content" >
                <div class="row">
                    <div class="column">
                        <p style="text-align:justify">{{description}}</p>
                        <div class="list-chip">
                            <div v-for="(oneSkill,index) in skills" :key="index" class="one-chip">
                                <one-chip :chipText="oneSkill" />
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="imageBox">
                            <img :src="'/members/' + (picturePath ? picturePath : 'no_image.jpeg')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="modal-btn">
                    <s-button
                        :buttonText="'Close'"
                        @clickAction="closeModal"
                        style="float:right" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data () {
    return {
        loadSkeleton: false,
        infoMember: '',
        name: '',
        email: '',
        phone: '',
        position: '',
        skills: '',
        description: '',
        picturePath: '',
    }
  },
  watch: {
      infoMember () {

      }
  },
  methods: {
    getMemberInfo() {
        this.loadSkeleton = true
        axios.get('/api/v1/members/' + this.infoMember, {})
            .then(response => {
                this.loadSkeleton = false
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.name = info.data.name;
                    this.email = info.data.email;
                    this.phone = info.data.phone;
                    this.position = info.data.position;
                    this.description = info.data.description;
                    this.picturePath = info.data.picture;
                    let aux  = info.data.skills
                    if(aux){
                        this.skills = aux.split(',')
                    }else{
                        this.skills = []
                    }
                } else {
                    setTimeout(() => {
                        this.closeModal()
                    }, 2000)
                }
            })
            .catch(error => {
                this.loadSkeleton = false
                console.log(error)
            })
    },
    openModal (auxMember) {
      var modal = document.getElementById('myModal')
      modal.style.display = 'block'
      this.infoMember = auxMember
      this.getMemberInfo()
    },
    closeModal () {
        this.infoMember = ''
        this.name = ''
        this.email = ''
        this.phone = ''
        this.position = ''
        this.description = ''
        this.picturePath = ''
        var modal = document.getElementById('myModal')
        modal.style.display = 'none'
        this.$emit('closeModalMember')
    },
  }
}
</script>

<style scoped>
.column {
  float: left;
  width: 44%;
  padding: 10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.modal-main-content {
  overflow: auto;
  height: 70%;
}
.modal-main-content div{
    display: inline-block;
}
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  height: 450px;
}
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.modal-btn {
  float: right;
}
.bottom {
  padding-top: 15px;
}
.bottom div{
  margin-right: 5px;
}
.imageBox {
  text-align: center;
}
.imageBox img{
  width: 70%;
}
.logo {
  display: block;
  margin:auto;
  margin-left: 5px;
  margin-right: 10px
}
.logo img {
  width: 110px;
  padding-top:10px;
  padding-left: 5px;
}
.top{
  height: 70px;
}
.top div {
  display: inline-block;
  text-align: left;
}
.top-titles{
  display: flex;
  flex-direction: column;
  justify-content: center;
  overflow: auto;
}
.top-titles div {
  display: block;
  overflow: auto;
}

.title {
  font-weight: bold;
  font-size: 18px;
}
.subtitle {
  font-weight: bold;
  font-size: 14px;
}
.subtitle2 {
  font-size: 12px;
}

.list-chip{
  display: flex;
  flex-wrap: wrap;
}
.list-chip div{
  display: inline-block;
}
</style>
