<template>
    <div class="sinput">
        <label for="">{{label}}{{isRequired ? '* ' : ''}}<span style="color:red">{{errorInfo}}</span></label>
        <textarea
            class="inText"
            rows="5"
            :required="isRequired"
            :name="name"
            @input="$emit('input',$event.target.value)"
            @blur="checkLabel($event)"
            v-model="$attrs.value">
        </textarea>
        <span class="inSpan"></span>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                errorInfo: ''
            }
        },
        props: {
            label: {
                type: String,
                required: true
            },
            isRequired: {
                type: Boolean,
                required: false,
                default: false
            },
            name: {
                type: String,
                required: true
            }
        },
        methods: {
            checkLabel (e) {
                if(this.isRequired){
                    this.errorInfo = e.target.validationMessage
                    if(this.errorInfo){
                        this.$emit('reportError', this.name, true)
                    }else{
                        this.$emit('reportError', this.name, false)
                    }
                }
            }
        }
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
