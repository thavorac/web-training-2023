import { useRoute } from 'vue-router'

export const useSidebar = () => {
  const route = useRoute()
  console.log(route.name)
  return { route }
}
