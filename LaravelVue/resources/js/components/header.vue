<template>
  <header id="header">
            <div>
            <nav>
                <a to="/" class="logo"><i className="fa fa-book-open"></i></a>
                <ul class="categories">
                    <router-link class="nav-link" :to="'/books'">Books List Api</router-link>
                    <router-link class="nav-link" :to="'/todo'">To Do App</router-link>
                    <router-link class="nav-link" :to="'/users'">Users</router-link>
                </ul>
            </nav>
            <router-view></router-view>
            </div>
      </header>
</template>
<script>
export default {
    components:{
      
    }
}
</script>
<style lang="scss">
  #header{
    background-color: white;
    padding:10px 0;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
  a{
    text-decoration: none;
    display: block;
    padding:10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color:white;
    }
    li{
          list-style-type: none;
    }
    .categories{
        display: flex;
        background:blueviolet;
        color:white;
        padding: 10px;
    }
    .logo{
        font-size:2em;
        padding: 0;
    }
  }
#header .active a{
  background-color: #ececec;
}
#header  a:hover,
#header  a:focus{
  background-color: #ececec;
  border-radius: 4px;
  color:black;
}

</style>