require('Js/config')
require('Js/prototypes')

import { createApp } from 'vue'
import Game from 'Js/Game.vue'
import i18n  from 'Lang/index.js'
import store from 'Stores/store.js'

import "bootstrap/dist/css/bootstrap.min.css";
import "Sass/main.scss"

const app = createApp(Game)
app.use(i18n)
app.use(store)
app.mount('#app')
