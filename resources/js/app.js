import {createApp} from 'vue'
import TodoList from "./components/TodoList";

const app = createApp({});
app.component('todo-list', TodoList).mount('#app');
require('./bootstrap');
