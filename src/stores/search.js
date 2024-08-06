// stores/search.js
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useSearchStore = defineStore('search', () => {
  const search = ref('');

  const setSearch = (value) => {
    search.value = value;
  };

  return { search, setSearch };
});
