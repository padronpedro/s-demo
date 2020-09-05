<template>
    <div>
        <img :src="mySVG" width="70%">
    </div>
</template>

<script>
export default {
    data(){
    return {
      mySVG: require('../assets/signifly.svg')
    }
  }
}
</script>
