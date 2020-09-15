let required = (propertyType) => {
    return val => val && val.length > 0 || `You must input a ${propertyType}`
}

let minLength = (propertyType, minLength) => {
    return val => val && v.length >= minLength || `${propertyType} must be at least ${minLength} `
}

let maxLength = (propertyType, maxLength) => {
    return val => val && v.length <= maxLength || `${propertyType} must be less then ${maxLength} `
}

export default {
    required,
    minLength,
    maxLength
}
