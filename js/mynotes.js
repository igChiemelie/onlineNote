M.AutoInit();
$(function() {
    var activeNote = 0;
    var editMode = false;
    // button class = 'btn  delt red btn-medium waves-effect waves-light'
    // type = 'button' > Delt < /button>

    $.ajax({
        url: "./loadnotes.php",
        success: function(data) {
            $('#notes').html(data);
            clickOnNote();
            clickOnDelete();


        },
        error: function() {
            $("#alertContent").text("There was an Error with the Ajax call. Pls try again!");

        }
    });

    $('#addNote').on('click', function() {
        $.ajax({
            url: "./createnote.php",
            success: function(data) {
                if (data == 'error') {
                    $("#alertContent").text("There was an Error while inserting your new notes");
                    // $("#alert").fadeIn();
                } else {
                    activeNote = data;
                    $('textarea').val("");
                    //show hide elements
                    showHide(["#notepad", "#allNotes"], ["#notes", "#addNote", "#edit", "#done", ]);
                    $('textarea').focus();
                }

            },
            error: function() {
                $("#alertContent").text("There was an Error with the Ajax call. Pls try again!");

            }
        });

    });

    //Type note:Ajax call to update.php;
    $("textarea").keyup(function() {
        //Ajax call to update the task of id activeNote
        $.ajax({
            url: "./updatenote.php",
            method: "POST",
            data: { note: $(this).val(), id: activeNote },
            success: function(data) {
                if (data == 'error') {
                    $("#alertContent").text("There was an Error while updating your new notes");

                }
            },
            error: function() {
                $("#alertContent").text("There was an Error with the Ajax call. Pls try again!");

            }
        });
    });


    //click on all notes button
    $("#allNotes").on('click', function() {
        $.ajax({
            url: "./loadnotes.php",
            success: function(data) {
                $('#notes').html(data);
                showHide(["#notes", "#addNote", "#edit"], ["#allNotes", "#notepad"]);
                clickOnNote();
                clickOnDelete();
            },
            error: function() {
                $("#alertContent").text("There was an Error with the Ajax call. Pls try again!");

            }
        });

    });

    $('#done').on('click', function() {
        console.log('done');
        editMode = false;
        $(".noteheader").removeClass("col s6 m10 l10 ");
        showHide(['#edit'], [this, '.delete']);


    });

    $("#edit").on('click', function() {
        editMode = true;
        $(".noteheader").addClass("col s6 m10 l10 ");
        showHide(['#done', '.delete'], [this]);
        // clickOnNote();


    });

    function clickOnNote() {
        $(".noteheader").on('click', function() {

            if (!editMode) {
                activeNote = $(this).attr('id');
                // console.log(activeNote);
                $("textarea").val($(this).find('.text').text());
                //show hide elements
                showHide(["#notepad", "#allNotes"], ["#notes", "#addNote", "#edit", "#done", ]);
                $('textarea').focus();
            }
        });
    }

    function clickOnDelete() {
        $(".delete").on('click', function() {
            var deleteButton = $(this);
            console.log(deleteButton);
            $.ajax({
                url: "./deletenote.php",
                method: "POST",
                data: { id: deleteButton.next().attr("id") },
                success: function(data) {
                    console.log(data);
                    if (data == 'error') {
                        $("#alertContent").text("There was an Error deleting your notes");

                    } else {
                        deleteButton.parent().remove();
                    }
                },
                error: function() {
                    $("#alertContent").text("There was an Error with the Ajax call. Pls try again!");

                }
            });
        })
    }


    function showHide(array1, array2) {
        for (i = 0; i < array1.length; i++) {
            $(array1[i]).show();
        }
        for (i = 0; i < array2.length; i++) {
            $(array2[i]).hide();
        }


    };
});