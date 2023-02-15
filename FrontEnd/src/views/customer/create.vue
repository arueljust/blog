<template>
    <div class="container mt-custom">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Tambah</h4>
                        <hr>
                        <div v-if="validation.errors" class="mt-2 alert alert-danger">
                            <ul class="mt-0 mb-0">
                                <li v-for="(error, index) in validation.errors" :key="index">{{ `${error.param} : ${error.msg}` }}</li>
                            </ul>
                        </div>
                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold mb-2">Nama</label>
                                <input type="text" class="form-control" v-model="customer.name" placeholder="nama">
                            </div>
                            <div class="form-group">
                                <label for="address" class="font-weight-bold mb-2">Alamat</label>
                                <input type="text" class="form-control" v-model="customer.address" placeholder="alamat">
                            </div>
                            <div class="form-group">
                                <label for="no_telp" class="font-weight-bold mb-2">No.Telp</label>
                                <input type="text" class="form-control" v-model="customer.no_telp" placeholder="No.Telp">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </form>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {

    setup() {

        //state customer
        const customer = reactive({
            name: '',
            address: '',
            no_telp: '',
            status: '',
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //method store
        function store() {

            let name   = customer.name
            let address   = customer.address
            let no_telp   = customer.no_telp
            let active   = customer.active
            

            axios.post('http://localhost:8000/api/customers', {
                name: name,
                address: address,
                no_telp: no_telp,
                active: active,
            }).then(() => {

                //redirect ke post index
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
            store
        }

    }

}
</script>