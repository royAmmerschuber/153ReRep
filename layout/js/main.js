function newReportWin(){

}
function closeEditFrame(){
    $(".edit-frame").hide();
}
//List view
function loadListS(search,fav){

    if(search!=null){
        $("#search").val(search);
    }
    loadList(fav);
}



function loadList(fav){
    if(typeof fav!="string"){
        fav="";
    }
    var x="/WebVideoPlace/Main/loadList"+fav;
    $.ajax({
        url:"/WebVideoPlace/Main/loadList"+fav,
        type:"POST",
        data:{
            "search":$("#search").val()
        },
        success:function (result) {
            var html="";
            JSON.parse(result).forEach( function (vid) {
                html+=generateElement(vid);
            });
            if(html==""){
                html="<br>nothing found";
            }
            $("#list").html(html);
            if(fav==="Fav"){
                initFav();
                checkEmptyFav();
            }else{
                checkEmpty();
            }
        }
    });

}
function generateElement(vid){
    var html;

    html=
        "<div class=\"col-md-4\" >" +
        "<div class=\"card mb-4 box-shadow\" id='"+vid.id+"'>\n" +
        "    <img class=\"card-img-top\"\n" +
        "        data-src=\"holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail\"\n" +
        "        alt=\"Thumbnail [100%x225]\" style=\"height: 225px; width: 100%; display: block;\"\n" +
        "        src=\"/WebVideoPlace/media/thumbnail/"+vid.thumbnail+"\"\n" +
        "        data-holder-rendered=\"true\">\n" +
        "    <div class=\"card-body"+(vid.iLike==1?" iLike":"")+"\">\n" +
        "        <h1>"+vid.name+"</h1>" +
        "        <p class=\"card-text\">"+vid.description+"</p>\n" +
        "        <div class=\"d-flex justify-content-between align-items-center\">\n" +
        "            <div class=\"btn-group\">\n" +
        "                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" onclick='view("+vid.id+")'>View</button>\n" +
        (vid.isMine==true?"    <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" onclick='edit("+vid.id+")'>Edit</button>\n":"")+
        "            </div>\n" +
        "            <small class=\"text-muted\">"+vid.score+"</small>\n" +
        "        </div>\n" +
        "    </div>\n" +
        "</div>" +
        "</div>";
    return html;
}

function view(id) {
    window.location.href="/WebVideoPlace/Video?id="+id;
}
function edit(id) {
    window.location.href="/WebVideoPlace/Video/edit?id="+id;

}

//favorites
function initFav() {
    $(".card ").each(function(){
        $(this).draggable({
            cursor:"move",
            // helper:"clone"
            opacity:.5,
            revert:"invalid",
            stack:"#trash"
        });
    });
    console.log("test");
    $("#trash").droppable({
        drop:function(event,ui){
            dropFav(ui.draggable);
            console.log("removed:"+ui.draggable.attr("id"));
        },
        tolerance:"pointer"

    });
}

function dropFav(drag){
    $.ajax({
        url:"/WebVideoPlace/Main/dropFav",
        type:"POST",
        data:{
            "vid":drag.attr("id")
        }
    });
    drag.parent().remove();
    checkEmptyFav();
}

function checkEmptyFav(){
    if($("#list").html()==""){
        $("#list").html("<br>nothing found")
    }
}
function checkEmpty() {
    if($("#list").html()==""){
        $("#list").html("search returned zero videos")
    }
}

//video view
function like(isPositive,vid){
    $.ajax({
        url:"/WebVideoPlace/Video/like",
        type:"POST",
        data:{
            "isPositive":isPositive,
            "vid":vid
        },
        success:function (result) {
            var x=JSON.parse(result);
            if(x["likes"]!=null){
                $("#likes").html(x["likes"]);
                $("#dislikes").html(x["dislikes"]);
            }else{
                $("#likes").html(0);
                $("#dislikes").html(0);
            }
            var likebtn=$("#likebtnL");
            var dLikebtn=$("#likebtnD");
            if(x["myLike"]==null){
                likebtn.removeClass("iLikeBtn");
                dLikebtn.removeClass("iLikeBtn");
            }else if(x["myLike"]==true){
                likebtn.addClass("iLikeBtn");
                dLikebtn.removeClass("iLikeBtn");
            }else{
                dLikebtn.addClass("iLikeBtn");
                likebtn.removeClass("iLikeBtn");
            }
        }
    });
}

function comment(){
    $.ajax({
        url:"/WebVideoPlace/Video/comment",
        type:"POST",
        data:{
            "text":$("#commentText").val(),
            "vid":$.urlParam("id")
        },
        success:function(result){
            if (result == "test") {
                loadComments();
            } else {
                window.location.href = "/WebVideoPlace/Auth";
            }
        }
    });
}

function loadComments() {
    $.ajax({
        url:"/WebVideoPlace/Video/loadComments",
        type:"POST",
        data:{
            "vid":$.urlParam("id")
        },
        success:function (result) {
            var l=JSON.parse(result);
            var text="";
            l.forEach(function (v) {
                text+=generateComment(v);
            });
            $("#commentList").html(text);
        }
    })
}
function generateComment(comm){
    return "<div>\n" +
           "    <h4 class='"+(comm["isOwner"]==1?"err":"")+"'>"+comm["name"]+"</h4>\n" +
           "    <p>"+comm["text"]+"</p>\n" +
           "</div>"
    ;
}

//Video Edit

function saveEdit(){
    $.ajax({
        url:"/WebVideoPlace/Video/editSave",
        type:"POST",
        data:{
            "vid":parseInt($("#id").text().toString()),
            "name":$("#name").val(),
            "desc":$("#description").val()
        }
    })
}

function deleteEdit(){
    if(confirm("are you sure you want to delete this video?")){
        $.ajax({
            url:"/WebVideoPlace/Video/editDelete",
            type:"post",
            data:{
                "vid":parseInt($("#id").text().toString())
            },
            success:function (result) {
                window.location.href="/WebVideoPlace"
            }
        })
    }
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