<template>
    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
        <div class="flex place-content-end mb-4">
            <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
                <router-link  class="text-sm font-medium">User Tasks</router-link>
            </div>
        </div>

        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Name</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Description</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Due Date</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Status</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                </th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <template v-for="item in userTasks" :key="item.id">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.task }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.due_date }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.start_time }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.end_time }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.remarks }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.status }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <router-link :to="{ name: useTasks.edit, params: { id: item.id } }"
                                     class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit
                        </router-link>
                        <button @click="deleteUserTask(item.id)"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Delete</button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import userTasks from "../../composables/userTasks";
import { onMounted } from "vue";

export default {
    setup() {
        const { userTasks, getUserTasks, destroyUserTask } = userTasks()

        onMounted(getUserTasks)

        const deleteUserTask = async (id) => {
            if (!window.confirm('Are you sure?')) {
                return
            }

            await destroyUserTask(id);
            await getUserTasks();
        }

        return {
            userTasks,
            deleteUserTask
        }
    }
}
</script>
