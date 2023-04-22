<template>
    <div v-if="errors">
   <div v-for="(v, k) in errors" :key="k" class="bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
     <p v-for="error in v" :key="error" class="text-sm">
       {{ error }}
     </p>
   </div>
 </div>
 
     <form class="space-y-6" @submit.prevent="saveUserTask">
         <div class="space-y-4 rounded-md shadow-sm">
             <div>
                 <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                 <div class="mt-1">
                     <input type="due_date" name="due_date" id="due_date"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.due_date">
                 </div>
             </div>
 
             <div>
                 <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                 <div class="mt-1">
                     <input type="time" name="start_time" id="start_time"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.start_time">
                 </div>
             </div>

             <div>
                 <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                 <div class="mt-1">
                     <input type="time" name="end_time" id="end_time"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.start_time">
                 </div>
             </div>
 
             <div>
                 <label for="address" class="block text-sm font-medium text-gray-700">Remarks</label>
                 <div class="mt-1">
                     <input type="remarks" name="remarks" id="remarks"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.remarks">
                 </div>
             </div>
         </div>
 
         <button type="submit"
                 class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
             Create
         </button>
     </form>
 </template>
 
 <script>
 import { reactive } from "vue";
 import userTasks from "../../composables/userTasks";
 
 export default {
     setup() {
         const form = reactive({
             'due_date': '',
             'start_time': '',
             'end_time': '',
             'remarks': '',
         })
 
         const { errors, storeUserTask } = userTasks()
 
         const saveUserTask = async () => {
             await storeUserTask({...form});
         }
 
         return {
             form,
             errors,
             saveUserTask
         }
     }
 }
 </script>
 