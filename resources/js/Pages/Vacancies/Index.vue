<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
// import DangerButton from '@/Components/DangerButton.vue';
// import PrimaryLink from '@/Components/PrimaryLink.vue';
// import Pagination from '@/Components/Pagination.vue';
// import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    vacancies : Object,
    filters : Object,
    message : String
});

// const filters = {
//     filter: props.filters.filter,
// }
// const form = useForm(filters);


</script>

<template>
    <Head title="Vacancies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Job Vacancies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
				 v-if="props.message"
				 class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
				 role="alert"
			  >
              <span class="font-medium">
					{{ props.message }}
				 </span>
                 </div>
                 <div class="relative overflow-x-auto pb-6">
                 <Link
                        :href="route('vacancies.create')"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Add Job Vacancies
                    </Link>
                    </div>


                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                  
                    

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Job Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Start Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    End Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="vacancy in props.vacancies" :key="vacancy.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ vacancy.job.job_name }}
                                </th>
                                <td class="px-6 py-4">
                                    <span v-if="vacancy.status=='active'" class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ vacancy.status }}</span>
                                    <span v-if="vacancy.status=='inactive'" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ vacancy.status }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ vacancy.start_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ vacancy.end_date }}
                                </td>
                                <td class="px-6 py-4">
                                    <Link
                        :href="route('vacancies.edit',vacancy.id)"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Edit
                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
