<template>
    <div class="max-w-4xl mx-auto mt-5">
        <h1 class="mt-6 text-3xl font-extrabold text-gray-900">My Todo List</h1>
        <div class="flex mt-4">
            <input class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker"
                   v-model="todo"
                   placeholder="Add Todo">
            <button @click="addTodo" class="flex-no-shrink p-2 border-2 rounded text-teal border-teal hover:text-white hover:bg-teal">
                Add
            </button>
        </div>
        <div class="flex mb-4 mt-5 items-center">
            <p class="w-full text-grey-darkest">Add another component to Tailwind Components</p>
            <button class="flex-no-shrink p-2 ml-4 mr-2 border-2 rounded hover:text-white text-green border-green hover:bg-green">
                Done
            </button>
            <button class="flex-no-shrink p-2 ml-2 border-2 rounded text-red border-red hover:text-white hover:bg-red">
                Remove
            </button>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";
export default {
    setup(){
        const todos = ref([]);
        const todo = ref();
        const addTodo = async ()=>{
            if(todo.value !== undefined){
                const response = await axios.post('/todo', {name:todo.value});
                todos.value.push({name: response.data.name,completed_at:response.data.completed_at});
                todo.value = '';
                console.log(todos.value);
            }
        }
        return {
            todos,
            todo,
            addTodo
        }
    }

}
</script>
<style scoped>
</style>
