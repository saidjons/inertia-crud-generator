<template>
    <div class="mb-4 w-full">
        <label
            @click="changeVisibility"
            class="block pl-5 text-gray-600 text-sm font-semibold mb-2"
            for="username"
        >
            {{ label }}
        </label>
        <div
            v-show="visible"
            class="bg-gray-100 p-1 appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        >
            <ckeditor
                :editor="editor"
                v-model="editorData"
                :key="name"
                @blur="emitBlur"
            ></ckeditor>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { SimpleUploadAdapterPlugin } from '@/plugins/SimpleUploadAdapter'
export default {
    props: ['name', 'label', 'content'],
    components: {},
    beforeMount () {
        if (this.content) {
            this.editorData = this.content
        }
    },
    mounted () {
        // this is for keditor to image upload
        // plugins/SimpleUploadAdapter uses it
        window.token = this.$page.props.user.token
        window.csrf = this.$page.props.csrf
    },
    methods: {
        emitBlur () {
            this.$emit('blur', {
                name: this.name,
                value: this.editorData
            })
        },
        changeVisibility () {
            this.visible = !this.visible
        }
    },
    watch: {
        editorData (n, old) {
            this.$emit('inputChanged', {
                name: this.name,
                value: this.editorData
            })
        }
    },
    data () {
        return {
            visible: true,
            editor: ClassicEditor,
            editorData: null,
            editorConfig: {
                // The configuration of the editor.
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' }
                    ]
                },
              

                extraPlugins: [
                    SimpleUploadAdapterPlugin,
                   
                ]
            }
        }
    }
}
</script>
