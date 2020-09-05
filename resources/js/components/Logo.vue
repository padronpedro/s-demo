<template>
    <div>
        <a href="https://signifly.com" target="_blank"><img :src="mySVG" width="70%"></a>
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
