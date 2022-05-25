function checkNote(button){
    

    title = $("#title");
    title_msg = $("#invalid-title");

    department = $("#department");
    department_msg = $("#invalid-department");

    faculty = $("#faculty");
    faculty_msg = $("#invalid-faculty");

    course = $("#course");
    course_msg = $("#invalid-course");

    professor = $("#professor");
    professor_msg = $("#invalid-professor");

    pages = $("#pages");
    pages_msg = $("#invalid-pages");

    var regularExpressionPages = new RegExp("^[0-9]*$");

    if(title.val().trim() === "")
    {
        title_msg.html("The title field must not be empty");
        course_msg.html("");
        department_msg.html("");
        faculty_msg.html("");
        professor_msg.html("");
        pages_msg.html("");
        title.focus();
    }else if(department.val().trim() === "")
    {
        department_msg.html("The department field must not be empty");
        faculty_msg.html("");
        title_msg.html("");
        professor_msg.html("");
        pages_msg.html("");
        department.focus();
    }else if(faculty.val().trim() === "")
    {
        faculty_msg.html("The faculty field must not be empty");
        title_msg.html("");
        department_msg.html("");
        professor_msg.html("");
        pages_msg.html("");
        faculty.focus();
    }else if(course.val().trim() === "")
    {
        course_msg.html("The course field must not be empty");
        title_msg.html("");
        department_msg.html("");
        faculty_msg.html("");
        professor_msg.html("");
        pages_msg.html("");
        course.focus();
    }else if(professor.val().trim() === "")
    {
        professor_msg.html("The professor field must not be empty");
        title_msg.html("");
        department_msg.html("");
        faculty_msg.html("");
        course_msg.html("");
        pages_msg.html("");
        professor.focus();
    }else if(pages.val().trim() === "")
    {
        pages_msg.html("The pages field must not be empty");
        title_msg.html("");
        department_msg.html("");
        faculty_msg.html("");
        course_msg.html("");
        professor_msg.html("");
        pages.focus();
    }else if(!pages.val().trim().match(regularExpressionPages))
    {
        pages_msg.html("The pages field must contain only numbers");
        title_msg.html("");
        department_msg.html("");
        faculty_msg.html("");
        course_msg.html("");
        professor_msg.html("");
        pages.focus();
    }else{
        $('form[name=note]').submit();
    }
}

function confirm_note_deletion(){
    $.confirm({
        title: 'Attention!',
        content: 'You are deleting this note. Are you sure?',
        buttons: {
            somethingElse: {
                text: 'Confirm',
                btnClass: 'btn-red',
                action: function(){
                    window.location.href = document.getElementById('delete_note').href;
                }
            },
            cancel: function () {},
            
        },
        
    });
}

function filter_faculties(){
    department_id = $('#department').val();
    console.log(department_id);

    $.ajax({
        url: '/faculties/filter',
        type: 'GET',
        data: {
            department: department_id
        },
        success: function(data){
            if(data.done){
                console.log(data.faculties[0].name);
                $('#faculty').empty();
                $('#faculty').append($('<option>', {
                    value: "",
                    text: "Faculty"
                }));
                $.each(data.faculties, function(i, item) {
                    $('#faculty').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });
            }
            else{
                console.log('error')
            }
        }
    });
}

function get_faculties(){
    $(document).ready(function(){
        alert('ciao come va');
        $.ajax({
                url: '/get/faculties',
                type: 'GET',
                data: {},
                success: function(data){
                    if(data.done){
                        console.log(data.faculties[0].name);
                        $('#faculty').empty();
                        $('#faculty').append($('<option>', {
                            value: "",
                            text: "Faculty"
                        }));
                        $.each(data.faculties, function(i, item) {
                            $('#faculty').append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                    }
                    else{
                        console.log('error')
                    }
                }
            });
    });
}

