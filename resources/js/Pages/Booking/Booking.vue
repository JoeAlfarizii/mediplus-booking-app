<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head } from '@inertiajs/vue3';
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
import { useForm } from '@inertiajs/vue3'

/* import specific icons */
import { faDollarSign, faUserCircle , faBookOpen, faCalendarDays, faBan} from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faDollarSign, faUserCircle, faBookOpen, faCalendarDays, faBan);

const data = useForm({
    user_id: '',
    book_id: ''
});

const bookingButton = (event, book_id, user_id) => {
    event.preventDefault();

    data.book_id = book_id;
    data.user_id = user_id;

    data.put('/venue/book');

}

</script>
<template>
    <Head title="Booking" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Booking Page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <!-- <h1>{{ $page.props }}</h1> -->
                    <div class="flex flex-col sm:flex-row">
                        <div class="w-full">
                            <img class="shadow-md" :src="$page.props.venue.imageurl">
                        </div>
                        <div class="w-full flex justify-center flex-col pl-6 pt-5 sm:pl-24 sm:pt-0">
                            <h1 class="text-xl font-bold">{{ $page.props.venue.nama }}</h1>
                            <p class="pb-3">{{ $page.props.venue.kategori }}</p>
                            <p>{{ $page.props.venue.alamat }}</p>
                        </div>
                    </div>
                    <hr class="my-14">
                    <div>
                        <p class="font-semibold text-xl text-gray-800 leading-tight text-center mb-10">Jadwal Booking</p>
                    </div>
                    <div class="flex flex-row sm:gap-16 sm:px-16">
                        <template v-for="(booking, index) in $page.props.booking" :key="index">
                            <div class="basis-1/2">
                                <div class="card shadow-md p-10 bg-gradient-to-b from-gray-600 via-gray-500 to-gray-600 rounded-md">
                                    <div class="flex flex-col justify-center gap-6 mb-10 text-gray-200 pl-10">
                                        <div class="flex flex-row items-center">
                                            <font-awesome-icon icon="fa-solid fa-calendar-days" class="mr-3 w-6 h-6"/>
                                            <p>Tanggal Booking</p>
                                            <p class="pl-4">{{ booking.tanggal }}</p>
                                        </div>
                                        <div class="flex flex-row items-center">
                                            <font-awesome-icon icon="fa-solid fa-dollar-sign" class="mr-3 w-6 h-6"/>
                                            <p>Harga</p>
                                            <p class="pl-4">{{ booking.harga }}</p>
                                        </div>
                                        <div class="flex flex-row items-center">
                                            <font-awesome-icon icon="fa-solid fa-user-circle" class="mr-3 w-6 h-6"/>
                                            <p>Booked By</p>
                                            <p class="pl-4">{{ booking.by }}</p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <template v-if="booking.user_id == 0">
                                            <PrimaryButton class="w-full h-12 justify-center" @click="bookingButton($event, booking.id, $page.props.auth.user.id)">
                                                <font-awesome-icon icon="fa-solid fa-book-open" class="mr-3"/>
                                                Book Now
                                            </PrimaryButton>
                                        </template>
                                        <template v-else>
                                            <DangerButton class="w-full h-12 justify-center" disabled>
                                                <font-awesome-icon icon="fa-solid fa-ban" class="mr-3"/>
                                                Jadwal Booked
                                            </DangerButton>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
