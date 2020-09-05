<template>
    <div class="pic-box">
        <div class="pic-box-img" @click="showDetails()">
            <img :src="'/members/' + (picture ? picture : 'no_image.jpeg')">
        </div>
        <div class="pic-box-name">
            {{name}}
        </div>
        <div class="pic-box-position">
            {{position}}
        </div>
        <div class="pic-box-check" v-if="!hideCheck">
            <div class="pic-box-check-top-select">
                <label class="pic-box-container">
                    <input type="checkbox"  v-model="checked" @change="callAction(id)" :value="id">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="pic-box-check-select">
                Select
            </div>
        </div>
        <modal-member-card ref="modalMember" />
    </div>
</template>

<script>
export default {
  data () {
    return {
        checkedProxy: false,
        checked: false
    }
  },
  mounted () {
      this.$nextTick(function () {
          this.verifyCheck()
          })
  },
  watch: {
      initialValues (auxList) {
          this.verifyCheck()
      }
  },
  props: {
    picture: {
        type: String,
        required: false,
        default: 'no_image.jpeg'
    },
    name: {
        type: String,
        required: true
    },
    position: {
      type: String,
      required: false
    },
    id: {
        type: Number,
        required: true
    },
    initialValues: {
        type: Array,
        required: false,
        default: []
    },
    hideCheck: {
        type: Boolean,
        required: false,
        default: false
    }
  },
  methods: {
      showDetails() {
          this.$refs.modalMember.openModal(this.id)
      },
      verifyCheck () {
        let auxList = this.initialValues
        if(auxList){
              let aux = auxList.find(elemen => {
                  return elemen === this.id
              })
              if(aux) {
                  this.checkedProxy = true
                  this.checked = true
              }
          }
      },
      callAction (id) {
          this.$emit('checkboxResult',this.checked, id)
      }
  }
}
</script>

<style scoped>
.pic-box {
    padding: 20px;
    width: 200px;
}
.pic-box-img{
    text-align: center;
    cursor: pointer;
}
.pic-box-img img{
    max-width: 120px
}
.pic-box-name {
    text-align: center;
    font-size: 14px;
    font-weight: bold;
}
.pic-box-position{
    text-align: center;
    font-size: 12px;
    font-weight: bold;
}
.pic-box-check{
    text-align: center;
}
.pic-box-container {
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 14px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.pic-box-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}
.pic-box-check-select{
    margin-top:12px;
    font-size: 12px;
    margin-right: 10px;
}
.pic-box-check-top-select{
    margin-top: 10px;
}
/* On mouse-over, add a grey background color */
.pic-box-container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.pic-box-container input:checked ~ .checkmark {
  background-color: black;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.pic-box-container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.pic-box-container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
