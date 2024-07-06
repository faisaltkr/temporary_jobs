<script setup>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import { ref, onMounted,computed } from 'vue';
    import VueCal from 'vue-cal';
    import 'vue-cal/dist/vuecal.css';
  

      const scheduledVacancies = ref([]);
      const selectedEvent = ref(null);

      const props = defineProps({
        calendarEvents : Object,
        filters : Object,
        message : String
    });

    //   const fetchScheduledVacancies = () => {
    //     Inertia.get('/api/scheduled-vacancies', {}, { only: ['scheduledVacancies'] })
    //       .then(response => {
    //         scheduledVacancies.value = response.data.scheduledVacancies;
    //       });
    //   };
  
      const handleEventClick = (event) => {
        selectedEvent.value = event;
      };
  
    //   const cancelScheduledVacancy = (id) => {
    //     Inertia.put(`/api/scheduled-vacancies/${id}`, { status: 'canceled' })
    //       .then(() => {
    //         fetchScheduledVacancies();
    //         selectedEvent.value = null;
    //       });
    //   };
  
    //   let calendarEvents = computed(() => {
    //     return scheduledVacancies.value.map(sv => ({
    //       id: sv.id,
    //       title: sv.vacancy.job.job_name,
    //       start: sv.vacancy.start_date,
    //       end: sv.vacancy.end_date,
    //       description: sv.vacancy.description,
    //       status: sv.status,
    //     }));
    //   });

      //console.log(calendarEvents);
  
    // onMounted(calendarEvents);
  
  </script>
  
  <style scoped>
  /* Add styles specific to the calendar page here */
  .event-details {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    background: #f9f9f9;
  }
  </style>
<template>
    <Head title="Vacancies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Job Vacancies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                  
                    

                <div class="relative overflow-x-auto">
                    <div>
                        <h2>Weekly Calendar</h2>
                        <vue-cal :events="calendarEvents" @event-click="handleEventClick"></vue-cal>
                    
                        <div v-if="selectedEvent" class="event-details">
                            <h3>Event Details</h3>
                            <p>{{ selectedEvent.title }}</p>
                            <p>{{ selectedEvent.start }} - {{ selectedEvent.end }}</p>
                            <p>{{ selectedEvent.description }}</p>
                            <button @click="cancelScheduledVacancy(selectedEvent.id)">Cancel</button>
                        </div>
                        </div>
                </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>



  