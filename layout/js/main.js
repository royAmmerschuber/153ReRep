function newCustomerWin(frame){
    openWindow(frame,"/153ReRep/Report/newCustomer","Customer",saveCustomer)
}
function saveCustomer(frame){
    console.log(frame);
    var f=$("#"+frame);
    $.ajax({
        url:"/153ReRep/Report/newCustomerCheck",
        type:"POST",
        data:{
            "name":f.find("#txtName").val()
        },
        success:function (result) {
            result=JSON.parse(result);
            if(result["success"]){
                loaddata("customer");
                closeEditFrame(frame);
            }

        }
    });
}

function newReportWin(frame){
    openWindow(frame,"/153ReRep/Report/new","Report",saveReport);
}
function saveReport(frame){
    console.log(frame);
}

function loaddata(area){
    $.ajax({
        url:"/153ReRep/Report/loadData",
        type:"POST",
        data:{
            "area":area
        },
        success:function (result) {
            result=JSON.parse(result);
            switch(area){
                case "customer":{
                    var options = "";
                    for(var k in result){
                        options+="<option value='"+k+"'>"+result[k]+"</option>";
                    }
                    $(".select-customer").html(options);

                }break;
            }
        }
    });
}

function openWindow(frameId, path,title,finish){
    $.ajax({
        url:path,
        type:"POST",
        success:function (result) {
            var f=$("#"+frameId);
            f.parent().show();
            f.find("#title").text(title);
            f.find(".content-frame").html(result);
            var save=f.find("#btnSave");
            save.click(function(){finish(frameId)});
            loaddata("customer");
        }
    });
}
function closeEditFrame(frame){
    $("#"+frame).parent().hide();
}



//other

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
        return null;
    }
    else{
        return decodeURI(results[1]) || 0;
    }
}