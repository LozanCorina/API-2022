import { ref } from 'vue'
import axios from 'axios'

export default function useCategories() {

    const categories = ref([])

    const getCategories = async () => {
         axios.get('api/v1/top-categories')
             .then(response => {
                 categories.value = response.data;
             });
    }

    return { categories, getCategories }
}
