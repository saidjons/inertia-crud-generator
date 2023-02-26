// this is default vite for inertia app

import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';


import ImageUpload from '@/Components/Fields/uploader/ImageUpload.vue'
import FileUpload from '@/Components/Fields/uploader/FileUpload.vue'


 import TextareaField from '@/Components/Fields/TextareaField.vue';
import InputField from '@/Components/Fields/InputField.vue';
import OptionsField from '@/Components/Fields/OptionsField.vue';
import CheckboxField from '@/Components/Fields/CheckboxField.vue';
import CkeditorField from '@/Components/Fields/CkeditorField.vue'
import CKEditor from '@ckeditor/ckeditor5-vue';

import JsonEditorField from '@/Components/Fields/JsonEditorField.vue';
// import JoditField from '@/Components/Fields/JoditField.vue'
import RelationField from '@/Components/Fields/RelationField.vue';
import TextViewField from '@/Components/Fields/TextViewField.vue';

import ErrorMessage from '@/Components/Error/Message.vue'
import AdminLayout from '@/Layouts/AdminLayout.vue';

import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';




const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })

        // crud fields
        vueApp.component("AdminLayout", AdminLayout); 
        vueApp.component("TextareaField", TextareaField); 
        vueApp.component("InputField", InputField); 
        vueApp.component("OptionsField", OptionsField); 
        vueApp.component("CheckboxField", CheckboxField); 
        vueApp.component("CkeditorField", CkeditorField); 
        vueApp.component("JsonEditorField", JsonEditorField); 
        vueApp.component("RelationField", RelationField); 
        vueApp.component("TextViewField", TextViewField); 
        vueApp.component("ErrorMessage", ErrorMessage); 
       vueApp.component('ImageUpload' , ImageUpload);
        vueApp.component('EasyDataTable', Vue3EasyDataTable);

        // vueApp.component('JoditField' , JoditField)
       vueApp.component('FileUpload' , FileUpload);
       vueApp.config.globalProperties = {
        $restifyApiUrl :'/api/restify',
      };
        return vueApp
            .use(plugin)
        .use(CKEditor)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
