M.AutoInit();

$('.dropdown-trigger').dropdown({
    coverTrigger: false,
});

$('#signupForm').submit(function(e) {
    e.preventDefault();
    var dataToPost = $(this).serializeArray();
    console.log(dataToPost);

    $.ajax({
        url: "./signup.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if (data) {
                $('#signupMessage').html(data);
                // $('#signupMessage').html("<div class='success'>Successful Ajax call. </div>");
            }
        },
        error: function() {
            $('#signupMessage').html("<div class='error'>Unsuccessful Ajax call. Try Again</div>");
            // M.toast({ html: 'Network error!' });
        }
    });
});


$('#loginForm').submit(function(e) {
    e.preventDefault();
    var dataToPost = $(this).serializeArray();

    $.ajax({
        url: "./login.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if (data == "success") {
                window.location.href = './mainPage.php';
            } else {
                $('#loginMessage').html(data);
            }
        },
        error: function() {
            $('#loginMessage').html("<div class='error'>Unsuccessful Ajax call. Try Again</div>")

            // M.toast({ html: 'Network error!' });
        }
    });
});

$("#forgotpassForm1").submit(function(e) {
    e.preventDefault();21
    console.log('heree');
    var dataToPost = $(this).serializeArray();

    $.ajax({
        url: "./forgotpass.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            $('#forgotpassMessage').html(data);
            setInterval(function() {
                location.reload();
            }, 8000);
        },
        error: function() {
            $('#forgotpassMessage').html("<div class='error'>Unsuccessful Ajax call. Try Again</div>");

            // M.toast({ html: 'Network error!' });
        }
    });
});