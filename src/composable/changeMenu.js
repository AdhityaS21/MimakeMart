import { ref } from "vue";

let category = ref ("");

export default function changeMenu(){
    function change(category, display){
        category.value = category;
    }

    return {
        change,
        category,
    }
}