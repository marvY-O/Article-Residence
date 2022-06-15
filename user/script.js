$(document).ready(function(){

    $(".like").click(function(){
        var id = this.id;
        var split_id = id.split("_");

        //var text = split_id[0];
        var postid = split_id[1];

        $.ajax({
            url: 'like.php',
            type: 'post',
            data: {postid:postid},
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var liked = data['liked'];

                $("#likes_"+postid).text(likes+" Likes");

                if (liked == 1){
                    $("#like_"+postid).css("background-color","rgb(5 37 117)");
                }
                else{
                    $("#like_"+postid).css("background-color","rgb(71, 163, 255)");
                }

            }
        })

    });

    $(".cmt_btn").click(function(){
        var id=this.id;
        var split_id = id.split("_");

        //var text = split_id[0];
        var postid = split_id[1];
        var content = document.getElementById("cmt_txt"+postid);
        content = content.value;

        $.ajax({
            url: 'cmt.php',
            type: 'post',
            data: {postid:postid, content:content},
            dataType: 'json',
            success: function(data){
                var firstname = data['firstname'];
                var content = data['content'];
                var postid = data['postid'];
                var date = data['date'];
                var comments = data['comments'];

                console.log(postid);
                console.log(firstname);
                console.log(content);
                console.log(date);

                var new_cmt = document.createElement("div");
                new_cmt.className = "comment";

                var name_sec = document.createElement("div");
                name_sec.className = "name";

                var name = document.createElement("h4");
                name.innerHTML = firstname;

                var time = document.createElement("span");
                time.innerHTML = date;

                var content_c = document.createElement("p");
                content_c.innerHTML = content;

                name_sec.appendChild(name);
                name_sec.appendChild(time);

                new_cmt.appendChild(name_sec);
                new_cmt.appendChild(content_c);

                document.getElementById("comment_section"+postid).appendChild(new_cmt);

                document.getElementById("cmt_txt"+postid).value = "";

                document.getElementById("comments_"+postid).innerHTML = comments+" Comments";
            }
        });
    });

    $(".delete").click(function(){
        var postid = this.id.split("_")[1];
        if (confirm("Are you sure you want to delete this post? Click \"Ok\" for confirmation.")){
            console.log("hehe");
            $.ajax({
                url: 'del_post.php',
                type: 'post',
                data: {postid:postid},
                dataType: 'json',
                success: function(data){
                    console.log("aesssss");
                    if (data['del'] == 1){
                        document.getElementById("post"+postid).remove();
                    }
                },
                error: function(){
                    alert("There was some error deleting the post!");
                }
            })
        }
    });

});