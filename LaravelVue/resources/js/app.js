require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import BooksList from './components/books/booksList.vue';
import ToDoApp from './components/todo/toDoApp.vue';
import UserList from './components/users/userList.vue';
import Element from 'element-ui';

window.Vue = require('vue');
Vue.use(VueRouter)
Vue.use(Element)

Vue.component('main-component', require('./components/main.vue').default);
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/books',
            component: BooksList,
        },
        {
            path: '/todo',
            component: ToDoApp,
        },
        {
            path: '/users',
            component: UserList,
        },
    ],
});
const vm = new Vue({
    el: '#app',
    router,
    components:{
        BooksList,
        ToDoApp
    }
});

