<template>
    <div class="sinput">
        <label for="">{{label}}{{isRequired ? '* ' : ''}}<span style="color:red">{{errorInfo}}</span></label>
        <textarea
            class="input"
            rows="5"
            :required="isRequired"
            :name="name"
            @input="$emit('input',$event.target.value)"
            @blur="checkLabel($event)"
            v-model="$attrs.value">
        </textarea>
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
    bottom: 10px;
    left: 0;
    width: 0;
    height: 1px;
    background-color: black;
    -webkit-transition: width 250ms ease-in-out;
    transition: width 250ms ease-in-out;
}

.input:focus ~ .border {
    width: 100%;
    -webkit-transition: width 250ms ease-in-out;
    transition: width 250ms ease-in-out;
}

</style>
