<template>
  <div class="marquee-container">
    <div class="marquee" :style="{ animationDuration: animationDuration + 's' }">
      <span v-for="(news, index) in repeatedNews" :key="index" class="news-item">
        {{ news }}
        <span class="separator">    </span>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      news: [
        'BlackBerry опять проиграли скёрмиш в 250 тикетов, но на squad comp не зарегали эту игру',
        'У Brosski случилась очередная трясучка после скёрмиша',
        'Эпоха, лишённая морали выкосил всю траву на своём участке',
      ],
      animationDuration: 40
    }
  },
  computed: {
    repeatedNews() {
      return [...this.news, ...this.news];
    }
  }
}
</script>

<style scoped>
.marquee-container {
  width: 100%;
  overflow: hidden;
  white-space: nowrap;
  box-sizing: border-box;
  border: 1px solid #ccc;
  background-color: #222;
  color: #fff;
  padding: 0.5rem 1rem;
}

.marquee {
  display: inline-block;
  white-space: nowrap;
  animation: marqueeAnim linear infinite;
  animation-duration: 40s; /* Значение динамическое из data */
}

.news-item {
  display: inline-block;
  padding-right: 2rem; /* Отступ между новостями */
}

.separator {
  color: #999;
}

@keyframes marqueeAnim {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}
</style>
