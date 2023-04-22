<template>
    <div v-if="errors">
      <div v-for="(v, k) in errors" :key="k" class="bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
        <p v-for="error in v" :key="error" class="text-sm">
          {{ error }}
        </p>
      </div>
    </div>
    <form class="space-y-6" v-on:submit.prevent="saveUserTask">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <div class="mt-1">
                    <input type="date" name="due_date" id="due_date"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="userTask.due_date">
                </div>
            </div>

            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <div class="mt-1">
                    <input type="time" name="time" id="time"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="userTask.start_time">
                </div>
            </div>

            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <div class="mt-1">
                    <input type="time" name="end_time" id="end_time"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="userTask.end_time">
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Remarks</label>
                <div class="mt-1">
                    <input type="text" name="remarks" id="remarks"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="userTask.remarks">
                </div>
            </div>

        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Save
        </button>
    </form>
</template>

<script>
import userTasks from "../../composables/userTasks";
import {onMounted} from "vue";

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { errors, userTask, getUserTask, updateUserTask } = userTasks()

        onMounted(getUserTask(props.id))

        const saveUserTask = async () => {
            await updateUserTask(props.id)
        }

        return {
            errors,
            userTask,
            saveUserTask
        }
    }
}
</script>
