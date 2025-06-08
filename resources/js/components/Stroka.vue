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
        'БетБум опять проиграли скёрмиш в 250 тикетов, но почему-то на squad comp игры не появилось...',
        'У Brosski случилась очередная трясучка после скёрмиша',
        'Ралли сожжён.',
        'Эпоха, лишённая морали выкосил всю траву на своём участке',
        'Разъехался об камень',
        'Сквадной где фронт? Там.',
        'Qimay довел Эпоху до новчного срача в чате',
        'Suspect кикнут за баловство с тэгом (кто следующий?)',
        'Фоба сгорела.',
        'НА МНЕ!!!',
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
  background-color: #1f2833;
  color: #ffffff;
  padding: 0.5rem 1rem;
}

.marquee {
  display: inline-block;
  white-space: nowrap;
  animation: marqueeAnim linear infinite;
  animation-duration: 70s; /* Значение динамическое из data */
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
