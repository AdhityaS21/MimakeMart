import { ref } from "vue";

let isShow = ref (false);
let id = ref (0);

export default function useDialog(){
    function toggleDialog(show, props){
        isShow.value = show;
        id.value = props;
    }

    return {
        isShow,
        toggleDialog,
        id
    }
}