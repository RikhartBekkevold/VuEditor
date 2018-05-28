import Vue from 'vue'
import Router from 'vue-router'
import MainView from '@/components/MainView'
import FinishedView from '@/components/FinishedView'
import LoginView from '@/components/LoginView'
import FormView from '@/components/FormView'
import SignupView from '@/components/SignupView'
import StatsView from '@/components/StatsView'
import PageView from '@/components/PageView'

Vue.use(Router)


export default new Router({
    routes: [
        {
          path: '/',
          name: 'MainView',
          component: MainView
        },
        {
            path: '/fin',
            name: 'FinishedView',
            component: FinishedView
        },
        {
            path: '/login',
            name: 'LoginView',
            component: LoginView
        },
        {
            path: '/form:id',
            name: 'FormView',
            component: FormView
            // props: (route) => ({ query: route.query.q })
        },
        {
            path: '/signup',
            name: 'SignupView',
            component: SignupView
        },
        {
            path: '/answers',
            name: 'StatsView',
            component: StatsView
        },
        {
            path: '/pages',
            name: 'PageView',
            component: PageView,
            props: (route) => ({ query: route.query.q })
        },
    ],
    mode: 'history'
})
