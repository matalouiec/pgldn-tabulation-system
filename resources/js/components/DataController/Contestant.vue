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
import axios from "axios";
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
    toggleCheck(score) {
      axios
        .post("/rating/change-state", { ratingid: score.id })
        .then(response => {
          if (response.data && response.status == 200) {
            this.$notify({
              group: "app-notification",
              type: "success",
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
        });
    }
  }
};
</script>
