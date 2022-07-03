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
        title: 'Attenzione!',
        content: 'Stai cancellando questo documento. Confermi?',
        buttons: {
            somethingElse: {
                text: 'Confermo',
                btnClass: 'btn-red',
                action: function(){
                    window.location.href = document.getElementById('delete_note').href;
                }
            },
            cancelButton: {text: 'Annulla'},            
            
        },
        
    });
}

function confirm_logout(){
    $.confirm({
        title: 'Attenzione!',
        content: 'Sei sicuro di voler effettuare il logout?',
        buttons: {
            somethingElse: {
                text: 'Confermo',
                btnClass: 'btn-red',
                action: function(){
                    document.getElementById('logout-form').submit();
                }
            },
            cancelButton: {text: 'Annulla'},            
        },
        
    });
}

function confirm_go_back(){
    $.confirm({
        title: 'Attenzione!',
        content: 'Se torni indietro perderai tutti i dati appena inseriti. Confermi?',
        buttons: {
            somethingElse: {
                text: 'Confermo',
                btnClass: 'btn-red',
                action: function(){
                    window.location.href = document.getElementById('go_back').href;
                }
            },
            cancelButton: {text: 'Annulla'},            
            
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

