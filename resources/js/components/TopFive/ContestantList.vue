<template>
  <b-form-group label="Contestants">
    <b-form-checkbox
      v-for="contestant in contestantList"
      v-model="selected"
      :key="contestant.id"
      :value="contestant.id"
      name="flavour-3a"
    >#{{ contestant.number }} - {{ contestant.name }}</b-form-checkbox>
  </b-form-group>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      selected: []
    };
  },
  methods: {
    ...mapActions(["fetchContestants"])
  },
  computed: {
    ...mapGetters(["contestantList"])
  },
  created() {
    this.fetchContestants();
  }
};
</script>