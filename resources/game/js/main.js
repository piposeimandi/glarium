import { createApp } from 'vue'
import Game from 'Js/Game.vue'
import i18n  from 'Lang/index.js'
import store from 'Stores/store.js'

import "bootstrap/dist/css/bootstrap.min.css";
import "Sass/main.scss"

// Import global functions
import { sectotime, sum, zoom, checkHorarioTipo, money, money_two, floor } from 'Js/prototypes'
import { chUser, chChat } from 'Js/config'

const app = createApp(Game)

// Add global properties
app.config.globalProperties.$sectotime = sectotime
app.config.globalProperties.$sum = sum
app.config.globalProperties.$zoom = zoom
app.config.globalProperties.$checkHorarioTipo = checkHorarioTipo
app.config.globalProperties.$money = money
app.config.globalProperties.$money_two = money_two
app.config.globalProperties.$floor = floor
app.config.globalProperties.$chUser = chUser
app.config.globalProperties.$chChat = chChat

app.use(i18n)
app.use(store)
app.mount('#app')
