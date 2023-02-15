<template>
    <div class="container mt-custom">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Edit</h4>
                        <hr>
                        <div v-if="validation.errors" class="mt-2 alert alert-danger">
                            <ul class="mt-0 mb-0">
                                <li v-for="(error, index) in validation.errors" :key="index">{{ `${error.param} :
                                ${error.msg}` }}</li>
                            </ul>
                        </div>
                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold mb-2">Nama</label>
                                <input type="text" class="form-control" v-model="customer.name">
                            </div>
                            <div class="form-group mt-3">
                                <label for="address" class="font-weight-bold mb-2">Alamat</label>
                                <input type="text" class="form-control" v-model="customer.address">
                            </div>
                            <div class="form-group mt-3">
                                <label for="no_telp" class="font-weight-bold mb-2">No.Telp</label>
                                <input type="text" class="form-control" v-model="customer.no_telp">
                            </div>
                            <div class="form-group mt-3">
                                <label for="active" class="font-weight-bold mb-2">Status</label>
                                <div>
                                    <select v-model="customer.active">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {

    setup() {

        //state customer
        const customer = reactive({
            name: '',
            address: '',
            no_telp: '',
            active: '',
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //vue router
        const route = useRoute()

        //mounted
        onMounted(() => {

            //get API from Backend
            axios.get(`http://localhost:8000/api/customers/${route.params.id}`)
                .then(response => {

                    //assign state customer with response data
                    customer.name = response.data.data.nama_customer
                    customer.address = response.data.data.alamat
                    customer.no_telp = response.data.data.nomor_telp
                    customer.active = response.data.data.status

                }).catch(error => {
                    console.log(error.response.data)
                })

        })

        //method update
        function update() {

            let name = customer.name
            let address = customer.address
            let no_telp = customer.no_telp
            let active = customer.active

            axios.put(`http://localhost:8000/api/customers/${route.params.id}`, {
                name: name,
                address: address,
                no_telp: no_telp,
                active: active,
            }).then(() => {

                //redirect ke customer index
                router.push({
                    name: 'index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            customer,
            validation,
            router,
            update
        }

    }

}
</script>