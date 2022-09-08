M.AutoInit();

$('#updateUnameForm').submit(function(e) {
    console.log(dataToPost);
    e.preventDefault();
    var dataToPost = $(this).serializeArray();

    $.ajax({
        url: "./updateName.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if (data) {
                $('.editMessage').html(data);
                // $('#signupMessage').html("<div class='success'>Successful Ajax call. </div>");
            } else {
                location.reload();

            }
        },
        error: function() {
            $('.editMessage').html("<div class='error'>Unsuccessful Ajax call. Try Again</div>");
            // M.toast({ html: 'Network error!' });
        }
    });
});

$('#updateEmailForm').submit(function(e) {
    console.log('email');
    e.preventDefault();
    var dataToPost = $(this).serializeArray();

    $.ajax({
        url: "./updateEmail.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if (data) {
                console.log(data);
                $('.editMessage').html(data);
                // $('#signupMessage').html("<div class='success'>Successful Ajax call. </div>");
            }
        },
        error: function() {
            $('.editMessage').html("<div class='error'>Unsuccessful Ajax call. Try Again</div>");
            // M.toast({ html: 'Network error!' });
        }
    });
});

$('#updatePassForm').submit(function(e) {
    console.log('pass');
    e.preventDefault();
    var dataToPost = $(this).serializeArray();

    $.ajax({
        url: "./updatePass.php",
        type: "POST",
        data: dataToPost,
        success: function(data) {
            if (data) {
                console.log(data);
                $('.editMessage2').html(data);
                // $('#signupMessage').html("<div class='success'>Successful Ajax call. </div>");
            }
        },
        error: function() {
            $('.editMessage2').html("<div class='error'>Unsuccessful Ajax call. Try Again</div>");
            // M.toast({ html: 'Network error!' });
        }
    });
});