<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm,Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const props = defineProps({
    jobs : Object,
    vacancy:Object
});

const vacancy = usePage().props.vacancy;

const form = useForm({
    job_id: vacancy.job_id,
    status: vacancy.status,
    start_date: vacancy.start_date,
    end_date: vacancy.end_date,
    description:vacancy.description
});

const updateVacancies = () => {
    form.put(route('vacancies.update', vacancy.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.job_id) {
                form.reset('job_id');
                select.value.focus();
            }
            if (form.errors.status) {
                form.reset('status');
                select.value.focus();
            }
        },
    });
};
</script>

<template>
    <Head title="Add Vacancies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <form @submit.prevent="updateVacancies" class="space-y-6 max-w-md mx-auto bg-white p-8 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                
                <div>
                    <InputLabel for="job_id" value="Select Job" />
                    <select v-model="form.job_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" >
                        <option v-for="job in jobs" :key="job.id" :value="job.id">
                        {{ job.job_name }}
                        </option>
                    </select>

                    <InputError :message="form.errors.job_id" class="mt-2" />
                </div>
                <div>
                    <InputLabel for="job_id" value="Select Status" />
                    <select v-model="form.status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" >
                       <option value="active">Active</option>
                       <option value="inactive">Inactive</option>
                    </select>

                    <InputError :message="form.errors.status" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="start-date" value="Start Date" />

                    <TextInput
                        id="start_date"
                        ref="start_date"
                        v-model="form.start_date"
                        type="date"
                        class="mt-1 block w-full"
                        autocomplete="off"
                    />

                    <InputError :message="form.errors.start_date" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="end_date" value="End Date" />

                    <TextInput
                        id="end_date"
                        v-model="form.end_date"
                        type="date"
                        class="mt-1 block w-full"
                        autocomplete="off"
                    />

                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="end_date" value="Description" />
                    <textarea v-model="vacancy.description" id="description"  rows="3" class="mt-1 block w-full"></textarea>
                    <InputError :message="form.errors.description" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        

            </div>
        </div>
    </AuthenticatedLayout>
</template>
