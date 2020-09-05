<template>
  <div class="btn">
        <a @click.prevent="callAction(valueCall)">
            <i class="material-icons">{{iconName}}</i>
        </a>
    </div>
</template>

<script>
export default {
  data () {
    return {

    }
  },
  props: {
    name: {
      type: String,
      required: true
    },
    iconName: {
        type: String,
        required: true
    },
    valueCall: {
      type: String,
      required: false
    }
  },
  methods: {
    callAction (value) {
      this.$emit('actionCalled', value)
    }
  }
}
</script>

<style scoped>

.btn a {
  text-decoration: none;
  color:black;
  text-transform:uppercase;
  font-size: 14px;
}
.btn a:hover {
  color: gray;
  cursor: pointer;
}

</style>
