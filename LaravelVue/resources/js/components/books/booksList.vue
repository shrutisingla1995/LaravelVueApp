<template>
  <section id="books-section">
    <div class="container">
      <div class="section-title" >
        <h1>My Books</h1>
        <div class="books-container"  v-loading="loading">
          <div  v-for="book in books" :key="book.id">
            <div class="book">
              <div class="book-img" >
                <div v-if="book.volumeInfo.imageLinks">
                  <img :src="book.volumeInfo.imageLinks.thumbnail" alt />
                 </div>
                 <div v-else>
                    <img src="" alt />
                  </div>
              </div>
              <div class="book-info">
                <div class="book-title">{{book.volumeInfo.title}}</div>
                <div class="book-author">
                    <em>{{book.volumeInfo.authors ? book.volumeInfo.authors[0] : ""}}</em>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>Note:
          <em>Using google api to display books json data.</em>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      books: [],
      loading: false
    }
  },
  mounted(){
    this.getBooks();
  },
   methods:{
     getBooks : function(){
       this.loading = true;
           axios.get(`https://www.googleapis.com/books/v1/volumes?q=HTML"`).then(response => {
            this.books = response.data.items;
            this.loading= false
        })
     }
   }
};
</script>
<style lang="scss">
.section-title h1 {
  padding: 10px 0;
  color: grey;
  -webkit-text-stroke-color: indigo;
}
#books-section {
  margin: 15px 0;
}
.books-container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  grid-gap: 15px;
}
.section-title {
  padding: 20px 0;
  margin:0 15%;
}
#books-section .book {
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  background: white;
}
#books-section .book-img img {
  width: 100%;
  height: 200px;
}
#books-section .book-info {
  padding: 10px;
}
#books-section .book-title {
  padding-bottom: 10px;
  font-size: 1em;
}
#books-section .book-author {
  color: grey;
  font-size: 0.7em;
}
#books-section .book {
  padding-bottom: 5px;
}
</style>