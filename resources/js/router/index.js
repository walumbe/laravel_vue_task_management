import { createRouter, createWebHistory } from "vue-router";


import TasksIndex from '../components/tasks/TasksIndex'
import TasksCreate from '../components/tasks/TasksCreate'
import TasksEdit from '../components/tasks/TasksEdit'
import userTasksIndex from '../components/userTasks/userTasksIndex'
import userTasksCreate from '../components/userTasks/userTasksCreate'
import userTasksEdit from '../components/userTasks/userTasksEdit'

const routes = [
    
    {
        path: '/dashboard',
        name: 'tasks.index',
        component: TasksIndex
    },
    {
        path: '/tasks/create',
        name: 'tasks.create',
        component: TasksCreate
    },
    {
        path: '/tasks/:id/edit',
        name: 'tasks.edit',
        component: TasksEdit,
        props: true
    },
    {
        path: '/user-tasks',
        name: 'userTasks.index',
        component: userTasksIndex
    },
    {
        path: '/tasks/create',
        name: 'userTaks.create',
        component: userTasksCreate
    },
    {
        path: '/tasks/:id/edit',
        name: 'userTasks.edit',
        component: userTasksEdit,
        props: true
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
