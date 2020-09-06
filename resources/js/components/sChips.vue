<template>
  <div>
      <s-input-text
        :label="label"
        :name="'inChip'"
        v-model="auxChip"
        @input="$emit('input',allChips)"
        @auxkeyup="addChip"
        @reportError="processError">
    </s-input-text>

    <div class="list-chip">
      <div
        v-for="(oneChip,index) in allChips"
        :key="index"
        >
        <one-chip :chipText="oneChip"><span class="closebtn" @click="deleteChip(index)">&times;</span></one-chip>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "sChips",
  data() {
    return {
      auxChip: "",
      allChips: []
    };
  },
  props: ['label'],
  mounted() {
      this.$nextTick(function () {
          if(this.$attrs.value.length>0)
          {
              this.allChips = this.$attrs.value
          }
      })
  },
  methods: {
      processError () {

      },
    addChip (e) {
      if (e.keyCode === 13) {
        this.allChips.push(this.auxChip)
        this.auxChip=''
      }
    },
    deleteChip (value){
      this.allChips.splice(value,1)
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.list-chip{
  display: flex;
  flex-wrap: wrap;
}
.list-chip div{
  display: inline-block;
}
.closebtn {
  padding-left: 10px;
  color: white;
  font-weight: 200;
  float: right;
  font-size: 20px;
  cursor: pointer;
}

.closebtn:hover {
  color: lightgray;
}
</style>
