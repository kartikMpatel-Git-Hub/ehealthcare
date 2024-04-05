<?php
    $query = "select * from doctor where doc_id = '$id'";
    $result= $database->query($query);
    if($result->num_rows)
    {
        for ($x=0; $x<$result->num_rows;$x++)
        {
            $row=$result->fetch_assoc();
            $aid = $row['article_id'];
        }
    }

    $query = "select * from comment where article_id = '$aid'";
    $result1= $database->query($query);	
    $cmt=$result1->num_rows;

    $query= $database->query("select * from doctor  where doc_id='$docid'");
    $ans= $query->fetch_assoc();
    $doc_name=$ans["doc_name"];
?>