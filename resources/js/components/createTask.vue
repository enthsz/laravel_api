<template>
  <div class="addTask">
    <input type="text" v-model="userInput" placeholder="Adicionar nova tarefa" />
    <font-awesome-icon
      @click="addTask"
      :class="[userInput ? 'active' : 'inactive', 'plus']"
      :icon="['fas', 'square-plus']"
    />
  </div>
</template>

<script>
import axios from 'axios'; 

export default {
  data() {
    return {
      userInput: "", 
    };
  },

  methods: {
    addTask(){
      if (this.userInput == ''){
        return;
      }

      axios.post('http://127.0.0.1:8000/api/tasks/create', {
        title: this.userInput
      })
      .then(res => {
        if (res.status == 200){
          this.userInput = ''
          this.$emit('task-added')

        }
      })
      .catch(err => {
        console.error('Erro ao adicionar tarefa', err)
      })

    }
  }
  
};


</script>

<style scoped>
.addTask {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #f0f0f0;
  border-radius: 8px;
  padding: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

input[type="text"] {
  flex: 1;
  border: none;
  height: 20px;
}

.plus{
  margin-left: 10px;
  font-size: 30px;
}

.active{
  color: green;
  cursor: pointer;
}

.inactive{
  color: black;
}

</style>

