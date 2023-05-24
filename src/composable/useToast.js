import { ref } from "vue";

let isShow = ref (false);
let message = ref ("");

export default function useToast(){
    function toggleToast(show, props){
        isShow.value = show;
        message.value = props;
    }

    return {
        isShow,
        toggleToast,
        message
    }
}