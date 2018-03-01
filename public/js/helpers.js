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
function displayValidationError(errors, error_name, field_name)
{
    var group = $("." + name);
    var feedback = $("span." + name);

    group.addClass('is-invalid');
    feedback.text(errors[name][0]);
}

/**
 * Display validation error messages for all form fields.
 *
 * @param  {array} errors
 * @return void
 */
function displayValidationErrors(errors)
{
    for (let name in errors)
    {
        var group = $("#" + name);
        var feedback = $("span." + name);

        group.addClass('is-invalid');
        feedback.text(errors[name][0]);
    }
}

/**
 * Clear all validation errors at once
 *
 * @param  {array} errors
 * @param  {array} fields
 * @return {void}
 */
function clearAllValidationErrorsOnNewInput(errors, fields)
{
    for (let name in errors)
    {
        if (errors[name][0] == "Please fill up at least one field") {
            $(fields).on('keydown', function ()
            {
                var group = $(".form-group");

                group.removeClass('has-error');
                group.find('span.invalid-feedback').text('');
            });
        }
    }
}

/**
 * Remove the validation error message for a specific form field.
 *
 * @param  {string} name
 * @return void
 */
function clearValidationError(name)
{
    var group = $("#" + name);
    var feedback = $("span." + name);

    group.removeClass('is-invalid');
    feedback.text('');
}

/**
 * Remove validation error message on inserting the new field value.
 *
 * @return void
 */
function clearValidationErrorOnNewInput()
{
    $("input, textarea").on('keydown', function () {
        clearValidationError($(this).attr('id').replace('#', ''));
    });

    $("select").on('change', function () {
        clearValidationError($(this).attr('id').replace('#', ''));
    });

    $("input[name*='role_id']").click(function(){
        if($(this).is(':checked'))
        {
            clearValidationError('role_id')
        }
    })
}

/**
 * Remove validation error messages on modal close.
 *
 * @param  {array} fields
 * @return void
 */
function emptyModalErrorMessages(fields)
{
    $.each(fields, function (index, value){
      clearValidationError(value)
    });
}

/**
 * Remove modal form fields values on modal close.
 *
 * @return void
 */
function emptyModalFormValues()
{
    $("h5.modal-title span").text('')
    $("input, select, textarea").val("").end();
    $('#role_id').val(null).trigger('change');
    $('.form-group-avatar').hide()
}

/**
 * Empty the modal on close
 *
 * @param  {array} fields
 * @return void
 */
function emptyModalOnClose(fields, form)
{
    $(".modal").on("hidden.bs.modal", function() {
        form.formValidation('resetForm', true);
        emptyModalFormValues()
        emptyModalErrorMessages(fields)
    });
}

/**
 * Response on failed ajax call
 *
 * @param  {array} errors
 * @param  {string} modal
 * @return {[void]}
 */
function errorResponse(errors, modal)
{
    if(errors) {
        displayValidationErrors(errors)
        clearValidationErrorOnNewInput()
    }
    else {
        authorizationFailedNotification()
        modal.modal("hide")
    }
}

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

function successResponse(datatable, modal, message)
{
    datatable.ajax.reload();
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