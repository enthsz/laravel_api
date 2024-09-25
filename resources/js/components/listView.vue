<template>
  <div class="container">
    <div class="content">
      <div v-for="task in tasks" :key="task.id" class="task-item">
        <template v-if="editedFieldId === task.id">
          <input type="text" v-model="task.title" :ref="`task${task.id}`">
          <font-awesome-icon
            @click.prevent="toggleEdit(null)"
            @click="updateTask(task.id)"
            :icon="['fas', 'check']"
            class="check"
          />
        </template>
        <template v-else>
          <span class="tasks">{{ task.title }}</span>
          <div class="icons">
            <font-awesome-icon 
              @click.prevent="toggleEdit(task.id)" 
              :icon="['fas', 'pencil']" 
              class="pencil"
            />
            <font-awesome-icon 
              :icon="['fas', 'trash']" 
              class="trash-icon" 
              @click="deleteTask(task.id)" 
            />
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['tasks'],

  data() {
    return {
      editedFieldId: "", 
    }
  },

  methods: {
    toggleEdit(taskId) {
      if (this.editedFieldId === taskId) {
        this.editedFieldId = null;
      } else {
        this.editedFieldId = taskId;
      }
    },
    
    updateTask(id){
      const updatedTask = {
        title: this.tasks.find(task => task.id === id).title
      };

      axios.put(`http://127.0.0.1:8000/api/task/${id}/`, updatedTask)
      .then(res => {
        if (res.status == 200){
          this.$emit('itemChanged')
        }
      })
      .catch(err => {
        console.log('Nao foi possivel atualizar o item', err)
      })

    },



    deleteTask(id) {
      axios.delete('http://127.0.0.1:8000/api/task/' + id)
        .then(res => {
          if (res.status === 200) {
            this.$emit('itemChanged'); 
          }
        })
        .catch(err => {
          console.log('Não foi possível remover o item', err);
        });
    }
  }
};
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  padding: 10px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.task-item {
  display: flex;
  justify-content: space-between; 
  align-items: center;
  background-color: gainsboro;
  padding: 10px;
  margin-top: 10px;
}

.icons {
  display: flex;
  gap: 10px;
}

.trash-icon, .pencil, .check {
  font-size: 25px;
  cursor: pointer;
  transition: color 0.3s ease;
}

.trash-icon {
  color: #e74c3c;
}

.trash-icon:hover {
  color: #c0392b;
}

.pencil {
  color: #3498db;
}

.pencil:hover {
  color: #2980b9;
}

.check {
  color: #2ecc71;
}

.check:hover {
  color: #27ae60;
}

.tasks {
  font-size: 30px;
}
</style>
