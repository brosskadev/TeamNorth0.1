import { createApp } from 'vue'

import CarouselAbout from './components/CarouselAbout.vue'
import Stroka from './components/Stroka.vue'
import TextAbout from './components/TextAbout.vue'

console.log('Vue app init') 

const app = createApp({})

// Регистрируешь компоненты по имени
app.component('carousel', CarouselAbout)
app.component('stroka', Stroka)
app.component('textabout', TextAbout)

app.mount('#app')