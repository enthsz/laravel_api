<template>
  <div class="container">
    <h1>CRUD de Tarefas</h1>
    
    <div class="create-task">
      <createTask @task-added="fetchTasks"/>
    </div>

    <div class="list-view">
      <listView @itemChanged="fetchTasks"  :tasks="tasks" />
    </div>
  </div>
</template>

<script>
import createTask from './createTask.vue';
import listView from './listView.vue';

export default {
  components: {
    createTask,
    listView,
  },

  data(){
    return{
      tasks: []
    }
  },

  created(){
    this.fetchTasks();
  },

  methods: {
    fetchTasks(){
      axios.get('http://127.0.0.1:8000/api/tasks/')
      .then(res => {
        if (res.data.length){
          this.tasks = res.data
        }else{
          this.tasks = []
        }
      })
      .catch(err => {
        console.error('Erro ao buscar dados', err)
      })
      
    }
  }
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f7f7f7;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #333;
}

.create-task {
  margin-bottom: 20px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.list-view {
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
