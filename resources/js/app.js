require('./bootstrap');

require('alpinejs');

import { createApp } from "vue";
import router from './router'
import TasksIndex from './components/tasks/TasksIndex'
import userTasksIndex from './components/userTasks/userTasksIndex'

createApp({
    components: {
        CompaniesIndex,
        TasksIndex,
        userTasksIndex
    }
}).use(router).mount('#app')
