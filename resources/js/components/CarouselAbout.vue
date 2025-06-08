<template>
  <div class="carousel-container">
    <transition name="fade" mode="out-in">
      <img
        :src="images[currentIndex]"
        class="carousel-image"
        alt="carousel"
      />
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      images: [
        'images/roster.png',
        'images/sostav.png',
      ],
      currentIndex: 0,
      interval: null
    }
  },
  mounted() {
    this.interval = setInterval(this.nextImage, 12000);
  },
  beforeUnmount() {
    clearInterval(this.interval);
  },
  methods: {
    nextImage() {
      this.currentIndex = (this.currentIndex + 1) % this.images.length;
    }
  }
}
</script>

<style scoped>
.carousel-container {
  width: 100%;
  max-width: auto;
  height: auto;
  margin: 0 auto;
  overflow: hidden;
  position: relative;
  border-radius: 12px;
  box-shadow: 0 0 20px rgba(0,0,0,0.4);
}

.carousel-image {
  width: 100%;
  height: 100%;
  object-fit: contain; /* показываем всю картинку целиком, может появиться фон */
  display: block;
  background-color: #000; /* или подходящий фон вместо пустоты */
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}

.fade-enter-from, .fade-leave-to {
  opacity: 0;
  transform: scale(1.02); /* чуть увеличено */
}

.fade-enter-to, .fade-leave-from {
  opacity: 1;
  transform: scale(1);
}
</style>