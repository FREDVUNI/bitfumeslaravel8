<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="saveForm">
                            <div class="form-group mt-5">
                                <div class="input-group mb-3">
                                    <input type="text" v-model="form.title" 
                                    :class="{'is-invalid':form.errors.has('title')}" id="item" 
                                    class="form-control" placeholder="Enter the todo item"
                                    @keydown="form.errors.clear('title')">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark">Add to the list</button>
                                    </div>
                                    <div class="invalid-feedback" v-show="form.errors.has('title')" v-text="form.errors.get('title')"></div>
                                </div>
                            </div>
                        </form>
                            <li v-for="item in this.items" :key="item.id" class="list-group-item">
                                <span>{{ item.title }}</span>
                                <span class="float-right d-flex">
                                    <button type="submit" class="btn text-success">mark</button>
                                   <button type="submit" class="btn text-secondary">edit</button>
                                    <button type="submit" class="btn text-danger">delete</button>
                                </span>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data(){
            return{
                form:new Form({
                    'title':''
                }),
                items:''
            }
        },
        methods:{
            saveForm(){
                let data = new FormData();
                data.append("title",this.form.title)
                axios.post('api/vuetodo',data)
                .then((response) =>{
                   this.form.reset(); 
                   this.getItems()
                })
                .catch(error=>{
                     this.form.errors.record(error.response.data)
                })
            },
            getItems(){
                axios.get('api/vuetodo')
                .then(response=>{
                    this.items = response.data
                })
                .catch(errors=>{
                    console.log(errors)
                })
            }
        },
        mounted() {
            this.getItems()
            console.log('Component mounted.')
        }
    }
</script>
