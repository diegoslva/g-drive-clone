<template>
  <div class="flex flex-col">
    <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="align-middle inline-block min-w-full border-b border-gray-200">
        <table class="min-w-full">
          <thead v-if='fields'>
            <tr class='bg-white border-b border-gray-00'>
              <th
                class='text-xs font-medium whitespace-nowrap leading-5 text-gray-400 text-left py-2 px-4'
                v-for="(field, index) in fields" 
                :key="index">{{ field.text }}
              </th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          
          <tbody>
            <tr 
              v-for="(row, index) in items"
              :key='index'
              :className='className'
              class="border-b-8 border-t-8 border-white"
              style='background-color: #F7F6F8'
            >
              <slot v-bind:row="row"></slot>

              <slot name='actions'>
                <td class="relative px-6 py-2 whitespace-nowrap text-right text-sm leading-5 font-medium">
                
                  <table-actions :user_id='row.id'></table-actions>

                </td>
              </slot>

            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</template>

<script>
import tableActions from '@/components/TableActions.vue'
import { ref } from "vue";
export default {
  components: {
    tableActions
  },
  props: {
    className: {
      type: String
    },
    
    routerLink: {
      type: String
    }, 
    
    fields: {
      default: '',
    },
    
    items: {
      type: [Array, Object]
    },
  },

  setup() {
    let selected = ref('');
    let dropdown = ref('');
    
    function onClick(id) {
      if(selected.value === id)  {
        selected.value = '';
      } else {
        selected.value = id
      }
    }
    
    function handleDropdownContacts(id) {
      if(dropdown.value === id)  {
        dropdown.value = '';
      } else {
        dropdown.value = id
      }
    }

    return { onClick, selected, dropdown, handleDropdownContacts}

  }
};
</script>



<style scoped>
  .dropdown-active {
    display:block!important;
    z-index: 20;
  }

  /* table {
    border-collapse: separate;
    border-spacing: 0 15px;
  } */

  
</style>