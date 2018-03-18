/**
 * Notify user about a successful action
 *
 * @param  {string} message
 * @param  {string} type
 * @return {mixed}
 */
function userNotification(message, type="success")
{
    return $.notify(message, type)
}

/**
 * Toggle hidden field visibility by changing checkbox field value
 *
 * @param  {string} checked_field
 * @param  {string} hidden_field
 * @return {void}
 */
function toggleHiddenFieldWithCheckbox(checked_field, hidden_field)
{
    checked_field.change(function() {

        this.checked ? hidden_field.hide().val('').end() : hidden_field.show()

    });
}

/**
 * Toggle hidden field by changing the radio field value.
 *
 * @param  {string} checked_value
 * @param  {string} hidden_field
 * @return {void}
 */
function toggleHiddenFieldWithRadio(checked_value, hidden_field)
{
    $('input:radio').change(function(){

        var value = $("form input[type='radio']:checked").val();

        value == checked_value ? hidden_field.show() : hidden_field.hide().val('').end()
    });
}

/**
 * Remove server side validation feedback
 *
 * @param  {array} fields
 * @return {void}
 */
function removeServerSideValidationFeedback(fields)
{
    $.each(fields, function (index, value) {

        var inputId = value.id

        $('input#'+inputId+'.form-control').removeClass('is-invalid')
    })
}

/**
 * Set datatable counter column
 *
 * @param {object} datatable
 * @return {void}
 */
function setTableCounterColumn(datatable)
{
    datatable.on('order.dt search.dt', function () {
        datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            x = i+1
            cell.innerHTML = '<span>'+ x +'</span>';
        } );
    } ).draw();
}


/**
 * Highlight the cells on hovering
 *
 * @param  {string} modeltable
 * @param  {object} datatable
 * @return void
 */
function highlightDataTable(modelTable, datatable)
{
    $(document).on('mouseenter', modelTable + " td", function () {

        var colIdx = $(this).parent().children().index($(this));

        $( datatable.cells().nodes() ).removeClass( 'highlight' );
        $( datatable.column( colIdx ).nodes() ).addClass( 'highlight' );
    });

    // Remove the highlight
    $(document).on('mouseleave', modelTable + " td" , function () {

        $( datatable.cells().nodes() ).removeClass( 'highlight' );
    });
}

/**
 * Generate random string
 *
 * @param  {{numeric}} length
 * @return string
 */
function randomString(length)
{
    return Math.random().toString(36).substring(length);
}

/**
 * Display validation error message for a single form field.
 *
 * @param  {array} errors
 * @param  {string} error_name
 * @param  {string} field_name
 * @return void
 */
// function displayValidationError(errors, error_name, field_name)
// {
//     var group = $("." + name);
//     var feedback = $("span." + name);

//     group.addClass('is-invalid');
//     feedback.text(errors[name][0]);
// }

/**
 * Display validation error messages for all form fields.
 *
 * @param  {array} errors
 * @return void
 */
// function displayValidationErrors(errors)
// {
//     for (let name in errors)
//     {
//         var group = $("#" + name);
//         var feedback = $("span." + name);

//         group.addClass('is-invalid');
//         feedback.text(errors[name][0]);
//     }
// }

/**
 * Clear all validation errors at once
 *
 * @param  {array} errors
 * @param  {array} fields
 * @return {void}
 */
// function clearAllValidationErrorsOnNewInput(errors, fields)
// {
//     for (let name in errors)
//     {
//         if (errors[name][0] == "Please fill up at least one field") {
//             $(fields).on('keydown', function ()
//             {
//                 var group = $(".form-group");

//                 group.removeClass('has-error');
//                 group.find('span.invalid-feedback').text('');
//             });
//         }
//     }
// }

/**
 * Remove the validation error message for a specific form field.
 *
 * @param  {string} name
 * @return void
 */
// function clearValidationError(name)
// {
//     var group = $("#" + name);
//     var feedback = $("span." + name);

//     group.removeClass('is-invalid');
//     feedback.text('');
// }

/**
 * Remove validation error message on inserting the new field value.
 *
 * @return void
 */
// function clearValidationErrorOnNewInput()
// {
//     $("input, textarea").on('keydown', function () {
//         clearValidationError($(this).attr('id').replace('#', ''));
//     });

//     $("select").on('change', function () {
//         clearValidationError($(this).attr('id').replace('#', ''));
//     });

//     $("input[name*='role_id']").click(function(){
//         if($(this).is(':checked'))
//         {
//             clearValidationError('role_id')
//         }
//     })
// }

/**
 * Remove validation error messages on modal close.
 *
 * @param  {array} fields
 * @return void
 */
// function emptyModalErrorMessages(fields)
// {
//     $.each(fields, function (index, value){
//       clearValidationError(value)
//     });
// }

/**
 * Remove modal form fields values on modal close.
 *
 * @return void
 */
// function emptyModalFormValues()
// {
//     $("h5.modal-title span").text('')
//     $("input, select, textarea").val("").end();
//     $('#role_id').val(null).trigger('change');
//     $('.form-group-avatar').hide()
// }

/**
 * Empty the modal on close
 *
 * @param  {array} fields
 * @return void
 */
// function emptyModalOnClose(fields, form, hidden_field)
// {
//     $(".modal").on("hidden.bs.modal", function() {
//         clearForm(form, hidden_field)
//         emptyModalErrorMessages(fields)
//         form.formValidation('resetForm', true);
//     });
// }

/**
 * Response on failed ajax call
 *
 * @param  {array} errors
 * @param  {string} modal
 * @return {[void]}
 */
// function errorResponse(errors, modal)
// {
//     if(errors) {
//         displayValidationErrors(errors)
//         clearValidationErrorOnNewInput()
//     }
//     else {
//         authorizationFailedNotification()
//         modal.modal("hide")
//     }
// }


/**
 * Alert the user on deletion
 *
 * @param  {string} name
 * @param  {string} url
 * @return void
 */
function swalDelete(url, name, datatable)
{
    swal({
        title: 'Are you sure?',
        text: 'You will not be able to recover the'+ name + '!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url : url,
                type : "DELETE",
                success : function(response) {

                    datatable.ajax.reload()
                    userNotification(response.message)
                },
                error: function(response)
                {
                    //
                }
            })
        }
    })
}

//-------------------------------------------------------------------------
//=============================================================================
/**
 * Ajax error response
 *
 * @param  {array} errors
 * @param  {string} modal
 * @return {[void]}
 */
function errorResponse(errors, modal)
{
    if(errors) {
        displayErrors(errors)
        clearErrorOnNewInput()
    }
    else {
        authorizationFailedNotification()
        modal.modal("hide")
    }
}

/**
 * Display validation error messages for all form fields.
 *
 * @param  {array} errors
 * @return void
 */
function displayErrors(errors)
{
    for (let name in errors)
    {
        var field = $("."+name)
        var feedback = $("span."+name).show()

        // Attach server side validation
        displayServerError(field, feedback, errors[name][0])

        // Remove client side validation
        clearJSError(field)

    }
}

/**
 * Remove the error on inserting the new value.
 *
 * @return void
 */
function clearErrorOnNewInput()
{
    $("input, textarea").on('keydown', function () {
        clearError($(this).attr('name'));
    });

    $("select").on('change', function () {
        clearError($(this).attr('name'));
    });

    $("input[type=checkbox], input[type=radio]").click(function() {

        var splitted = $(this).attr('name').split("-")
        var name = splitted[1]

        clearError(name)
    })
}

/**
 * Display server error.
 *
 * @param  {string} field
 * @param  {string} feedback
 * @param  {string} error
 * @return {void}
 */
function displayServerError(field, feedback, error)
{
    field.addClass('is-invalid')
    feedback.text(error)
}

/**
 * Clear client side error.
 *
 * @param  {string} field
 * @return {void}
 */
function clearJSError(field)
{
    field.parent('.form-group').removeClass('has-success')
    field.siblings('i.fv-control-feedback.fa.fa-check').removeClass('fa-check')
}

/**
 * Success ajax response.
 *
 * @param  {string} modal
 * @param  {string} message
 * @return {void}
 */
function successResponse(modal, message)
{
    userNotification(message)
    modal.modal("hide")
}

/**
 * Set modal autofocus field
 *
 * @param {string} modalName
 * @param {string} inputId
 * @return {void}
 */
$.fn.setAutofocus = function(inputId)
{
    $(this).on('shown.bs.modal', function () {
        $(this).find("#" + inputId).focus()
    })
}

/**
 * Determine how to create the password.
 *
 * @param  {string} field
 * @return {string}
 */
function generatePassword(field)
{
    var auto_password = randomString(6);
    var manual_password = $('input[type=password]').val();

    return isChecked(field) ? auto_password : manual_password;
}

/**
 * Determine if the field is checked.
 *
 * @param  {string}  field
 * @return {Boolean}
 */
function isChecked(field) {

    return field[0].checked
}

/**
 * Change password
 *
 * @return {string}
 */
function changePassword()
{
    var auto_password = randomString(6)
    var manual_password = $("#_password").val()

    var checked_value = $("input[type='radio']:checked").val();

    if(checked_value == "manual")
    {
        var password = manual_password
    }
    else if(checked_value == "auto")
    {
        var password = auto_password
    }

    return password;
}

/**
 * Empty the modal upon close.
 *
 * @param  {array} fields
 * @param  {object} form
 * @param  {string} hidden_filed
 * @return {void}
 */
$.fn.emptyModal = function(fields, form, checked_field, hidden_field) {

    $(this).on("hidden.bs.modal", function() {

        // Clear the form values
        clearForm(this, checked_field, hidden_field)

        // Clear the server side errors
        clearServerErrors(fields)

        // Clear the client side errors
        form.formValidation('resetForm', true);
    })
}

/**
 * Clear the form values.
 *
 * @param  {object} form
 * @return {void}
 */
function clearForm(form, checked_field, hidden_field)
{
    $(form)
        .find("input[type=text], input[type=password], select, textarea")
        .val('').end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "").end()
        .find(checked_field).prop('checked', true);

    hidden_field.hide()
}

/**
 * Remove all server side errors.
 *
 * @param  {array} fields
 * @return void
 */
function clearServerErrors(fields)
{
    $.each(fields, function (index, name){
      clearError(name)
    });
}

/**
 * Remove the server side error for a specified field.
 *
 * @param  {string} name
 * @return void
 */
function clearError(name)
{
    var field = $("."+name);
    var feedback = $("span."+name).hide();

    field.removeClass('is-invalid');
    feedback.text('');
}