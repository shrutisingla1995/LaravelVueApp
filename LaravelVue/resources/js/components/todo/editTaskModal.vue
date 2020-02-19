<template>
  <div>
     <header class="modal-header">
        <slot name="header">
          Edit Task
          <div type="button" class="btn-close" @click="close" >
            &#9932;
          </div>
        </slot>
      </header>
      <section class="modal-body">
        <slot name="body">
            <input type="text" v-model="task" @change="updateTask($event)"/>
        </slot>
       </section>
       <footer class="modal-footer">
          <slot name="footer">
            <div class="update-btn" @click="close">
                Update
          </div>
        </slot>
      </footer>
  </div>
</template>
<script>
export default {
    props: ['taskId','taskName', 'taskIndex'],
    data(){
        return{
            task:this.taskName 
        }
    },
   methods:{
        close(){
            this.$emit('close');
        },
        updateTask(e){
            var data = {
                task:e.target.value,
                taskId:this.taskId
            }
            axios.post("updateTask", data).then(response => {
                if (response.data.success) {
                    this.close();
                    this.updatedTask = data.task; 
                    this.$parent.getTasks();
                }
            });
        }
    }
}
</script>
<style lang="scss">
 
  .modal-header,
  .modal-footer {
    padding: 15px;
    display: flex;
  }

  .modal-header {
    justify-content: space-between;
  }

  .modal-footer {
    border-top: 1px solid #eeeeee;
    justify-content: flex-end;
  }

  .modal-body {
    position: relative;
    padding: 20px 10px;
  }

  .btn-close {
    border: none;
    font-size: 20px;
    cursor: pointer;
    font-weight: bold;
    background: transparent;
    font-size: 10px;
  }
  .update-btn{
      padding: 10px 20px;
      background:blueviolet;
      color:white;
      border-radius: 10px;
      font-size: 12px;
      &:hover{
          cursor: pointer;
      }
  }

</style>