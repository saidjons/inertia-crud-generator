<script>
import Loader from './loader/index.vue'
export default {
    props: {
        error: '',
        name: '',
        label: '',
        initialValue: '',
        multiple: {
            type: Boolean,
            default: false
        },

        uploadURL: {
            type: String
        },
        deleteURL: {
            type: String
        }
    },
    components: { Loader },
    mounted() {
        if (this.initialValue) {
            this.media.push({ url: this.initialValue })
        }
    },
    methods: {
        flattenObject(ob) {
            var toReturn = {}

            for (var i in ob) {
                if (!ob.hasOwnProperty(i)) continue

                if (typeof ob[i] == 'object' && ob[i] !== null) {
                    var flatObject = this.flattenObject(ob[i])
                    for (var x in flatObject) {
                        if (!flatObject.hasOwnProperty(x)) continue

                        toReturn[i + '.' + x] = flatObject[x]
                    }
                } else {
                    toReturn[i] = ob[i]
                }
            }
            return toReturn
        },
        isMultiple() {
            if (this.multiple == false) {
                if (this.media.length) {
                    return false
                }
                return true
            } else {
                return true
            }
        },
        async deleteFile(index) {
            this.loading = true
            let formData = new FormData()
            formData.set(this.name, this.media[index].url)

            window.axios
                .post(this.deleteURL + this.name, formData, {
                    headers: {
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': this.$page.props.csrf,
                        Authorization: 'Bearer ' + this.$page.props.user.token
                    }
                })
                .then(res => {
                    if (res.status == 204) {
                        window.notify(res.message)
                    } else {
                        window.notify(res.data.error, 'warn')
                    }
                })
                .catch(error => {
                    console.warn(error)
                    this.loading = false
                })

            this.loading = false
        },
        async fileChange(event) {
            this.loading = true
            let files = event.target.files

            for (var i = 0; i < files.length; i++) {
                let formData = new FormData()
                let url = URL.createObjectURL(files[i])
                formData.set(this.name, files[i])

                window.axios
                    .post(this.uploadURL + this.name, formData, {
                        headers: {
                            // 'Accept':'application/json',
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': this.$page.props.csrf,
                            Authorization:
                                'Bearer ' + this.$page.props.user.token
                        }
                    })
                    .then(res => {
                        if (res.status == 200) {
                            this.media.push({ url: res.data.url })
                            this.emitUploaded()

                            window.notify(res.message)
                        } else {
                            window.notify(res.data.error, 'warn')
                            this.loading = false
                        }
                    })
                    .catch(error => {
                        console.warn(error)
                        this.loading = false
                    })
            }
            this.loading = false
            this.media_emit()
        },
        remove(index) {
            this.deleteFile(index)
            this.media.splice(index, 1)
            // this.media_emit()
            this.emitUploaded()
        },
        media_emit() {
            this.$emit('media', this.media)
        },
        changeVisibility() {
            this.visible = !this.visible
        },
        emitUploaded() {
            if (this.multiple == false) {
                this.$emit('uploaded', {
                    name: this.name,
                    value: this.media[0].url ?? null
                })
            } else {
                // later to be implemented
                //  this.$emit('imageUploaded',{
                //     name:this.name,
                //     value:this.media[0].url,
                // })
            }
        }
    },

    data() {
        return {
            media: [],
            loading: false,

            visible: true
        }
    }
}
</script>
<template>
    <div class="mb-4">
        <label @click="changeVisibility" class="block pl-5 text-gray-600 text-sm font-semibold mb-2" :for="name">
            {{ label }}
        </label>
        <div v-show="visible"
            class="bg-gray-100 p-1 appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <div>
                <div class="">
                    <div class="gallery width-100" :class="error ? 'red-border' : ''">
                        <Loader color="#0275d8" :active="loading" spinner="line-scale"
                            background-color="rgba(255, 255, 255, .4)" />
                        <div class="elements-wraper">
                            <!--UPLOAD BUTTON-->
                            <div class="button-container image-margin">
                                <label v-if="isMultiple()" :for="name" class="images-upload">
                                    <svg class="custum-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <path
                                                d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1zm1 15a1 1 0 1 1-2 0v-3H8a1 1 0 1 1 0-2h3V8a1 1 0 1 1 2 0v3h3a1 1 0 1 1 0 2h-3v3z"
                                                fill="currentColor" />
                                        </g>
                                    </svg>
                                </label>
                                <!-- accept="image/*" -->
                                <input class="hidden" @change="fileChange" :id="name" type="file" multiple="false"
                                    hidden max="100" />
                            </div>

                            <!--IMAGES PREVIEW-->
                            <div v-for="(image, index) in media" :key="index" class="image-container image-margin">
                                <a target="_blank" :href="image.url" :alt="url" :title="url"
                                    class="images-preview inline-block m-1 p-1">{{ image.url }}
                                </a>
                                <button @click="remove(index)" class="close-btn" type="button">
                                    <svg class="times-icon" xmlns="http://www.w3.org/2000/svg" width="0.8em"
                                        height="0.8em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 352 512">
                                        <path
                                            d="m242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28L75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256L9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-if="error" id="media-required">
                        <p class="red-text">{{ error }}</p>
                    </div>
                    <div v-for="(image, index) in media" :key="index" class="m-top">
                        <input type="text" name="media[]" :value="image.name" hidden />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.image-wraper {
    min-height: 200px !important;
}

.gallery {
    background-color: #fbfbfb !important;
    border-radius: 5px !important;
    border-style: solid !important;
    border: 1px solid #bbbbbb !important;
    height: 85px !important;
    line-height: 1 !important;
    box-sizing: border-box !important;
    height: auto !important;
}

.images-upload {
    background-color: #ffffff !important;
    border-radius: 5px !important;
    border: 1px dashed #ccc !important;
    display: inline-block !important;
    cursor: pointer !important;
    width: 165px !important;
    height: 88px !important;
}

.images-upload:hover {
    background-color: #f1f1f1 !important;
}

.image-container {
    display: inline-table !important;
    height: 90px !important;
    width: 140px !important;
    display: flex !important;
}

.images-preview {
    border-radius: 5px !important;
    border: 1px solid #ccc !important;
    display: inline-block !important;
    width: 140px !important;
    height: 88px !important;
    padding-top: -14px !important;
    transition: filter 0.1s linear;
}

.images-preview:hover {
    filter: brightness(90%);
}

.button-container {
    display: inline-flex !important;
    height: 90px !important;
    width: 140px !important;
    margin-right: 0.25rem !important;
    margin-left: 0.25rem !important;
}

.close-btn {
    background: none !important;
    color: red !important;
    border: none !important;
    padding: 0px !important;
    margin: 0px !important;
    font: inherit !important;
    cursor: pointer !important;
    outline: inherit !important;
    position: relative !important;
    right: 34px !important;
    top: -27px !important;
    width: 0px !important;
}

.times-icon {
    font-size: 3rem !important;
    padding: 0px !important;
    margin: 0px !important;
}

.custum-icon {
    color: #00afca !important;
    font-size: 3rem !important;
    margin-top: 18px !important;
    margin-left: 44px !important;
}

.custum-icon:hover {
    color: #29818f !important;
}

.close-btn:hover {
    color: rgb(190, 39, 39) !important;
}

/* -------------------- */

.width-100 {
    width: 100% !important;
}

.red-border {
    border: 1px solid #dc3545 !important;
    border-color: #dc3545 !important;
}

.elements-wraper {
    padding: 1rem !important;
    display: flex !important;
    flex-wrap: wrap !important;
}

.align-center {
    text-align: center !important;
}

.m-top-1 {
    margin-top: 0.25rem !important;
}

.image-margin {
    margin-right: 0.25rem !important;
    margin-left: 0.25rem !important;
    margin-top: 0.25rem !important;
    margin-bottom: 0.25rem !important;
}

.red-text {
    color: #d82335;
}
</style>
