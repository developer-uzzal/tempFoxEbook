import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import Notify from 'simple-notify'
import 'simple-notify/dist/simple-notify.css'

import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import 'nprogress/nprogress.css'


import { router } from '@inertiajs/vue3'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'

NProgress.configure({ showSpinner: false, speed: 400 })



router.on('start', () => NProgress.start())

router.on('finish', (event) => {

    if (!event.detail.visit.completed) return;

    NProgress.done()

})

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('EasyDataTable', Vue3EasyDataTable)
      .mount(el)
  },

//   progress: {
//     color: '#7367f0',
//   },


})
