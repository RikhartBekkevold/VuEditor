import Vue from 'vue'
import Router from 'vue-router'
import MainView from '@/components/MainView'
import FinishedView from '@/components/FinishedView'
import LoginView from '@/components/LoginView'
import FormView from '@/components/FormView'
import SignupView from '@/components/SignupView'
import StatsView from '@/components/StatsView'

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
        path: '/form',
        name: 'FormView',
        component: FormView,
        props: (route) => ({ query: route.query.q })
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
],
// mode: 'history'

})
