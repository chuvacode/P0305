<template>
    <td @mouseover="handleOver"
        @mouseleave="handleLeave"
        @click="handleClick"
    >
        <div class="content_cell">
            <span style="margin-right: 40px;" :class="{'password-cell': isPassword}">{{isPassword ? '●'.repeat(value.length) : value }}</span>
            <div class="actions_cell">
                <transition name="icon-copy">
                    <i v-if="isHover || isClick" class="action_cell action_cell-copy" :class="{active: isClick}">
                        <svg class="icon-copy" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.8297 6.25H8.07968C7.25125 6.25 6.57968 6.92157 6.57968 7.75V14.5C6.57968 15.3284 7.25125 16 8.07968 16H14.8297C15.6581 16 16.3297 15.3284 16.3297 14.5V7.75C16.3297 6.92157 15.6581 6.25 14.8297 6.25Z" stroke="#A8A8A8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.57968 10.75H2.82968C2.43186 10.75 2.05033 10.592 1.76902 10.3107C1.48772 10.0294 1.32968 9.64782 1.32968 9.25V2.5C1.32968 2.10218 1.48772 1.72064 1.76902 1.43934C2.05033 1.15804 2.43186 1 2.82968 1H9.57968C9.97751 1 10.359 1.15804 10.6403 1.43934C10.9216 1.72064 11.0797 2.10218 11.0797 2.5V3.25" stroke="#A8A8A8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </i>
                </transition>
            </div>
        </div>
    </td>
</template>

<script>
export default {
  name: 'Cell',
  data: () => ({
    isHover: false,
    isClick: false
  }),
  props: [
    'value', 'name'
  ],
  computed: {
    isPassword () {
      return (this.name.indexOf('password') > -1 && this.value != null)
    }
  },
  methods: {
    handleClick () {
      if (this.isClick) return

      this.isClick = true
      const wait = setInterval(() => { this.isClick = false; clearInterval(wait) }, 1000)
      this.copyToBuffer()
    },
    handleLeave () {
      // Если действует анимация, скрываем через 1s
      if (this.isClick) { const wait = setInterval(() => { this.isHover = false; clearInterval(wait) }, 200); return }
      this.isHover = false
    },
    handleOver () {
      this.isHover = true
    },
    copyToBuffer () {
      if (!this.value) return

      navigator.clipboard.writeText(this.value)
        .then(() => {
          // Удачно
        })
        // eslint-disable-next-line handle-callback-err
        .catch(error => {
          // Не удачно
        })
    }
  }
}
</script>

<style scoped>
  /*[ma_calendar]*/
  .password-cell {
    font-size: 10px;
  }
</style>
