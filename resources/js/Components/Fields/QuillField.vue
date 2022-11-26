<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import BlotFormatter from 'quill-blot-formatter'
import htmlEditButton from 'quill-html-edit-button'
//  quil.js
// highlight.js

// hljs.configure({   // optionally configure hljs
//   languages: ['javascript', 'ruby', 'python']
// });

export default {
    components: {
        QuillEditor
    },
    props: ['name', 'label', 'initialValue', 'action'],

    mounted () {
        if (this.initialValue) {
            this.content = this.initialValue
        }
        if (this.action) {
            this.showBtn = true
        }
    },

    methods: {
        inputChanged () {
            this.$emit('inputChanged', {
                value: this.content,
                name: this.name
            })
        },
        changeVisibility () {
            this.visible = !this.visible
        },
        emitChange (d) {
            this.$emit('inputChanged', {
                name: this.name,
                value: this.content
            })
        }
    },
    data () {
        return {
            showBtn: false,
            visible: true,
            content: '',
            htmlEditMod: {
                name: 'htmlEditButton',
                module: htmlEditButton,
                options: {
                    debug: false
                }
            },
            blotMod: {
                name: 'blotFormatter',
                module: BlotFormatter,
                options: {
                    /* options */
                }
            },
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['image', 'video', 'code-block', 'blockquote'],
                [{ align: [] }, 'link'],
                [{ list: 'ordered' }, { list: 'bullet' }]
            ],
            options: {
                debug: false,
                readOnly: false,
                theme: 'snow'
            }
        }
    }
}
</script>

<template>
    <div class="block  mb-2 clear-both">
        <!-- https://vueup.github.io/vue-quill/guide/modules.html -->

   
        <div class="mb-4">
            <label
                @click="changeVisibility"
                class="block pl-5 text-gray-600 text-sm font-semibold mb-2"
                for="username"
            >
                {{ label }}
            </label>
        </div>
        <div>
            <quill-editor
                v-show="visible"
                theme="snow"
                v-model:content="content"
                @text-change="inputChanged"
                :modules="[htmlEditMod, blotMod]"
                contentType="html"
                :toolbar="toolbar"
            ></quill-editor>
        </div>
    </div>
</template>
