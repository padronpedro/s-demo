<template>
    <div class="sinput">
        <label for="">{{label}}</label>
        <textarea class="inText" rows="5"  @input="$emit('input',$event.target.value)" v-model="$attrs.value"></textarea>
        <span class="inSpan"></span>
    </div>
</template>

<script>
    export default {
        data () {
            return {
            }
        },
        props: {
            label: {
                type: String,
                required: true
            }
        },
    }
</script>

<style scoped>
.sinput {
    width: 100%;
    margin-top: 32px;
    position: relative;
}
.sinput label {
    display: block;
    font-weight: 500;
    color: black;
    font-size: 12px;
    text-align: left;
}
.sinput textarea{
    outline: 0;
    width: 100%;
    margin-top: 8px;
    padding: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border: none;
    background-color: transparent;
    font-size: 20px;
}
.sinput textarea:not(focus){
    border-bottom: 1px solid #ccc;
}
.sinput textarea:focus{
    border-bottom: 0px solid white;
}
.inText + span {
  display: block;
  border-bottom: 1px solid black;
  width: 0;
  -webkit-transition: width 350ms ease-in-out;
  transition: width 350ms ease-in-out;
}
.inText:focus + span {
  width: 90%;
  -webkit-transition: width 300ms ease-in-out;
  transition: width 300ms ease-in-out;
}

</style>
