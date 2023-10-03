// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  runtimeConfig: {
    public: {
      appUrl: 'http://localhost:3000',
      apiUrl: 'http://localhost',
    }
  },

  modules: [
    '@pinia/nuxt',
    '@nuxtjs/tailwindcss'
  ],

  css: [
    '@fortawesome/fontawesome-svg-core/styles.css'
  ]

})
