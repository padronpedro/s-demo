<template>
    <div class="one-chip">
        {{chipText}}
        <slot />
    </div>
</template>

<script>
export default {
  name: "oneChip",
  data() {
    return {
    };
  },
  props: ['chipText'],
  mounted() {
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.one-chip{
 margin: 10px;
  margin-right: 5px;
  background-color: black;
  color: white;
  padding: 0 25px;
  cursor: pointer;
  border-radius: 50px;
  line-height: 30px;
  height: 30px;
  font-size: 14px;
  font-weight: 200;
}
</style>
