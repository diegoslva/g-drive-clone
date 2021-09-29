import { reactive} from "@vue/reactivity";
import validations from '@/plugins/validations';

const errors = reactive({});

export default function FieldsValidations() {

  const { isEmpty, minLength, isEmail, isNum } = validations();

  const validateNameField = (fieldName, fieldValue) => {
    errors[fieldName] = !fieldValue ? isEmpty(fieldName, fieldValue) : minLength(fieldName, fieldValue, 4)
  }

  const validateEmailField = (fieldName, fieldValue) => {
    errors[fieldName] = !fieldValue ? isEmpty(fieldName, fieldValue) : isEmail(fieldName, fieldValue)
  }

  const validatePhoneField = (fieldName, fieldValue) => {
    errors[fieldName] = !fieldValue ? isEmpty(fieldName, fieldValue) : isNum(fieldName, fieldValue)
  }

  const validatePasswordField = (fieldName, fieldValue) => {
    errors[fieldName] = !fieldValue ? isEmpty(fieldName, fieldValue) : minLength(fieldName, fieldValue, 8)
  }

  return {
    errors, 
    validateNameField,
    validateEmailField,
    validatePhoneField,
    validatePasswordField
  }

}