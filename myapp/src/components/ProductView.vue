<template>
  <div>
      <form @submit.prevent="save"> 
        <h2>Product Registration</h2>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" v-model="product.title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" v-model="product.description" class="form-control" id="description"/>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" v-model="product.price" class="form-control" id="price"/>
            </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in result" v-bind:key="product.id">
                
                <td>{{ product.id }}</td>
                <td>{{ product.title }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td>
                    <button type="button" class="btn btn-warning" @click="edit(product)">Edit</button>
                    <button type="button" class="btn btn-danger" @click="remove(product)">Delete</button>
                </td>
            </tr>
        </tbody>
</table>
  </div>
</template>

<script>

import Vue from 'vue';
import axios from 'axios'

Vue.use(axios)

export default {
  name: 'ProductView',
  data () {
    return {
      result: {},
      product: {
                id: '',
                title: '',
                description: '',
                price: ''
      }
    }
  },
  created() {
    this.productLoad();
  },
  methods: {
      productLoad() 
      {
        var page = 'http://127.0.0.1:8000/api/product'
        axios.get(page)
        .then(
            ({data}) => {
                console.log(data);
                this.result = data;
            }
        );
      },
      save()
      {
        if (this.product.id == '') 
        {
            this.saveData();    
        } else {
           this.updateData(); 
        }

        
      },
      saveData()
      {
        axios.post('http://127.0.0.1:8000/api/product/save', this.product)
        .then(
            ({data}) => {
                alert('Saved');
            }
        );
      },
      edit(product)
      {
        this.product = product;
      },
      updateData()
      {
        var url = 'http://127.0.0.1:8000/api/product/update/' + this.product.id;
        axios.put(url, this.product)
        .then(
            ({data}) => {
                this.product.id = ''
                this.product.title = ''
                this.product.description = ''
                alert('Updated');
                this.productLoad();
            }
        );
      },
      remove(product)
      {
        var url = 'http://127.0.0.1:8000/api/product/delete/' + product.id;
        axios.delete(url)
        alert('Deleted');
        this.productLoad();
      }
  }
}
</script>