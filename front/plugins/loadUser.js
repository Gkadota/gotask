import {useAuthStore} from '~/stores/AuthStore';
export default defineNuxtPlugin(async (nuxtApp) => {
    const auth = useAuthStore();
    if (!auth.isLoggedIn) {
        await auth.fetchUser();
    }
  })