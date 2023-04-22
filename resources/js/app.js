require('./bootstrap');

require('alpinejs');

import { createApp } from "vue";
import router from './router'
import TasksIndex from './components/tasks/TasksIndex'
import userTasksIndex from './components/userTasks/userTasksIndex'

createApp({
    components: {
        TasksIndex,
        userTasksIndex
    }
}).use(router).mount('#app')
