<template>
  <div class="media-gallery-section">
    <h2 class="section-title">НАШ ДЕВИЗ "БИЛЕТ В КОМПЕТ"</h2>
    <h2 class="section-title">
      УЖЕ 7 ЛЕТ МЫ ПРИНИМАЕМ ИГРОКОВ ЛЮБОГО УРОВНЯ, ВОСПИТЫВАЯ ТАЛАНТЫ СО ВСЕГО МИРА, ГЛАВНОЕ, ЧТОБ ОНИ УМЕЛИ ГОВОРИТЬ ПО-РУССКИ И СОБЛЮДАЛИ НАШ УСТАВ.
    </h2>

    <div class="media-gallery-wrapper">
      <div class="media-gallery">
        <div
          v-for="(item, i) in items"
          :key="i"
          class="media-item slide-in-right"
          :style="{ animationDelay: `${(i + 1) * 0.2 + 0.2}s` }"
        >
          <div class="media-text" v-if="item.text">{{ item.text }}</div>

          <template v-if="item.type === 'image'">
            <div class="media-button-wrapper">
              <a :href="item.link" target="_blank" rel="noopener noreferrer" class="media-link">
                <img class="media-content" :src="item.src" :alt="item.alt || 'image'" />
              </a>
              <div class="button-hint">↑ ВСТУПИТЬ В КОМАНДУ ↑</div>
            </div>
          </template>

          <template v-else-if="item.type === 'video'">
            <div class="media-video-wrapper">
              <video controls autoplay muted playsinline class="media-content">
                <source :src="item.src" type="video/mp4" />
                Ваш браузер не поддерживает видео.
              </video>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {
          type: 'image',
          src: '/welcome/goslingmenu.jpg',
          alt: 'Изображение',
          link: 'https://discord.gg/teamnorth'
        },
        {
          type: 'video',
          src: '/videos/FOBPOPANOV2.mp4',
          text: 'ОБРАЗЕЦ СОБЕСЕДОВАНИЯ',
          alt: 'ОБРАЗЕЦ СОБЕСЕДОВАНИЯ'
        }
      ]
    };
  }
};
</script>

<style scoped>
.media-gallery-section {
  width: 100vw;
  margin: 0 auto;
  padding: 40px 20px;
  box-sizing: border-box;
}

.section-title {
  font-size: 48px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 60px;
  user-select: none;
  color: #fff;
}

.media-gallery-wrapper {
  width: 100%;
  padding: 0 10px;
  box-sizing: border-box;
}

.media-gallery {
  display: flex;
  flex-direction: row;
  gap: 40px;
  width: 100%;
  flex-wrap: nowrap;
  justify-content: center;
}

.media-item {
  display: flex;
  flex-direction: column;
  width: 50%;
  border-radius: 8px;
  overflow: visible; /* важно, чтобы текст под кнопкой не обрезался */
  font-weight: bold;
  color: white;
}

.media-text {
  font-size: 28px;
  margin-bottom: 20px;
  text-align: center;
  user-select: none;
  color: #fff;
}

/* Общий контейнер кнопки (картинки) с закруглениями и overflow */
.media-button-wrapper {
  border-radius: 8px;
  overflow: hidden;
  position: relative;
  cursor: pointer;
  display: inline-block;
  width: 100%;
}

/* Ссылка вокруг картинки */
.media-link {
  display: block;
  width: 100%;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: none;
  border-radius: 8px; /* для визуальной поддержки, но важен wrapper */
}

.media-link:hover {
  transform: scale(1.05);
}

/* Видео тоже обёрнут для сохранения закругления */
.media-video-wrapper {
  border-radius: 8px;
  overflow: hidden;
  width: 100%;
}

/* Контент (картинка и видео) */
.media-content {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.media-item:hover .media-content {
  transform: none;
}

/* Текст под кнопкой с анимацией мигания */
.button-hint {
  color: #0af;
  font-weight: 700;
  font-size: 35px;
  text-align: center;
  margin-top: 12px;
  animation: blink 1.5s infinite;
  user-select: none;
  text-transform: uppercase;
}

@keyframes blink {
  0%, 50%, 100% {
    opacity: 1;
  }
  25%, 75% {
    opacity: 0;
  }
}

/* Анимация появления */
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