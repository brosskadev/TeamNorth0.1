import { createApp } from 'vue'

import FadeBox from './components/FadeBox.vue'
import Stroka from './components/Stroka.vue'

console.log('Vue app init') 

const app = createApp({})

// Регистрируешь компоненты по имени
app.component('fade-box', FadeBox)
app.component('stroka', Stroka)

app.mount('#app')