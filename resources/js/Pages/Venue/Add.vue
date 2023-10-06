<script setup>
import '@vuepic/vue-datepicker/dist/main.css'

import { Head } from '@inertiajs/vue3';
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
import { useForm } from '@inertiajs/vue3'
import { faDollarSign, faTimes, faUserCircle, faPlus } from '@fortawesome/free-solid-svg-icons'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Datepicker from '@/Components/Datepicker.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InfoButton from '@/Components/InfoButton.vue';

/* add icons to the library */
library.add(faDollarSign, faTimes, faUserCircle, faPlus);

const data = useForm({
    nama: "",
    alamat: "",
    kategori: "",
    image: null,
    jadwalBooking : [
        {
            date: "",
            harga: 0,
            userId: 0
        }
    ]
})

const addJadwalElement = (event) => {
    event.preventDefault();
    data.jadwalBooking.push({
            date: "",
            harga: 0,
            userId: 0
    })
    console.log(data);
}

const removeJadwalElement = (event, index) => {
    event.preventDefault();
    data.jadwalBooking.splice(index, 1);
}

const submit = () => {
  data.post('/venue/add')
}

</script>
<template>
    <Head title="Venue" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Venue page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-row items-center justify-between">
                        <div class="py-6 px-8 text-gray-900">Create Venue</div>
                    </div>
                    <div class="row px-8 pb-8">
                        <form @submit.prevent="submit">
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama" id="nama-venue" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required v-model="data.nama"/>
                                <label for="nama-venue" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama Venue</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="kategori" id="kategori-venue" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required v-model="data.kategori"/>
                                <label for="kategori-venue" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kategori</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="alamat" id="alamat-venue" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required v-model="data.alamat"/>
                                <label for="alamat-venue" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="file" name="image" id="image-venue" class="w-fit block py-2.5 px-0 text-sm text-gray-900 bg-transparent border-0 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required @input="data.image = $event.target.files[0]"/>
                                <label for="image-venue" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Image</label>
                            </div>
                            <hr class="mb-8">
                            <div class="row">
                                <div class="w-full">
                                    <div class="text-gray-900 mb-8">Tambah Jadwal</div>
                                </div>
                                <template v-for="(input, index) in data.jadwalBooking" :key="index">
                                    <template v-if="index === 0">
                                        <div class="row flex flex-col sm:flex-row items-center gap-4 mb-4">
                                            <Datepicker :isRequired="true" v-model="data.jadwalBooking[index].date"/>
                                            <div class="w-full">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                                        <font-awesome-icon icon="fa-solid fa-dollar-sign" />
                                                    </div>
                                                    <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2  dark:bg-white dark:placeholder-gray-400dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Harga" v-model="data.jadwalBooking[index].harga" />
                                                </div>
                                            </div>
                                            <div class="w-full">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                                        <font-awesome-icon icon="fa-solid fa-user-circle" />
                                                    </div>
                                                    <select class="bg-white border pl-10 border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="data.jadwalBooking[index].userId">
                                                        <template v-for="(user, index) in $page.props.user" :key="index">
                                                            <template v-if="index === 0">
                                                                <option :value="0">None</option>
                                                            </template>
                                                            <option :value="user.id">{{ user.name }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-32">

                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="row flex flex-col sm:flex-row items-center gap-4 mb-4">
                                            <Datepicker :isRequired="true" v-model="data.jadwalBooking[index].date"/>
                                            <div class="w-full">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                                        <font-awesome-icon icon="fa-solid fa-dollar-sign" />
                                                    </div>
                                                    <input type="number" id="email-address-icon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2  dark:bg-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Harga" v-model="data.jadwalBooking[index].harga" />
                                                </div>
                                            </div>
                                            <div class="w-full">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                                        <font-awesome-icon icon="fa-solid fa-user-circle" />
                                                    </div>
                                                    <select id="countries" class="bg-white border pl-10 border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="data.jadwalBooking[index].userId">
                                                        <template v-for="(user, index) in $page.props.user" :key="index">
                                                            <template v-if="index === 0">
                                                                <option :value="0">None</option>
                                                            </template>
                                                            <option :value="user.id">{{ user.name }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-10">
                                                <DangerButton class="w-full justify-center" @click="removeJadwalElement($event, index)">
                                                    <font-awesome-icon icon="fa-solid fa-times"/>
                                                </DangerButton>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                                <div class="row flex">
                                    <InfoButton class="w-full justify-center" id="btn-add-form-venue" @click="addJadwalElement($event)">
                                        <font-awesome-icon icon="fa-solid fa-plus" class="mr-3"/>
                                        Add
                                    </InfoButton>
                                </div>
                            </div>
                            <button type="submit" class="text-white mt-16 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
