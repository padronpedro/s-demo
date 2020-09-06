<template>
    <div class="custom-select-wrapper">
        <label for="">{{label}}</label>
        <div class="custom-select">
            <div class="custom-select__trigger"><span>{{getSelectedText()}}</span>
                <div class="arrow"></div>
            </div>
            <div class="custom-options">
                <span
                    v-for="(oneOption, index) in optionItems" :key="index"
                    :class="{'custom-option': true, 'selected': checkSelected(oneOption.id, $attrs.value, index)}"
                    :data-value="oneOption.id"
                    >
                    {{oneOption.name}}
                </span>
            </div>
            <span class="inSpan"></span>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {

            }
        },
        computed: {
            auxId () {
                return this.$attrs.value
            }
        },
        props: {
            label: {
                type: String,
                required: true
            },
            optionItems: {
                type: Array,
                required: true
            }
        },
        watch: {
            optionItems (item) {
                this.$nextTick(function () {
                    if(item.length>0){
                        this.loadListener()
                    }
                })
            }
        },
        mounted() {
        },
        beforeDestroy () {
            for (const option of document.querySelectorAll(".custom-option")) {
                option.removeEventListener('click', function() {})
            }
            window.removeEventListener('click', function(e) {
                const select = document.querySelector('.custom-select')
                if(select){
                    if (!select.contains(e.target)) {
                        select.classList.remove('open');
                    }
                }
            });
        },
        methods: {
            loadListener () {
                let extThis = this;
                if(extThis.$attrs.value){
                    let aux = _.find(this.optionItems, elemen => {
                        return elemen.id === Number(extThis.$attrs.value)
                    })

                    if(aux){
                        $('.custom-select__trigger span').text(aux.name)
                    }
                }

                document.querySelector('.custom-select-wrapper').addEventListener('click', function() {
                    this.querySelector('.custom-select').classList.toggle('open');
                })
                for (const option of document.querySelectorAll(".custom-option")) {
                    option.addEventListener('click', function() {
                        if(this.classList){
                            if (!this.classList.contains('selected')) {
                                this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
                                this.classList.add('selected');

                                this.closest('.custom-select').querySelector('.custom-select__trigger span').textContent = this.textContent;
                                extThis.$emit('input',$(this).attr('data-value'));
                            }
                        }
                    })
                }
                window.addEventListener('click', function(e) {
                    const select = document.querySelector('.custom-select')
                    if(select){
                        if (!select.contains(e.target)) {
                            select.classList.remove('open');
                        }
                    }
                });

            },
            checkSelected(listId, idSelected, index) {
                if(idSelected) {
                    return (listId === Number(idSelected))
                } else {
                    return (index===0)
                }
            },
            getSelectedText() {
                if(this.optionItems.length>0){
                    if(this.auxId){
                        let aux = _.find(this.optionItems, elemen => {
                            return elemen.id === Number(this.auxId)
                        })
                        return aux.name
                    }else{
                        return (this.optionItems[0].name)
                    }
                }else{
                    return '';
                }
            }
        }
    }

</script>

<style scoped>
.custom-select-wrapper {
     position: relative;
     user-select: none;
     width: 100%;
     margin-bottom:12px;
}
 .custom-select {
     position: relative;
     display: flex;
     flex-direction: column;
     border: none;
}
 .custom-select__trigger {
     position: relative;
     display: flex;
     align-items: center;
     justify-content: space-between;
     padding: 0 0px;
     font-size: 20px;
     font-weight: bold;
     color: #3b3b3b;
     height: 60px;
     line-height: 60px;
     background: #ffffff;
     cursor: pointer;
     border-bottom: 1px solid black;
     font-weight: 900;
}
.custom-select-wrapper label {
    display: block;
    font-weight: 500;
    color: black;
    font-size: 12px;
    text-align: left;
}
 .custom-options {
     position: absolute;
     display: block;
     top: 100%;
     left: 0;
     right: 0;
     border-top: 0;
     background: #fff;
     transition: all 0.5s;
     opacity: 0;
     visibility: hidden;
     pointer-events: none;
     z-index: 2;
}
 .custom-select.open .custom-options {
     opacity: 1;
     visibility: visible;
     pointer-events: all;
}
 .custom-option {
     position: relative;
     display: block;
     padding: 0 22px 0 22px;
     font-size: 20px;
     font-weight: 300;
     color: #ccc;
     line-height: 60px;
     cursor: pointer;
     transition: all 0.5s;
     text-align: left;
}
 .custom-option:hover {
     cursor: pointer;
     background-color: rgb(247, 247, 247);
     color: black;
}
 .custom-option.selected {
     color: #000;
     font-weight: 800;
}
.arrow {
     position: relative;
     height: 15px;
     width: 15px;
}
 .arrow::before, .arrow::after {
     content: "";
     position: absolute;
     bottom: 0px;
     width: 0.15rem;
     height: 100%;
     transition: all ;
}
 .arrow::before {
     left: -5px;
     transform: rotate(-45deg);
     background-color: #394a6d;
}
 .arrow::after {
     left: 5px;
     transform: rotate(45deg);
     background-color: #394a6d;
}
 .open .arrow::before {
     left: -5px;
     transform: rotate(45deg);
}
 .open .arrow::after {
     left: 5px;
     transform: rotate(-45deg);
}

.custom-select + span {
    display: block;
    border-bottom: 1px solid black;
    width: 0;
    -webkit-transition: width 350ms ease-in-out;
    transition: width 350ms ease-in-out;
}
.custom-select:focus + span {
    width: 90%;
    -webkit-transition: width 300ms ease-in-out;
    transition: width 300ms ease-in-out;
}
</style>
