<template>
    <div>
        <div>
            <div class="title-form">
                Project DEMO
            </div>
        </div>

        <div class="title-info">
            <span>
                Please select an option to continue
            </span>
        </div>

        <div class="flex-container">
            <div class="flex-container-col">
                <s-button :buttonText="'Project request'" @clickAction="$goRouter('client.project.request')"></s-button>
            </div>
            <div class="flex-container-col">
                <s-button :buttonText="'Administrator'" @clickAction="$goRouter('admin.home')"></s-button>
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
    methods: {
    }
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

</style>
