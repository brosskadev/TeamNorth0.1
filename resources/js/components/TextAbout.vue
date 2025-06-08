<template>
  <section class="about-team">
    <h1 class="slide-in-left">Team North</h1>
    <p
      v-for="(item, i) in paragraphs"
      :key="i"
      class="slide-in-left"
      :style="{ animationDelay: `${(i + 1) * 0.35}s` }"
    >
      {{ item }}
    </p>
  </section>
</template>

<script>
export default {
  data() {
    return {
      paragraphs: [
        '— команда, являющаяся добровольным и дружеским сообществом единомышленников соревновательного направления Squad.',
        'Цели команды — Собрать дружный коллектив. Участвовать в соревновательных мероприятиях и турнирах в зависимости от возможностей команды.'
      ]
    };
  }
};
</script>

<style scoped>
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
