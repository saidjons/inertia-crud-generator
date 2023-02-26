 

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
window.axios = require('axios')
import notify from '@/plugins/notify';
window.notify = notify;
// make  fields gloabal 
import ImageUpload from '@/Components/Fields/uploader/ImageUpload.vue'
import FileUpload from '@/Components/Fields/uploader/FileUpload.vue'


 import TextareaField from '@/Components/Fields/TextareaField.vue';
import InputField from '@/Components/Fields/InputField.vue';
import OptionsField from '@/Components/Fields/OptionsField.vue';
import CheckboxField from '@/Components/Fields/CheckboxField.vue';
import CkeditorField from '@/Components/Fields/CkeditorField.vue'
import CKEditor from '@ckeditor/ckeditor5-vue';

import JsonEditorField from '@/Components/Fields/JsonEditorField.vue';
import JoditField from '@/Components/Fields/JoditField.vue'
import RelationField from '@/Components/Fields/RelationField.vue';
import TextViewField from '@/Components/Fields/TextViewField.vue';

import ErrorMessage from '@/Components/Error/Message.vue'
import AdminLayout from '@/Layouts/AdminLayout.vue';

 


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Inertia Crud';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {

         const vueApp = createApp({ render: () => h(app, props) })
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
         vueApp.component('JoditField' , JoditField)
        vueApp.component('FileUpload' , FileUpload);
	  vueApp.config.globalProperties = {
          
           
            $restifyApiUrl :'/api/restify',
          };


        return vueApp
        .use(plugin)
        .use(CKEditor)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
