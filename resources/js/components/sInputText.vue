<template>
    <div class="sinput">
        <label for="">{{label}}{{isRequired ? '* ' : ''}}<span style="color:red">{{errorInfo}}</span></label>
        <input
            :type="typeInput"
            class="input"
            @input="$emit('input',$event.target.value)"
            :value="$attrs.value"
            :required="isRequired"
            :autocomplete="'new-password'"
            :name="name"
            :readonly="readOnly"
            @blur="checkLabel($event)"
            :style="(typeInput==='text') ? 'margin-top: 15px;' : 'margin-top: 8px;'">
        <span class="border"></span>
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

.input {
    width: 100%;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border: none;
    padding: 10px 0;
    border-bottom: 1px solid #ccc;
}

.input:focus {
    outline: none;
}

.input ~ .border {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 1px;
    background-color: black;
    -webkit-transition: width 200ms ease-in-out;
    transition: width 200ms ease-in-out;
}

.input:focus ~ .border {
    width: 100%;
    -webkit-transition: width 200ms ease-in-out;
    transition: width 200ms ease-in-out;
}

</style>
