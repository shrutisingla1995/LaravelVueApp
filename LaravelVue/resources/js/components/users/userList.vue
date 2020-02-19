<template>
  <div class="container">
    <h3>Users</h3>
    <el-table  v-loading="loading" 
        element-loading-text="Loading..."
        element-loading-spinner="el-icon-loading"
        element-loading-background="rgba(0, 0, 0, 0.8)" 
        :data="tableData" 
        stripe 
        style="width: 100%">
      <el-table-column prop="name" label="Name" width="180"></el-table-column>
      <el-table-column prop="about" label="About"></el-table-column>
      <el-table-column prop="address" label="Address"></el-table-column>
      <el-table-column prop="email" label="Email"></el-table-column>
      <el-table-column prop="designation" label="Designation"></el-table-column>
    </el-table>
    <div>Note:
        <em>Using element io library to display table structure.</em>
    </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
        tableData: [],
        loading:false
    };
  },
  mounted(){
      this.getUsers();
  },
  methods:{
      getUsers(){
         this.loading= true;
         axios.get("getUsers").then(response => {
         this.tableData = response.data;
         this.loading =  false;
         });
      }
  }
};
</script>