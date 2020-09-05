<template>
    <div>
        <div>
            <div class="title-form">
                We didn't found this page
            </div>
            <div class="button-contact">
                <s-button :buttonText="'Go to Home'" @clickAction="$goRouter('home')"></s-button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data () {
        return {
        }
    },
}
</script>

<style scoped>
.button-contact {
    text-align: center;
}
</style>
