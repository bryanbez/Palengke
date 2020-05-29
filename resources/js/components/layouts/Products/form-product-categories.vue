<template>
    <div>

        <div>
            <h3> Add or Modify Product Category </h3>

            <form method="post" @submit.prevent="saveOrUpdateCategory">
                <label> Category: </label>
                <input type="text" v-model="category_info.category" class="form-control mb-2">

                <label> Description: </label>
                <textarea rows="8" v-model="category_info.description" class="form-control mb-2"> </textarea>

                <input type="submit" class="form-control btn btn-primary" name="btnSubmit" value="Save">

            </form>
        </div>

        <hr />

        <div class="row">

            <table class="table table-bordered">
                <tr>
                    <th> Category Name </th>
                    <th> Category Description </th>
                    <th colspan="2"> Options </th>
                </tr>
                <tr v-for="category in categories">
                    <td> {{ category.category_name }} </td>
                    <td> {{ category.category_desc }} </td>
                    <td> <a class="btn btn-secondary text-white" @click="modifyCategory(category.id)"> Modify </a> </td>
                    <td> <a class="btn btn-danger text-white" @click="deleteCategory(category.id)"> Delete </a> </td>
                </tr>
            </table>

        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                category_info: {
                    category: '',
                    description: ''
                },
                category_id: '',
                is_edit: false,
                categories: [],
            }
        },

        created() {
          this.refreshList();
        },

        methods: {

            refreshList() {
              let uri = 'http://localhost:8000/api/categories';
              axios.get(uri).then(response => {
                  this.categories = response.data;
              });
              this.clearTextboxes();
            },

            saveOrUpdateCategory() {
                if(this.is_edit == false) {
                    let uri = 'http://localhost:8000/api/categories';
                    axios.post(uri, this.category_info).then(response => {
                        console.log(response.data);
                        this.refreshList();

                    }).catch(error => {
                        console.log(error);
                    });
                }
                else {
                    let uri = `http://localhost:8000/api/categories/${this.category_id}`;
                    axios.put(uri, this.category_info).then(response => {
                        console.log(response.data);
                        this.category_id = '';
                        this.is_edit = false;
                        this.refreshList();

                    });
                }
            },

            modifyCategory(id) {
                this.is_edit = true;
                axios.get(`http://localhost:8000/api/categories/${id}`).then(response => {
                    this.category_id = response.data[0].id;
                    this.category_info.category = response.data[0].category_name;
                    this.category_info.description = response.data[0].category_desc;
                });
            },

            deleteCategory(id) {
                axios.delete(`http://localhost:8000/api/categories/${id}`).then(response => {
                    console.log(response.data);
                    this.refreshList();
                });
            },

            clearTextboxes() {
              this.category_info.category = '';
              this.category_info.description = '';
            }
        }
    }

</script>
