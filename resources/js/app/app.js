 

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
window.axios = require('axios')
import notify from '@/plugins/notify';
window.notify = notify;
// make  fields gloabal 
 import TextareaField from '@/Components/Fields/Textarea.vue';
import InputField from '@/Components/Fields/Input.vue';
import OptionsField from '@/Components/Fields/Options.vue';
import CheckboxField from '@/Components/Fields/Checkbox.vue';
import CkeditorComponent from '@/Components/Fields/CkeditorImage.vue';
import FilePondImageUpload from '@/Components/Fields/FilePondImageUpload.vue';
import JsonEditorComponent from '@/Components/Fields/JsonEditor';
import ForeignKeyField from '@/Components/Fields/ForeignKeyField.vue';

import ErrorMessage from '@/Components/Error/Message.vue'
import AdminLayout from '@/Layouts/AdminLayout.vue';




const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

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
         vueApp.component("CkeditorComponent", CkeditorComponent); 
         vueApp.component("FilePondImageUpload", FilePondImageUpload); 
         vueApp.component("JsonEditorComponent", JsonEditorComponent); 
         vueApp.component("ForeignKeyField", ForeignKeyField); 
         vueApp.component("ErrorMessage", ErrorMessage); 
        return vueApp.use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
