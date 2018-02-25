.on('err.field.fv', function(e, data) {

    var invalidFields = data.fv.getInvalidFields()

    removeServerSideValidationFeedback(invalidFields)
})
.on('success.field.fv', function(e, data) {

    var validFields = data.element

    removeServerSideValidationFeedback(validFields)

});