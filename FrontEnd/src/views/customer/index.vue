<template>
    <div class="container mt-custom">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>DATA POST</h4>
                        <hr>
                        <router-link :to="{ name: 'create' }" class="btn btn-md btn-success">New</router-link>

                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No.Telp</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(customers, index) in customers" :key="index">
                                    <td>{{ customers.nama_customer }}</td>
                                    <td>{{ customers.alamat }}</td>
                                    <td>{{ customers.nomor_telp }}</td>
                                    <td>{{ customers.status }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'edit', params: { id: customers.id_customer } }"
                                            class="btn btn-sm btn-primary me-2">Edit</router-link>
                                        <button @click.prevent="customerDelete(customers.id_customer)"
                                            class="btn btn-sm btn-danger ml-1">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {

    setup() {

        //reactive state
        let customers = ref([])
        //mounted
        onMounted(() => {

            //panggil function "getDataCustomers" 
            getDataCustomers()

        })

        //function "getDataCustomers"
        function getDataCustomers() {

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/customers')
                .then(response => {

                    //assign state customer with response data
                    customers.value = response.data.data

                }).catch(error => {
                    console.log(error.response.data)
                })
        }
        // function "customerDelete"
        function customerDelete(id) {

            //delete data customer by ID
            axios.delete(`http://localhost:8000/api/customers/${id}`)
                .then(() => {

                    //panggil function "getDataCustomers"  
                    getDataCustomers()

                }).catch(error => {
                    console.log(error.response.data)
                })
        }

        //return
        return {
            customers,
            getDataCustomers,
            customerDelete,
        }

    }

}
</script>