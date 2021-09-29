<template>

  <div :class="className">
    <label 
      class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
      :for="id">
      <slot></slot>
    </label>

    <input 
      class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-gray-200" 
      :id="id"
      :type="type"
      :placeholder="placeholder"
      :value='value'
      v-on="listeners"
      @keyup="validateInput"
      @blur="validateInput"
    >
    <div class="text-red-500 text-xs italic" v-if="errors.name">
      {{ errors.name }}
    </div>
    <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
  </div>
</template>

<script>
import { ref } from "vue";
import FieldsValidations from "@/plugins/FieldsValidations";
export default {
  props: {
    className: {
      string: String,
      default: 'w-full md:w-1/2 px-3 mb-6 md:mb-0'
    },
    value: {
      type: String, 
      required: true
    },
    
    placeholder: {
      type: String
    },
    
    id: {
      type: String, 
      required: true
    },
    
    type: {
      type: String, 
      required: true,
      default: 'text'
    }
  },

  setup() {
    let input = ref("");
  
    const { validateNameField, errors } = FieldsValidations();
    
    const validateInput = () => {
      validateNameField("name", input.value);
    };

    return {input, errors, validateInput };
  },

  computed: {
    listeners() {
      return {
        ...this.$listeners,
        input: event => this.$emit("input", event.target.value)
      };
    }
  }
};
</script>

<style scoped>
.form-control {
  width: 100%;
  border: 1px solid #DDD;
  border-radius: 5px;
}
</style>
