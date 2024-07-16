import { ref, watchEffect, toValue } from 'vue'
// define data, error
export function useFetch(url){
    let data = ref(null)
    let error = ref(null)
    watchEffect(async()=>{
        try {
            await setTimeout(() => {
                
            }, 300);
        let urlData=toValue(url);
        let response= await fetch(urlData,)
         data.value=await response.json();
        } catch (error) {
            error.value=error;
        }
    })
    return {data,error}
}
export function usePost(){
    
}