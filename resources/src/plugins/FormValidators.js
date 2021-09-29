import { computed } from "vue";

export default function formSubmitValidators(user, errors) {

  const isValidToSubmit = computed(() => {
    let disabled = true;
    for (let prop in user) {
      if (!user[prop] || errors[prop]) {
        disabled = true;
        break;
      }
      disabled = false;
    }
    return disabled;
  });

  return { isValidToSubmit }
}