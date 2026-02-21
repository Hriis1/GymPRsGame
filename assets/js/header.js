//Log out user
$("#log_out_btn").on("click", function () {
    $.ajax({
        url: projRoot + "/backend/users/userRouter.php",
        type: "POST",
        data: {
            action: "logOutUser"
        },
        success: function (res) {
            if (res == 1) {
                window.location.href = projRoot + "/index.php"; //redirect user to main page      
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Error occurred');
        }
    });
});