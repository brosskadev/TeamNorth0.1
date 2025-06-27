<template>
  <section class="about-team">
    <h1 class="slide-in-left">ЗА 7 ЛЕТ</h1>
    <p
      v-for="(item, i) in paragraphs"
      :key="i"
      class="slide-in-left"
      :style="{ animationDelay: `${(i + 1) * 0.35}s` }"
    >
      <div class="stat-value">{{ item.value }}</div>
      <div class="stat-label">{{ item.label }}</div>
    </p>
  </section>
</template>

<script>
export default {
  data() {
    return {
      paragraphs: [
        { value: '500', label: 'СКИРМОВ СЫГРАНО' },
        { value: '15', label: 'ТУРНИРОВ СЫГРАНО' },
        { value: '400', label: 'НОВОБРАНЦЕВ ПРИНЯТО' },
      ]
    };
  }
};
</script>

<style scoped>

.text-block {
  text-align: center;
  margin: 20px 0;
}

.stat-value {
  font-size: 64px;
  font-weight: bold;
  color: white;
}

.stat-label {
  font-size: 20px;
  color: white;
}

.slide-in-left {
  opacity: 0;
  transform: translateX(-30px);
  animation: slideInLeft 0.9s ease-out forwards;
}

@keyframes slideInLeft {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}
</style>
