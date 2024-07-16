import { Ref, ref, watchEffect } from 'vue'
export const serialzieData = (data: any) => {
  return {
    ...data?.data
  }
}
export const fetchAPIPutRequest = (id: number) => {
  const data: Ref<any> = ref()
  const loading: Ref<boolean> = ref(false)
  const error: Ref<string> = ref('')
  watchEffect(async () => {
    loading.value = true
    try {
      const response = await fetch(import.meta.env.BASE_URL + `/products/${id}`)
      data.value = await response.json()
    } catch (error) {
      console.log(error)
      error.value = error
    } finally {
      loading.value = false
    }
  })
  return { data, loading, error }
}
