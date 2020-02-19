<template>
  <section id="todoApp">
    <h1>Add things you want to learn :)</h1>
    <div class="to-do-form">
      <input type="text" name="name" id="taskName" placeholder="Enter your task..." required />
      <button type="submit" v-on:click="addTask()">Add</button>
    </div>
    <div v-if="tasksList && tasksList.length" style="text-align:right;">
      <button type="submit" @click="resetTasks()">Reset All</button>
    </div>
    <div class="tasks-list" v-if="tasksList && tasksList.length">
      <div class="heading">Tasks ({{tasksList.length}})</div>
      <span v-for="(task,index) in tasksList" :key="index">
        <span class="name">
          {{task.task_name}}
          <div class="cross-icon" v-on:click="deleteTask(task,task.id,index)">&#9932;</div>
          <div class="edit-icon" v-on:click="editTask(task,task.id,index)">Edit</div>
        </span>
      </span>
    </div>
    <div class="added-tasks" v-if="currentTasks.length">
      <div v-for="task in currentTasks" :key="task">
        <div>
          <strong>&check;</strong>
          {{task}}
          <em>added successfully.</em>
        </div>
      </div>
    </div>
    <div class="modal" v-if="openEditModal">
      <div class="modal-backdrop">
        <div class="modal">
          <edit-task-modal @close="closeModal" :taskId="taskId" :taskIndex="taskIndex" :taskName="taskName"></edit-task-modal>
        </div>
      </div>
    </div>
    <div>Note:
          <em>CRUD Application using Vue js and Laravel. Using props for data transfer from parent to child.</em>
    </div>
  </section>
</template>
<script>
import EditTaskModal from "./editTaskModal.vue";
export default {
  data() {
    return {
      task: "",
      currentTasks: [],
      tasksList: [],
      openEditModal: false,
      taskId: "",
      taskIndex: "",
      taskName: ""
    };
  },
  components: {
    EditTaskModal
  },
  mounted() {
    this.getTasks();
  },
  methods: { 
    addTask() {
      var task = document.getElementById("taskName").value;
      if (task) {
        var data = {
          taskName: task
        };
        axios
          .post("todo", data)
          .then(response => {
            if (response.data.success) {
              this.currentTasks.push(response.data.task.task_name);
              this.getTasks();
              document.getElementById("taskName").value = "";
              setTimeout(() => {
                this.currentTasks = [];
              }, 3000);
            }
          })
          .catch(err => console.error(err));
      } else {
        alert("This is a required field.");
      }
    },
    getTasks() {
      axios.get("getTasks").then(response => {
        this.tasksList = response.data;
      });
    },
    deleteTask(task, taskId, index) {
      this.tasksList.splice(index, 1);
      var data = {
        task: task,
        id: taskId
      };
      axios.post("deleteTask", data).then(response => {
        if (response.data.success) {

        }
      });
    },
    editTask(task, id, index) {
      this.openEditModal = true;
      this.taskId = id;
      this.taskName = task.task_name;
      this.taskIndex = index;
    },
    closeModal(){
       this.openEditModal = false;
    },
    resetTasks(){
      axios.post("reset").then(response => {
        if (response.data.success) {
          this.tasksList = [];
        }
      });
    }
  }
};
</script>
<style lang="scss">
#todoApp {
  margin: 0 20%;
  background: #ececec;
  border-radius: 10px;
  padding: 10px 0px 40px;
  h1 {
    text-align: center;
  }
  .to-do-form {
    text-align: center;
  }
  .tasks-list {
    padding: 10px 20px;
    background: #d2d1d1;
    margin: 20px 0;
    .name {
      display: inline-block;
      padding: 10px;
      background: white;
      margin: 10px 5px;
      border-radius: 5px;
      position: relative;
      border: 1px solid blueviolet;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
      &:hover {
        .cross-icon {
          color: blueviolet;
          cursor: pointer;
          display: block;
        }
        .edit-icon {
          display: inline-block;
          background: blueviolet;
          padding: 2px;
          font-size: 10px;
          width: 100%;
          border:1px solid blueviolet;
          text-align: center;
          border-bottom-left-radius: 5px;
          border-bottom-right-radius: 5px;
          cursor: pointer;
          color: white;
        }
      }
    }
    .cross-icon {
      position: absolute;
      top: 0px;
      right: 3px;
      font-size: 9px;
      color: red;
      font-weight: 700;
      display: none;
    }
    .edit-icon {
      position: absolute;
      bottom: -15px;
      vertical-align: middle;
      display: none;
      left: 0px;
    }
    .heading {
      color: white;
      font-size: 20px;
      font-weight: 500;
    }
  }
  .added-tasks {
    padding: 10px;
    border: 1px solid green;
    margin: 10px;
    width: 50%;
    border-radius: 10px;
    background: white;
  }
  input {
    border: 1px solid blueviolet;
    background: none;
    padding: 10px;
    display: inline;
    border-radius: 5px;
  }
  button {
    display: inline;
    background: blueviolet;
    color: white;
    border-radius: 5px;
    padding: 10px;
    margin: 0 10px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    opacity: 0.8;
    &:hover {
      cursor: pointer;
      opacity: 1;
    }
  }
}
.modal-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.3) !important;
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  background: #ffffff;
  box-shadow: 2px 2px 20px 1px;
  overflow-x: auto !important;
  display: flex !important;
  flex-direction: column;
  width:25% !important;
  position: relative !important;
  height: auto !important;
  input{
    width:100%;
  }
}
.modal-header{
  .close-modal{
    position: absolute;
    right:5px;
    top:5px;
  }
}
</style>