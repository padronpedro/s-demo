<template>
    <div>
        <Menu />

        <div class="help-menu">
            Select an option from the menu
        </div>
        <div class="help-menu">
            <s-button :buttonText="'Log out'" @clickAction="$goRouter('home')"></s-button>
        </div>
    </div>
</template>

<script>
    export default {
    }
</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
.flex-container {
  display: flex;
  flex-wrap: wrap;
}

.flex-container-col {
  flex: 25%;
  margin: 10px;
  text-align: center;
  font-size: 30px;
}

@media screen and (max-width: 992px) {
  .flex-container-col {
    flex: 50%;
  }
}

@media screen and (max-width: 600px) {
  .flex-container-col {
    flex-direction: column;
  }
}
.pic-team-list {
    display: inline-block;

}
.help-menu{
    margin-top:100px;
    text-align: center;
    font-weight: bold;
}
</style>
