<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">To Do List</h1>

                    <div class="card-body">
                        <div>
                            <input v-model="inputTodo" placeholder="Add Description">
                            <button @click="addToDo">Add Description</button>
                        </div>
                        <div v-show="todos.length === 0">
                            <p class="alert-dark text-center">There are no Items</p>
                        </div>
                        <ul class="errors">
                            <li  v-for="error in errors">{{ error[0] }}</li>
                        </ul>
                        <div class="items-center" v-for="(todo, index) in todos" :key="todo.id">
                            <input type="checkbox" v-model="todo.completed" :class="d-inline-block" @click="markComplete(todo)">
                            <p class="d-inline-block"
                               :class="todo.completed ? 'strike-through' : ''">
                                {{todo.description}}
                            </p>
                            <button class="d-inline-block" @click="remove({id: todo.id, index: index})">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name: "ToDoComponent",
        data(){
            return{
                todos: [],
                inputTodo: '',
                errors: []
            }
        },
        methods: {
            addToDo() {
                const self = this;

                self.addToDoDB(self.inputTodo);
                self.inputTodo = '';

            },
            addToDoDB(description) {
                const self = this;

                axios.post('/to-do-list', {description: description, completed: false})
                    .then(({data}) => {
                        if (!data.success) {
                            this.errors = data.errors;
                        } else {
                            self.todos.unshift(data.data);
                        }
                    });
            },
            markComplete(todo) {
                todo.completed = !todo.completed;
                axios.put('/to-do-list/'+todo.id, todo)
                    .then(({data}) => {
                        console.log(data);
                    });
            },
            remove(details) {
                const self = this;

                axios.delete('/to-do-list/'+ details.id)
                    .then(() => {
                        self.todos.splice(details.index, 1)})
            },
            getToDos() {
                const self = this;

                axios.get('/to-do-list')
                    .then(({data}) => {
                        self.todos = data;
                    });
            }
        },
        mounted() {
            this.getToDos();
        }
    }
</script>


<style scoped>

</style>