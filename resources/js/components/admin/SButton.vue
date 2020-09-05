<template>
  <div>
    <button class="sbutton" @click="callAction">{{buttonText}}</button>
  </div>
</template>

<script>
  export default {
    data () {
      return {

      }
    },
    props: {
      buttonText: {
        type: String,
        required: true
      }
    },
    methods: {
        callAction () {
            this.$emit('clickAction')
        }
    }
  }
</script>

<style scoped>
.sbutton {
  appearance: none;
  border: none;
  background-color: #000;
  padding: 16px 32px;
  margin-left: 10px;
  color: #fff;
  cursor: pointer;
}

.sbutton:hover, .sbutton:active {
  background-color: #333;
}
</style>
