import { createApp } from 'vue'
import axios from 'axios'
import '@vueform/slider/themes/default.css'
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

// Config global de Axios (después de montar app por simplicidad)
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers.common['X-CSRF-TOKEN'] = token
// Base URL de la API
// - Si corremos la app desde Laravel (puerto 9000), usamos ruta relativa '/api/'
// - Si corremos el front en otro puerto (ej. Vite), apuntamos al backend 9000 '/api/'
if (location.port === '9000') {
	axios.defaults.baseURL = '/api/'
} else {
	axios.defaults.baseURL = `${location.protocol}//${location.hostname}:9000/api/`
}
