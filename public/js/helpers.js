/**
 * Set modal autofocus field
 *
 * @param {string} modalName
 * @param {string} inputId
 * @return {void}
 */
function setModalAutofocus(modalName, inputId)
{
    modalName.on('shown.bs.modal', function () {
      $("#" + inputId).focus()
    })
}

/**
 * Send user notification.
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
 * Remove server side validation feedback
 *
 * @param  {array} fields
 * @return {void}
 */
// function removeServerSideValidationFeedback(fields)
// {
//     $.each(fields, function (index, value) {

//         var inputId = value.id

//         $('input#'+inputId+'.form-control').removeClass('is-invalid')
//     })
// }


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
// function displayValidationError(name)
// {
//     var group = $("."+name);
//     var feedback = $("span."+name);

//     group.addClass('is-invalid');
//     feedback.text(errors[name][0]);
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

//                 group.removeClass('is-invalid');
//                 group.find('span.invalid-feedback').text('');
//             });
//         }
//     }
// }

/**
 * Remove modal form fields values on modal close.
 *
 * @return void
 */
// function emptyModalFormValues()
// {
//     $(".modal-title span").text('')

//     $("select, textarea")
//         .val("")
//         .end();

//     $(':checkbox').each(function(i,item){
//         this.checked = item.defaultChecked;
//     });

//     $('.form-group-avatar').hide()
// }

/**
 * Empty the modal on close
 *
 * @param  {array} fields
 * @return void
 */
// function emptyModalOnClose(fields, form)
// {
//     $(".modal").on("hidden.bs.modal", function() {
//         form.formValidation('resetForm', true);
//         emptyModalFormValues()
//         emptyModalErrorMessages(fields)
//     });
// }

function successResponse(modal, message)
{
    // datatable.ajax.reload();
    modal.modal("hide")
    userNotification(message)
}

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

/**
 * Get checkbox values
 *
 * @param  {array} checked
 * @return {array}
 */
function checkboxValues(checked)
{
    var array = [];

    $.each(checked, function(key, value) {

        var value = $(this).val()
        array.push(value)
    })

    return array;
}

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

        // Remove client side validation
        clearJSError(field)

        // Attach server side validation
        displayServerError(field, feedback, errors[name][0])
    }
}

function clearJSError(field)
{
    field.parent('.form-group').removeClass('has-success')
    field.siblings('i.fv-control-feedback.fa.fa-check').removeClass('fa-check')
}

function displayServerError(field, feedback, error)
{
    field.addClass('is-invalid')
    feedback.text(error)
}

/**
 * Remove the error on inserting the new value.
 *
 * @return void
 */
function clearErrorOnNewInput()
{
    $("input, textarea").on('keydown', function () {
        clearError($(this).attr('id').replace('#', ''));
    });

    $("select").on('change', function () {
        clearError($(this).attr('id').replace('#', ''));
    });

    $("input[type=checkbox]").click(function() {
        clearError($(this).attr('id').replace('#', ''))
    })
}

/**
 * Empty the modal upon close.
 *
 * @param  {array} fields
 * @param  {object} form
 * @return {void}
 */
$.fn.emptyModal = function(fields, form) {

    $(this).on("hidden.bs.modal", function() {

        // Clear the form values
        clearForm(this)

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
function clearForm(form)
{
    $(form)
        .find("input[type=text], input[type=password], select, textarea")
        .val('').end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "").end();
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
