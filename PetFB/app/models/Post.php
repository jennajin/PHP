<?php

class Post {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    /* ============================================= Get all posts =================================== */

    public function getPosts(){
        $this->db->query('SELECT *,
                        posts.postId as postId,
                        users.userId as userId,
                        posts.createdAt as postCreated,
                        users.createdAt as userCreated
                        FROM posts
                        INNER JOIN users
                        ON posts.userId = users.userId
                        ORDER BY posts.createdAt DESC
                        ');

        $results = $this->db->resultSet();

        return $results;
    }

    /* ============================================= Add a post =================================== */
    public function addPost($data){

        $this->db->query('INSERT INTO posts (title,userId,picture,body) VALUES(:title,:userid,:picture,:body)');

        $this->db->bind(':title',$data['title']);
        $this->db->bind(':userid',$data['userid']);
        $this->db->bind(':picture',$data['picture']);
        $this->db->bind(':body',$data['body']);

        // for INSERT,UPDATE,DELETE USE execute
        // check if everything is ok return true.Otherwise, return false
        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Update a post =================================== */

    public function updatePost($data){

        $this->db->query('UPDATE posts SET title = :title, picture=:picture, body = :body WHERE postId = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':picture',$data['picture']);
        $this->db->bind(':body', $data['body']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Delete a post =================================== */

    public function deletePost($id){

//         delete the post picture

        $this->db->query('SELECT * FROM posts WHERE postId = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        $target_path = getcwd(). DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'user' . $_SESSION['user_id']
            .DIRECTORY_SEPARATOR.'posts'. DIRECTORY_SEPARATOR;

        if(is_dir($target_path)){

            unlink($target_path. $row->picture);
        }

        $this->db->query('DELETE FROM posts WHERE postId = :id');

        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    /* ============================================= Retrieve a specific post =================================== */

    public function getPostById($id){

        $this->db->query('SELECT * FROM posts WHERE postId = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}