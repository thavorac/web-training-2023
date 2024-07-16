import { ref, Ref } from 'vue'
export const validateProductField = (data) => {
  const errorBrand: Ref<string | undefined> = ref()
  if (data.brand != undefined) {
    return { status: 400, message: 'brand is required', errorBrand }
  }
  return { ...data.value, status: 200 }
}

function validateRequired(data?: string, max?: number) {
  if (max) {
    if (data?.length <= max) {
      return true
    }
  }
  if (data) return true
  return false
}
export const submitProduct = async (
  data: Ref<any>,
  id: number,
  updatePropert: any,
  responseError: any
) => {
  const validate = validateProductField(data)
  if (validate.status == 200) {
    await fetch(import.meta.env.BASE_URL + `/product/${id}`, {
      method: 'POST',
      body: JSON.stringify({ ...validate, _method: 'PATCH' })
    })
  } else {
    // response something
    responseError?.(validate)
  }
}
