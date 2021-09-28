<template>
  <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
    <div 
      class="flex items-center px-5 py-6 shadow-sm rounded-md" :class="customClass ? customClass : 'bg-gray-100' ">
      <div class="mx-5">
        <div :class=" customClass ? 'text-white' : 'text-gray-500' ">{{ header }}</div>
        <p class="mt-5 text-4xl font-semibold" :class=" customClass ? 'text-white' : 'text-gray-700' ">
          <slot></slot>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    header: String,
    customClass: String
  }
}
</script>