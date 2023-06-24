import { createRouter, createWebHistory } from "vue-router";
import HomeView from "./views/Home.vue"
import LinesView from "./views/LinesView.vue"
import PlayersView from "./views/PlayersView.vue"

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/lines',
            name: 'lines',
            component: LinesView
        },
        {
            path: '/players',
            name: 'players',
            component: PlayersView
        },
    ]
})

export default router
