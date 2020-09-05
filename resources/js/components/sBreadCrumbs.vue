<template>
    <div class="bread-main">
        <div v-for="(oneItem, index) in listLink" :key="index">
            <a @click.prevent="$goRouter(oneItem.link)" v-if="oneItem.link">
                {{oneItem.text}}
            </a>
            <span v-else>{{oneItem.text}}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        listLink: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>
.bread-main{
    margin-top: 20px;
    margin-left: 10px;
}
.bread-main a {
    cursor: pointer;
    color: black;
}
.bread-main a:hover {
    color: gray;
}
.bread-main div:not(larst-child) a:after {
  padding-left: 10px;
  content: "/";
}
.bread-main div {
    display: inline-block;
    margin-right: 20px;
}
</style>
