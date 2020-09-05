<template>
  <div class="BlogPost o-media">
    <div class="o-media__body">
      <div class="o-vertical-spacing">
        <h3 class="BlogPost__headline" v-for="(elemen,index) in listItems" :key="index">
          <skeleton-box
            v-if="loading"
            :min-width="30"
            :max-width="30"
          />
          <skeleton-box
            v-if="loading"
            :min-width="30"
            :max-width="30"
          />
          <skeleton-box
            v-if="loading"
            :min-width="30"
            :max-width="30"
          />
          <slot
            v-else
            name="headline"
          />
        </h3>
      </div>
    </div>
  </div>
</template>

<script>
import SkeletonBox from './Skeleton.vue';

export default {
  name: `TemplateSkeleton`,
  data () {
      return {
          listItems: [1,2,3,4,5,6,7]
      }
  },
  components: {
    SkeletonBox,
  },
  props: {
    loading: {
      default: false,
      type: Boolean,
    },
  },
};
</script>

<style lang="scss">
.BlogPost {
  &__headline {
    font-size: 1.25em;
    font-weight: bold;
  }

  &__meta {
    font-size: 0.85em;
    color: #6b6b6b;
  }
}
</style>
