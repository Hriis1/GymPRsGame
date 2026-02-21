//General function for submiting a form through ajax
function submitForm(formSelector, url, action = "", expJson = false, successFunc = function (res) {
    location.reload();
}, method = "POST") {

    const form = $(formSelector)[0];
    const fd = new FormData(form);
    if (action) fd.append('action', action);

    $.ajax({
        url: url,
        type: method,
        data: fd,
        processData: false,
        contentType: false,
        dataType: expJson ? 'json' : undefined,
        success: function (res) {
            successFunc(res);
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Error occurred');
        }
    });
}
