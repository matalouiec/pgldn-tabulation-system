<template>
  <div class="list-group">
    <button
      v-for="judge in judgesList"
      v-on:click="onJudgeClick(judge)"
      :key="judge.id"
      type="button"
      class="list-group-item list-group-item-action"
      v-bind:class="{ active : selectedJudgeInfo == judge }"
    >{{ judge.name }}</button>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "judges",
  data() {
    return {};
  },
  computed: {
    ...mapGetters(["judgesList", "selectedJudgeInfo"])
  },
  methods: {
    ...mapActions(["fetchJudges", "setSelectedJudge", "fetchCategories"]),
    onJudgeClick(x) {
      this.setSelectedJudge(x); //trigger change on active button
      this.fetchCategories(x.id); //triggers the change on categories
    }
  },
  created() {
    this.fetchJudges();
  }
};
</script>

