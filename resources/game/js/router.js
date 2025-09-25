import { createRouter, createWebHistory } from 'vue-router'

import City from 'Views/City.vue'
import Island from 'Views/Island.vue'
import World from 'Views/World.vue'

const routes = [
    { path: '/game/city/:city', name: 'City', component: City },
    { path: '/game/island/:island', name: 'Island', component: Island },
    { path: '/game/world/:x/:y', name: 'World', component: World },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
