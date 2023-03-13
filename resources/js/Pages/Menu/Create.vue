<script>
import stringToSlug from "@/plugins/stringToSlug";
import InputField from "@/Components/Fields/InputField.vue";
import CheckboxField from "@/Components/Fields/CheckboxField.vue";
import JsonEditorComponent from "@/Components/Fields/JsonEditorField.vue";
import schema from "@/plugins/json-editor/menu";
export default {
  components: {
    stringToSlug,
    InputField,
    CheckboxField,
    JsonEditorComponent,
  },
  mounted() {
    // this.initEditor()
  },
  methods: {
    removeError(d) {
      this.errors[d.index] = null;
      this.errors = this.errors.filter((el) => el != null);
    },

    setErrors(d) {
      let errors = this.flattenObject(d);
      let values = Object.values(errors);
      values = [...values];
      this.errors = values;
    },
    flattenObject(ob) {
      var toReturn = {};

      for (var i in ob) {
        if (!ob.hasOwnProperty(i)) continue;

        if (typeof ob[i] == "object" && ob[i] !== null) {
          var flatObject = this.flattenObject(ob[i]);
          for (var x in flatObject) {
            if (!flatObject.hasOwnProperty(x)) continue;

            toReturn[i + "." + x] = flatObject[x];
          }
        } else {
          toReturn[i] = ob[i];
        }
      }
      return toReturn;
    },
    initEditor() {
      this.jsonEditor = new JSONEditor(
        document.getElementById("menu-editor"),
        schema || getEditorSettings(this.editorSettings)
      );

      // this.jsonEditor.on("ready", () => {
      //   this.jsonEditor.on("change", () => {
      //     this.data = this.jsonEditor.getValue();
      //     this.emitto();
      //   });
      // });
    },

    setRole(data) {
      this.role = data.value;
    },

    setData(data) {
      this.data = JSON.stringify(data.value);
    },

    setPublished(data) {
      this.published = data.value;
    },

    store() {
      this.errors = null;

    
      window.axios
        .post(this.$restifyApiUrl + "/menus", {
          role: this.role,
          data: this.data,
          published: this.published,
          headers: {
            Accept: "application/json",
            "X-CSRF-TOKEN": this.$page.props.csrf,
            Authorization: "Bearer " + this.$page.props.auth.user.token,
          },
        })
        .then((res) => {
          console.log(res);
          if (res.status == 200) {
            window.notify(res.message);
          } else {
            this.setErrors(res.data);
          }
        })
        .catch((error) => {
          this.errors = Object.values(this.flattenObject(error.response.data.errors));
          if (this.errors) {
            window.notify(this.errors[0], "tip");
          } else {
            let model = window.location.pathname.split("/")[2];
            window.notify(
              `Please set up ${model} API  with Infyom.api:scaffold`,
              "warning"
            );
          }
        });
    },
  },

  data() {
    return {
      menuEditor: null,
      role: null,
      data: null,
      published: null,

      errors: [],
    };
  },
};
</script>

<template>
  <AdminLayout>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
      <div class="w-4/5 justify-center text-left mx-5">
        <template v-if="errors" v-for="(error, index) in errors" :key="error">
          <error-message :error="error" :index="index" @removeError="removeError" />
        </template>
        <div class="bg-white rounded px-2 pt-6 pb-8 mb-4">
          <input-field
            name="role"
            label="Enter role"
            fieldType="text"
            @inputChanged="setRole"
          />
          <!-- <textarea-field name='data' label='Enter data' @inputChanged='setData' />  -->
          <json-editor-component
            name="data"
            label="Set menu in json format"
            @inputChanged="setData"
            editorSettings="menu"
          />
          <!-- <div id="menu-editor"></div> -->

          <checkbox-field
            name="published"
            label=" Is published"
            initialValue="true"
            @inputChanged="setPublished"
          />
        </div>
        <!-- end of wrapper-->

        <!-- buttons start -->
        <div class="flex items-center justify-between">
          <button
            @click="store"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="button"
          >
            Create post
          </button>
          <a
            class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
            href="#"
          >
            cancel
          </a>
        </div>
        <!-- buttons end -->
      </div>
    </div>
  </AdminLayout>
</template>
