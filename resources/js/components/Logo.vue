<template>
    <div>
        <a href="https://signifly.com" target="_blank">
            <inline-svg
                :src="mySVG"
                width="70%"
                height="70%"
                fill="black"
                aria-label="logoSG">
            </inline-svg>
        </a>
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
