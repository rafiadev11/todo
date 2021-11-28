<template>
    <div class="max-w-4xl mx-auto mt-5">
        <h1 class="mt-6 text-3xl font-extrabold text-gray-900">My Todo List</h1>
        <form @submit.prevent="addTodo">
            <div class="flex mt-4">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker"
                       required
                       v-model="todo"
                       placeholder="Add Todo">
                <button type="submit"
                        class="p-2 border-2 rounded text-green-400 text-xs hover:bg-green-400 hover:text-white">
                    Add
                </button>
            </div>
        </form>
        <div class="flex mb-4 mt-5 items-center"
             v-for="(item, index) in todos"
             :key="index">
            <p :class="[item.completed_at?'line-through text-green-400':'','w-full', 'text-grey-darkest']">
                {{item.name }}
            </p>
            <em v-if="item.completed_at"><small>{{ item.completed_at }}</small></em>
            <button v-if="item.completed_at"
                    type="button"
                    disabled="disabled"
                    class="p-2 ml-4 mr-2 border-2 rounded bg-green-400 text-white text-xs">Completed
            </button>
            <button v-else
                    type="button"
                    @click="markAsComplete(index)"
                    class="p-2 ml-4 mr-2 border-2 rounded text-green-400 text-xs hover:bg-green-400 hover:text-white">
                Complete
            </button>
            <button @click="removeItem(index)"
                    type="button"
                    class="p-2 ml-2 border-2 rounded text-red-400 text-xs hover:bg-red-400 hover:text-white">
                Remove
            </button>
        </div>
    </div>
</template>
<script>
import {onMounted, ref} from "vue";

export default {
    setup() {
        const todos = ref([]);
        const todo = ref();
        const addTodo = async () => {
            if (todo.value !== undefined) {
                const response = await axios.post('/todo', {name: todo.value});
                todos.value.push(response.data);
                todo.value = '';
            }
        }
        const getItems = async () => {
            const response = await fetch("/todos");
            todos.value = await response.json();
        }
        onMounted(async () => {
            await getItems();
        });
        const markAsComplete = async (idx) => {
            const item = todos.value[idx];
            const response = await axios.post("/mark-as-complete", {id: item.id});
            todos.value[idx].completed_at = response.data.completed_at;
        }
        const removeItem = async (idx) => {
            const item = todos.value[idx];
            await axios.post("/delete", {id: item.id});
            todos.value.splice(idx, 1);
        }
        return {
            todos,
            todo,
            addTodo,
            getItems,
            markAsComplete,
            removeItem
        }
    }
}
</script>
