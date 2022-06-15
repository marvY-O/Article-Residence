<?php

$query_retrieve = "SELECT * FROM post order by time desc";

$login_user_query = mysqli_query($connection,$query_retrieve);

while($row = mysqli_fetch_assoc($login_user_query)){

    $like_color = "background-color: rgb(71, 163, 255)";

    $id = $row['id'];
    $title = $row['title'];
    $likes = $row['likes'];
    $time = $row['time'];
    $content = $row['content'];
    $img = $row['img'];
    $username = $row['username'];
    $comments = $row['comments'];

    if (isset($_SESSION['user_role'])){
        $user = $_SESSION['username'];
        $query = "SELECT count(*) as cnt FROM likes WHERE username='$user' and post_id='$id'";
        $result = mysqli_query($connection, $query);
        $fetchliked = mysqli_fetch_array($result);
        $liked = $fetchliked['cnt'];

        if ($liked == 1){
            $like_color = "background-color: rgb(5 37 117)";
        }
    }

    $fullname_query= mysqli_query($connection,"SELECT full_name from users where username='$username'");
    while ($row2 = mysqli_fetch_assoc($fullname_query)){
        $full_name = $row2['full_name'];
    }

    if (isset($_SESSION['user_role'])){
        $path = "../images/$img";
    }
    else{
        $path = "images/$img";
    }

    $post1 = "<div class=\"post\" id=\"post$id\">
                <div class=\"head\">
                    <h1>$title</h1>
                </div>
                
                <img src=\"$path\" alt=\"$img\" style='height: 400px; width: 100%; border-radius: 4px;'>

                <div class=\"interact\">
                    <input type=\"button\" id=\"like_$id\" class=\"like\" value=\"Like\" style=\"$like_color\">
                    <input type=\"button\" id=\"comment_$id\" class=\"comments\" value=\"Comments +\" onclick=\"toggle(this.id)\">";
    
    if (isset($_SESSION['user_role'])){
        if ($_SESSION['username'] == $username){
            $post1 = $post1."<input type=\"button\" id = \"delete_$id\" class=\"delete\" value=\"Delete\">";
        }
    }
                
    $post1 =   $post1."</div>

                <div class=\"landc\">
                    <p id=\"likes_$id\"> $likes Likes</p> <p id=\"comments_$id\" style=\"margin-left: 5px;\">$comments Comments </p>
                </div>

                <div class=\"caption\">
                    <div class=\"head\"><h3>$full_name</h3> <span>$time</span></div>
                    <p class=\"content\">
                        $content
                    </p>
                </div>";

    $post2 = "<div class=\"comment_section\" id=\"comment_section$id\" style=\"display: none\">
    <h2>Comments</h2>";

    $comments_fetch= mysqli_query($connection,"SELECT * from comments where post_id='$id'");
    if ($comments_fetch){
        while ($row2 = mysqli_fetch_assoc($comments_fetch)){
            $user = $row2['username'];
            $cmt_content = $row2['comment'];
            $date = $row2['date'];

            $fn = mysqli_query($connection, "SELECT full_name from users where username='$user'");
            $fn = mysqli_fetch_array($fn);
            
            if ($fn){
                $firstname_cmt = $fn[0];
            }
            $cmt = "<div class=\"comment\">
                            <div class=\"name\"> <h4>$firstname_cmt</h4> <span>$date</span> </div>
                            <div class=\"cmt_del\"> 
                                <p>$cmt_content</p> <!╌ <input class=\"delete_cmt\" id=\"deletecmt_$id\" value=\"Delete\" type=\"button\">
                            </div>  
                        </div>
                    ";

            $post2 = $post2.$cmt;
        }
    }

    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user'){
        $post2 = $post2."</div>
                            <div class=\"new_comment\">
                            <input type=\"text\" id=\"cmt_txt$id\" class=\"cmt_txt\" placeholder=\"Enter a comment\">
                            <button type=\"submit\" id=\"cmtbtn_$id\" class=\"cmt_btn\">Post</button>
                            </div>";
    }
    else{
        $post2 = $post2."</div>";
    }
        
    $post3 = "</div>";

    $post = $post1.$post2.$post3;
    echo $post;

}

?>

<script>
    
    var content = document.getElementsByClassName("caption");
    for (var i=0; i<content.length; i++) { 
        var content_text = content[i].childNodes[3].innerHTML;

        content[i].childNodes[3].style.display = "None";

        var less = content_text.substring(0, 150);

        less = less.concat("...");

        var read_more = document.createElement("button");
        read_more.innerHTML = "Read More";

        read_more.onclick = function(){
            var caption_clicked = document.getElementById(this.id).parentElement;
            var more_text = caption_clicked.childNodes[3];
            var less_text = caption_clicked.childNodes[5];

                if (more_text.style.display == 'none'){
                    more_text.style.display =  "block";
                    less_text.style.display = 'none';
                    
                    caption_clicked.childNodes[6].innerHTML = 'Show Less';
                }
                else{
                    less_text.style.display =  "block";
                    more_text.style.display = 'none';
                    
                    caption_clicked.childNodes[6].innerHTML = 'Read More';
                }
            }
        read_more.className = "read_more";
        read_more.id = "rm"+i;

        var less_p = document.createElement("p");
        less_p.innerHTML = less;
        less_p.className = "content";
    
        content[i].removeChild[3];
        content[i].appendChild(less_p);
        content[i].appendChild(read_more);
    }

    function toggle(id){
        comment_section = document.getElementById("comment_section"+id.split("_")[1]);
        if (comment_section.style.display == 'none'){
            comment_section.style.display = "block";
            document.getElementById("comment_"+id.split("_")[1]).value = "Comments -";
        }
        else{
            comment_section.style.display = 'none';
            document.getElementById("comment_"+id.split("_")[1]).value = "Comments +";
        }
    }
</script>

