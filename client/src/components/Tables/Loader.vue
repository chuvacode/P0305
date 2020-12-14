<template>
  <div class="loader" :style="{left: GET_SIDEBAR_IS_VISIBILITY ? 'calc(50% + 125px)' : '50%'}">
    <span class="loader__stick"></span>
    <span class="loader__stick"></span>
    <span class="loader__stick"></span>
    <span class="loader__stick"></span>
    <span class="loader__stick"></span>
  </div>
</template>

<script>

import { mapGetters } from 'vuex'
export default {
  name: 'Loader',
  computed: {
    ...mapGetters([
      'GET_SIDEBAR_IS_VISIBILITY'
    ])
  }
}
</script>

<style scoped>
  .loader {
    transition: left 1s ease;
    display: flex;
    align-items: center;
    position: absolute;
    transform: translate(-50%, 30px);
  }
  .loader__stick {
    width: 8px;
    height: 8px;
    border-radius: 2px;
    background: #cdcdcd;
    margin: 5px;
  }
  .loader__stick:nth-child(1) {
    animation: move-1 2s infinite;
  }
  .loader__stick:nth-child(2) {
    animation: move-2 2s infinite;
  }
  .loader__stick:nth-child(3) {
    animation: move-3 2s infinite;
  }
  .loader__stick:nth-child(4) {
    animation: move-4 2s infinite;
  }
  .loader__stick:nth-child(5) {
    animation: move-5 2s infinite;
  }
  @keyframes move-1 {
    0% {
      transform: translate(0, 0px);
    }
    25% {
      transform: scale(1, 1.3) translate(0, -3px);
    }
    50% {
      transform: scale(1, 1.3) translate(0, 3px);
    }
    100% {
      transform: translate(0, 0);
    }
  }
  @keyframes move-2 {
    0% {
      transform: translate(0, 0px);
    }
    25% {
      transform: scale(1, 1.5) translate(0, -5px);
    }
    50% {
      transform: scale(1, 1.5) translate(0, 5px);
    }
    100% {
      transform: translate(0, 0);
    }
  }
  @keyframes move-3 {
    0% {
      transform: translate(0, 0);
    }
    50% {
      transform: scale(1, 1.7);
    }
    100% {
      transform: translate(0, 0);
    }
  }
  @keyframes move-4 {
    0% {
      transform: translate(0, 0px);
    }
    25% {
      transform: scale(1, 1.5) translate(0, 5px);
    }
    50% {
      transform: scale(1, 1.5) translate(0, -5px);
    }
    100% {
      transform: translate(0, 0);
    }
  }
  @keyframes move-5 {
    0% {
      transform: translate(0, 0px);
    }
    25% {
      transform: scale(1, 1.3) translate(0, 3px);
    }
    50% {
      transform: scale(1, 1.3) translate(0, -3px);
    }
    100% {
      transform: translate(0, 0);
    }
  }
</style>
