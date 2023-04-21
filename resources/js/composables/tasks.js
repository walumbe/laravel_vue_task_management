import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useTasks() {
    const tasks = ref([])
    const task = ref([])
    const router = useRouter()
    const errors = ref('')

    const getTasks = async () => {
        let response = await axios.get('/api/tasks')
        tasks.value = response.data.data;
    }

    const getTask = async (id) => {
        let response = await axios.get('/api/tasks/' + id)
        task.value = response.data.data;
    }

    const storeTask = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/tasks', data)
            await router.push({name: 'tasks.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateTask = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/tasks/' + id, task.value)
            await router.push({name: 'tasks.index'})
        } catch (e) {
            if (e.response.status === 422) {
               errors.value = e.response.data.errors
            }
        }
    }

    const destroyTask = async (id) => {
        await axios.delete('/api/tasks/' + id)
    }


    return {
        tasks,
        task,
        errors,
        getTasks,
        getTask,
        storeTask,
        updateTask,
        destroyTask
    }
}
