import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function userTasks() {
    const userTasks = ref([])
    const userTask = ref([])
    const router = useRouter()
    const errors = ref('')

    const getUserTasks = async () => {
        let response = await axios.get('/api/user-tasks')
        userTasks.value = response.data.data;
    }

    const getUserTask = async (id) => {
        let response = await axios.get('/api/user-tasks/' + id)
        userTask.value = response.data.data;
    }

    const storeUserTask = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/user-tasks', data)
            await router.push({name: 'userTasks.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateUserTask = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/user-tasks/' + id, userTask.value)
            await router.push({name: 'userTasks.index'})
        } catch (e) {
            if (e.response.status === 422) {
               errors.value = e.response.data.errors
            }
        }
    }

    const destroyUserTask = async (id) => {
        await axios.delete('/api/user-tasks/' + id)
    }


    return {
        userTasks,
        userTask,
        errors,
        getUserTasks,
        getUserTask,
        storeUserTask,
        updateUserTask,
        destroyUserTask
    }
}
