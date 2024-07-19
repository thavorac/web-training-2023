<script setup lang="ts">
// import { useFetch } from '@/composable/useFetch';
import ProductView from '../../views/CategoryView.vue';
import IconSkLoading from '@/components/loading/SmsLoading.vue';
import IconCategories from '../icons/IconCategories.vue';
import IconsCirclePlus from '../icons/IconCirclePlus.vue';
import IconSearch from '../icons/IconSearch.vue';
import IconEdit from '../icons/IconEdit.vue';
import IconDelete from '../icons/IconDelete.vue';
import IconDetail from '../icons/IconDetail.vue';
import { RouterLink } from 'vue-router';
import { ref, toValue } from 'vue';

// const page = ref(1);
// const search = ref("");
// const { loading, data } = useFetch<any>(import.meta.env.VITE_BACKEND + /api/categories ? page = ${ toValue(page) } & search=${ toValue(search) });
</script>

<template>
    <ProductView :subtitle="'Promotion'">
        <div class="w-full selection:bg-gray-100 py-10 px-10 mt-10 rounded-lg bg-gray-200 shadow-md">
            <div class="w-full bg-white rounded-md p-2">
                <!-- inject the create and edit form here when click on create and edit action -->

                <div>
                    <router-view />
                </div>
            </div>

            <!-- <div class="text-xl text-right font-semibold text-black">Categories and sub-categories</div> -->

        </div>
        <!-- This will render the child routes (create/edit) -->

    </ProductView>
</template>

<!-- <script>
import axios from 'axios';

export default {
    name: 'students',
    data() {
        return {
            stduents: []
        }
    },
    mounted() {
        this.getStudents();
        console.log('i am herh')
    },
    methods: {
        getStudents() {
            axios.get('http://localhost/api/categories').then(res => {
                this.stduents = res.data.stduents
                console.log(this.stduents)
            })
        }
    }
}
</script> -->

<!-- <script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const students = ref([]);

const getStudents = () => {
  axios.get('http://localhost/api/categories').then(res => {
    students.value = res.data.students;
    console.log(students.value);
  });
};

onMounted(() => {
  getStudents();
  console.log('i am here');
});
</script> 

<input type="text" v-model="model.student.name">
<button @click="saveStudent">Save</button>

<script>
export default {
    name : 'studentCreate',
    data(){
        return{
            studentID : '',
            model:{
                student:{
                    name: '',
                    course:'',
                    email:'',

                }
            }
        },
        mounted(){
            this.studentId = this.$route.params.id;
            console.log(this.$route.params.id);
            updateCategoryData(categoryId){
                axios.put(`..../${categoryId}`,this.model.student).then(res => {
                    console.log(res.data.data);
                    //this.model.student = res.data.student.name
                    
                });
            },
            
        }
        methods:{
            saveStudent(){
                axios.post('.....',this.model.student)
                .then(res => {
                    console.log(res.data)
                    alert(res.data.message)

                    this.model.student = {
                        name: '',
                    course:'',
                    email:'',

                    }
                })
               
            }
        }
    },
}
</script>
-->