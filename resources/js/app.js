import { createApp } from 'vue'

import Stroka from './components/Stroka.vue'
import TextAbout from './components/TextAbout.vue'
import LeftButtonsWelocome from './components/LeftButtonsWelocome.vue'
import CenterButtonsWelcome from './components/CenterButtonsWelcome.vue'
import RightButtonsWelcome from './components/RightButtonsWelcome.vue'
import AboutSection from './components/AboutSection.vue'
import Join from './components/Join.vue'

const app = createApp({})

// Регистрируешь компоненты по имени
app.component('stroka', Stroka)
app.component('textabout', TextAbout)
app.component('leftbuttonswelcome', LeftButtonsWelocome)
app.component('centerbuttonswelcome', CenterButtonsWelcome)
app.component('rightbuttonswelcome', RightButtonsWelcome)
app.component('aboutsection', AboutSection)
app.component('join', Join)

app.mount('#app')