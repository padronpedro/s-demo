<template>
    <div class="sinput">
        <label for="">{{label}}{{isRequired ? '* ' : ''}}<span style="color:red">{{errorInfo}}</span></label>
        <input
            :type="typeInput"
            class="inInput"
            @input="$emit('input',$event.target.value)"
            :value="$attrs.value"
            :required="isRequired"
            :autocomplete="'new-password'"
            :name="name"
            :readonly="readOnly"
            @blur="checkLabel($event)"
            :style="(typeInput==='text') ? 'margin-top: 15px;' : 'margin-top: 8px;'">
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
            typeInput: {
                type: String,
                required: false,
                default: 'text'
            },
            isRequired: {
                type: Boolean,
                required: false,
                default: false
            },
            name: {
                type: String,
                required: true
            },
            readOnly: {
                type: Boolean,
                required: false,
                default: false
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
    font-weight: bold;
    color: black;
    font-size: 12px;
    text-align: left;
}
.sinput input{
    outline: 0;
    width: 100%;
    padding: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border: none;
    background-color: transparent;
    font-size: 20px;
}
.sinput input:not(focus){
    border-bottom: 1px solid #ccc;
}
.sinput input:focus{
    border-bottom: 0px solid white;
}
.inInput + span {
  display: block;
  border-bottom: 1px solid black;
  width: 0;
  -webkit-transition: width 350ms ease-in-out;
  transition: width 350ms ease-in-out;
}
.inInput:focus + span {
  width: 99%;
  -webkit-transition: width 300ms ease-in-out;
  transition: width 300ms ease-in-out;
}

</style>
