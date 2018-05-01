function checkLogin() {
    var valid=true;
    if($("#inputName").val()==""||
        $("#inputPassword").val()==""){
        valid=false;
        $("#eName").text("please fill out the entire form")
    }

    if(valid){
        $.ajax({
            url: "/153ReRep/Auth/loginCheck",
            type: "POST",
            data: {
                "name": $("#inputName").val(),
                "password": $("#inputPassword").val()
            },
            success: function (result) {
                console.log(result);
                var input=JSON.parse(result);
                $("#eName").text(input["eName"]);
                $("#ePassword").text(input["ePassword"]);
                if(input["success"]){
                    window.location.replace("/153ReRep/Main/index")
                }
            }
        });
    }
}
function checkRegister() {
    var valid = true;
    if($("#inputName").val()==""||
        $("#inputPassword1").val()==""||
        $("#inputPassword2").val()==""){
        $("#eName").text("please enter all the values");
        valid=false;
    }
    if($("#inputPassword1").val()!=$("#inputPassword2").val()){
        $("#ePassword2").text("the Passwords do not match");
        valid=false;
    }
    if (valid) {
        $.ajax({
            url: "/153ReRep/Auth/registerCheck",
            type: "POST",
            datatype:"JSON",
            data: {
                "name": $("#inputName").val(),
                "role": $("#inputRole").val(),
                "password1": $("#inputPassword1").val(),
                "password2": $("#inputPassword2").val()
            },
            success: function (result) {
                console.log(result);
                var input = JSON.parse(result);
                    $("#eName").text(input["eName"]);
                    $("#ePassword1").text(input["ePwd"]);
                if(input["success"]){
                    alert("user created successfully")
                }
            }
        });
    }
}

function editUser(){
    var valid = true;
    if($("#name").val()==""||
        $("#email").val()==""||
        $("#oPass").val()==""){
        $("#eName").text("please enter the old password a name and an email address");
        valid=false;
    }
    if(valid){
        $.ajax({
            url:"/153ReRep/Auth/editAct",
            type:"POST",
            data:{
                "name":$("#name").val(),
                "email":$("#email").val(),
                "oPass":$("#oPass").val(),
                "nPass":$("#nPass").val()
            },
            success:function(result){
                $("#eName").text(result);

            }
        })
    }
}