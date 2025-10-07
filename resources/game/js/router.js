import { createRouter, createWebHistory } from 'vue-router'

import City from 'Views/City.vue'
import Island from 'Views/Island.vue'
import World from 'Views/World.vue'

const routes = [
    { path: '/game/city/:city', name: 'City', component: City },
    { path: '/game/island/:island', name: 'Island', component: Island },
    { path: '/game/world/:x/:y', name: 'World', component: World },
    { path: '/', redirect: '/game/city/1' } // Redirección predeterminada
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

// Depurar rutas antes de cargar los componentes
router.beforeEach((to, from, next) => {
    console.log('Navegando a:', to)
    console.log('Desde:', from)
    next()
})

export default router
