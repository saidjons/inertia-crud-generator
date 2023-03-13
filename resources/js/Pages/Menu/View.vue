<script>
import stringToSlug from "@/plugins/stringToSlug";
import InputField from "@/Components/Fields/InputField.vue";
import CheckboxField from "@/Components/Fields/CheckboxField.vue";
import {jsonHighlight} from "@/plugins/functions";
export default {
  components: {
    stringToSlug,
    InputField,
    CheckboxField,
    jsonHighlight,
	
  },
  beforeMount() {
    this.role = this.$page.props.model.role;
    this.modelId = this.$page.props.model.id;

    this.published = this.$page.props.model.published;
    this.jsonData = this.$page.props.model.data;
	
  },
  mounted() {
    document.getElementById("json-data").appendChild(document.createElement('pre')).innerHTML = jsonHighlight(JSON.parse(this.$page.props.model.data, undefined, 4));
  },
  methods: {
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

    setRole(data) {
      this.role = data.value;
    },

    setData(data) {
      this.data = JSON.stringify(data.value);
    },

    setPublished(data) {
      this.published = data.value;
    },
  },

  data() {
    return {
      modelId: null,
      role: null,
      jsonData: "",
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
          <div class="bg-white rounded px-2 pt-6 pb-8 mb-4">
            <template v-if="errors" v-for="error in errors" :key="error">
              <error-message :error="error" />
            </template>

            <input-field
              name="role"
              label="Enter role"
              fieldType="text"
              @inputChanged="setRole"
              :initialValue="role"
            />
            <!-- <textarea-field name='data' label='Enter data' @inputChanged='setData' />  -->
            
            <div
             id="json-data"
             class="container border-2">
            </div>

            <checkbox-field
              name="published"
              label=" Is published"
              @inputChanged="setPublished"
              :initialValue="published"
            />
          </div>
          <!-- end of wrapper-->

          <!-- buttons start -->

          <!-- buttons end -->
        </div>
      </div>
  </AdminLayout>
</template>
