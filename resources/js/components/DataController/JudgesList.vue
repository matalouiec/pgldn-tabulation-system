<template>
  <div class="list-group">
    <button
      v-for="judge in judgesList"
      v-on:click="setSelectedJudge(judge)"
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
    ...mapActions(["fetchJudges", "setSelectedJudge"])
  },
  created() {
    this.fetchJudges();
  }
};
</script>

