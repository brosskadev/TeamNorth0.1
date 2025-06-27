<template>
  <div class="section-wrapper">
    <!-- Первый ряд -->
    <div class="image-row">
      <div
        class="image-container"
        v-for="(img, i) in topImages"
        :key="'top' + i"
        :style="{ animationDelay: (0.1 * (i + 1)) + 's' }"
      >
        <img :src="img.src" :alt="img.alt" />
      </div>
    </div>

    <!-- Текст -->
    <div class="text-box">
      За годы компета, из небольшого коллектива мы стали сплоченной командой, где опыт ветеранов и рвение молодых стали ключом к победе. Наш путь начался с участия в ISST в 2018 году, с тех пор состав команды полностью менялся, и не раз, но наши стремления оставались прежними. Через победы и неудачи, поколение за поколением, мы не переставали быть сообществом людей, которые любят соревнования.
    </div>

    <!-- Второй ряд -->
    <div class="image-row">
      <div
        class="image-container"
        v-for="(img, i) in bottomImages"
        :key="'bottom' + i"
        :style="{ animationDelay: (0.1 * (i + 1)) + 's' }"
      >
        <img :src="img.src" :alt="img.alt" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AboutSection",
  data() {
    return {
      topImages: [
        { src: "/rosters/actualroster.png", alt: "actualroster" },
        { src: "/images/sostav.png", alt: "sostav" },
      ],
      bottomImages: [
        { src: "/rosters/oldroster1.png", alt: "oldroster1" },
        { src: "/rosters/roster2023-2.gif", alt: "roster2023-2" },
        { src: "/rosters/ROSTER2023_3.png", alt: "ROSTER2023_3" },
      ],
    };
  },
};
</script>

<style scoped>

.section-wrapper {
  width: 100%;
  max-width: 1900px;
  margin: 0 auto;
  padding: 40px 20px;
  color: #fff;
  overflow: visible;       /* важно, если было hidden */
}

.image-row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 24px;
  margin-bottom: 32px;
  position: relative;      /* для корректной работы z-index дочерних элементов */
  overflow: visible;       /* разрешаем выходить элементам за пределы */
}

.image-container {
  flex: 1 1 300px;
  max-width: 33%;
  display: flex;
  justify-content: center;
  align-items: center;

  /* анимация появления */
  animation: fadeInUp 0.8s ease forwards;
  opacity: 0;
}

.image-container:hover {
  z-index: 10; /* выводим контейнер с изображением выше всех */
}

.image-container img {
  width: 100%;
  max-height: 45vh;
  height: auto;
  object-fit: contain;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* эффект увеличения при наведении */
.image-container:hover img {
  transform: scale(1.5);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

.text-box {
  font-family: 'Orbitron', sans-serif;

  max-width: 1000px;         /* шире блок */
  margin: 0 auto 24px auto;  /* меньше внешний отступ снизу */
  padding: 12px 16px;        /* уменьшен внутренний отступ */
  text-align: center;

  font-size: 23px;
  line-height: 1.4;          /* плотнее строки */
  color: #fff;
  border-radius: 8px;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 768px) {
  .image-container {
    max-width: 100%;
  }

  .text-box {
    font-size: 16px;
    padding: 16px;
  }
}
</style>
