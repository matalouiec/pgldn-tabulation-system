<template>
  <div class="list-group">
    <a class="list-group-item list-group-item-action">
      <b-form-checkbox
        v-model="rating.is_final==1"
        :name="'R'+rating.id"
        v-on:change="toggleCheck(rating)"
        switch
      >
        &nbsp;
        <label>#{{ rating.number }} -</label>
        <label>{{ rating.name }}</label>
      </b-form-checkbox>
    </a>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  props: {
    rating: {
      type: Object,
      required: true
    }
  },
  data() {
    return {};
  },
  methods: {
    ...mapActions(["toggleScoreState"]),

    toggleCheck(score) {
      let res = this.toggleScoreState(score.id);
      if (res) {
        this.$notify({
          group: "app-notification",
          type: "information",
          title: "Success!!!",
          text: "Change State"
        });
      } else {
        this.$notify({
          group: "app-notification",
          type: "error",
          title: "Failed!!!",
          text: "Failure to change state"
        });
      }
    }
  }
};
</script>
