<template>
  <transition name="fade">
    <div v-if="show" class="box">
      <h2>Заголовок FadeBox</h2>
      <p>Здесь твой текст или любой другой</p>
    </div>
  </transition>
</template>


<script>
export default {
  data() {
    return { show: true }
  },
  mounted() {
    setInterval(() => {
      this.show = !this.show
    }, 2000)
  }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.box {
  padding: 1rem;
  background-color: #4a90e2;
  color: white;
  border-radius: 8px;
}
</style>
