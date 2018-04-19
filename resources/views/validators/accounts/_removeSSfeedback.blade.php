.on('err.field.fv', function(e, data) {

    var invalidFields = data.fv.getInvalidFields()

    $.each(invalidFields, function (index, value) {

        var inputId = value.id

        clearError(inputId)
    })
})
.on('success.field.fv', function(e, data) {

    var validFields = data.element

    $.each(validFields, function (index, value) {

        var inputId = value.id

        clearError(inputId)
    })
});