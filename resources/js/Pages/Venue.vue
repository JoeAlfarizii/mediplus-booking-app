<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InfoButton from '@/Components/InfoButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head } from '@inertiajs/vue3';
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core';
import { useForm } from '@inertiajs/vue3';

/* import specific icons */
import { faPlus, faTrash , faBookOpen} from '@fortawesome/free-solid-svg-icons'

import { ref } from 'vue';

const confirmingUserDeletion = ref(false);

/* add icons to the library */
library.add(faPlus, faTrash, faBookOpen);

const form = useForm({
    id_venue: '',
});

const confirmUserDeletion = (id_venue) => {
    confirmingUserDeletion.value = true;

    form.id_venue = id_venue;
    console.log(form);
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};

const deleteVenue = () => {
    form.delete(route('venue.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

</script>

<template>
    <Head title="Venue" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Venue page</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-row items-center justify-between">
                        <div class="p-6 text-gray-900">Venue List</div>
                        <template v-if="$page.props.auth.user.role === 'admin'">
                            <InfoButton
                                :href="route('venue.add')"
                                class="mr-6"
                            >   
                                <font-awesome-icon icon="fa-solid fa-plus" class="mr-3"/>
                                Add Venue
                            </InfoButton>
                        </template>
                    </div>
                    <!-- <h1>{{ $page.props }}</h1> -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-6 mb-6">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="$page.props.venue.length > 0">
                                <template v-for="(data, index) in $page.props.venue" :key="index">
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                        {{ data.nama }}
                                    </th>
                                    <td class="px-6 py-4 text-white">
                                        {{ data.alamat }}
                                    </td>
                                    <td class="px-6 py-4 text-white">
                                        {{ data.kategori }}
                                    </td>
                                    <td class="px-6 py-4 text-center flex justify-center">
                                        <template v-if="$page.props.auth.user.role === 'user'">
                                            <InfoButton
                                                :href="route('venue.booking', {
                                                    id: data.id
                                                })"
                                                class="mr-6"
                                            >   
                                                <font-awesome-icon icon="fa-solid fa-book-open" class="mr-3"/>
                                                Booking
                                            </InfoButton>
                                        </template>
                                        <template v-if="$page.props.auth.user.role === 'admin'">
                                            <DangerButton
                                                :href="route('venue.add')"
                                                class="mr-6"
                                                @click="confirmUserDeletion(data.id)"
                                            >   
                                                <font-awesome-icon icon="fa-solid fa-trash" class="mr-3"/>
                                                Delete
                                            </DangerButton>
                                        </template>
                                    </td>
                                </tr>
                                </template>
                            </tbody>
                            <tbody v-else>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th colspan="4" scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center py-16">
                                        No Data Available
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <Modal :show="confirmingUserDeletion" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete your account?
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please
                        enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <DangerButton
                            class="ml-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="deleteVenue"
                        >
                            Delete Account
                        </DangerButton>
                    </div>
                </div>
            </Modal>
        </div>
    </AuthenticatedLayout>
</template>
