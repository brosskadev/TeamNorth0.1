<template>
  <div class="about-buttons">
    <a
      v-for="(btn, i) in buttons"
      :key="i"
      :href="btn.href"
      class="custom-black-button slide-in-right"
      :style="{
        animationDelay: `${(i + 1) * 0.2 + 0.2}s`
      }"
    >
      <img class="button-bg" :src="btn.bg" alt="background" />
      <div class="overlay">
        <img v-if="btn.img" :src="btn.img" alt="icon" />
        <div v-if="btn.text" class="btn-text">
          <div v-for="(line, j) in btn.text" :key="j">{{ line }}</div>
        </div>
        <span v-else>{{ btn.label }}</span>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      buttons: [
        { href: 'https://steamcommunity.com/sharedfiles/filedetails/?id=3359758575&searchtext=%D0%AD%D0%BF%D0%BE%D1%85%D0%B0', label: 'КУЛЬТУРНОЕ НАСЛЕДИЕ', bg: '/welcome/logist.jpg'},
        { href: 'https://www.youtube.com/watch?v=PU8o9R-Vrfc&list=RDPU8o9R-Vrfc&start_radio=1', label: 'РАДИО ТИМ НОРТ 7 ЛЕТ КОМАНДЕ', bg: '/welcome/radio.jpg' },
        { href: '/academy', label: 'ПРИСОЕДИНЯЙСЯ К СООБЩЕСТВУ', bg: '/welcome/goslingmenu.jpg'}
      ]
    };
  }
};
</script>

<style scoped>
.about-buttons {
  display: flex;
  flex-direction: column;
  gap: 20px;
  width: 100%;
  height: 100%;
}

.custom-black-button {
  position: relative;
  display: block;
  width: 100%;
  aspect-ratio: 16/9; /* Поддержка пропорций постеров */
  border-radius: 6px;
  overflow: hidden;
  text-decoration: none;
  color: white;
  font-weight: bold;
  transition: transform 0.3s;
}

.custom-black-button:hover {
  transform: scale(1.02);
}

.button-bg {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
  transition: transform 0.3s ease;
}

.custom-black-button:hover .button-bg {
  transform: scale(1.1);
}

.overlay {
  font-size: 50px;
  font-weight: 600;

  position: absolute;
  inset: 0;
  z-index: 1;
  display: flex;
  justify-content: flex-start;   /* по горизонтали — влево */
  align-items: flex-end;         /* по вертикали — вниз */
  padding: 16px;                 /* отступ от краёв */
  box-sizing: border-box;
  text-shadow:
  2px 2px 4px rgba(0, 0, 0, 0.9),
  0 0 8px rgba(0, 0, 0, 0.7),
  0 0 16px rgba(0, 0, 0, 0.5);
  text-align: left;
}

.btn-text {
  display: flex;
  flex-direction: column;
  gap: 4px;
  align-items: flex-start;
}

/* Анимация */
.slide-in-right {
  opacity: 0;
  transform: translateX(30px);
  animation: slideInRight 0.9s ease-out forwards;
}

@keyframes slideInRight {
  0% {
    opacity: 0;
    transform: translateX(30px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}
</style>
