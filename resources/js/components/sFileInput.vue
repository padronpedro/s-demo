<template>
    <div class="sinput">
        <label class="upper-label" >{{label}}</label>
        <label class="file-select">
            <div class="select-button">
            <span v-if="value" class="file-selected-name">
                <i class="material-icons">attach_file</i>
                Selected file: {{value.name}}
            </span>
            <span v-else>
                <i class="material-icons">attach_file</i>
                Select a file</span>
            </div>
            <input
                type="file"
                @change="handleFileChange"
                accept="image/png, image/jpeg, image/png, image/gif"
                />
        </label>
        <span class="inSpan"></span>
    </div>
</template>

<script>
export default {
  props: {
    value: File,
    label: String
  },
  methods: {
    handleFileChange(e) {
      this.$emit('input', e.target.files[0])
    }
  }
}
</script>

<style scoped>
.sinput {
    width: 100%;
    margin-top: 32px;
    position: relative;
    border-bottom: 1px solid #ccc;
}
.file-selected-name {
    margin-top: 38px;
}
.upper-label {
    display: block;
    font-weight: 500;
    color: black;
    font-size: 12px;
    text-align: left;
    margin-bottom: 10px;
}
.file-select > .select-button {
  color: black;
  background-color: white;
  text-align: left;
  font-weight: bold;
  font-size: 14px;
  margin-top: 14px;
}

.file-select > input[type="file"] {
  display: none;
}
</style>
