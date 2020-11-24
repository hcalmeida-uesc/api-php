<?php

class API{
    private $users;
    private $jsonFile;
    private $bodyJson;

    public function __construct(){
        $this->jsonFile = 'users.json';
        $this->users = json_decode(file_get_contents($this->jsonFile), true);
        $this->bodyJson = json_decode(file_get_contents('php://input'), true);
    }

    public static function hello(){
        echo '<h1>Hello World! Agora na Class</h1>';
    }

    public function getUsers(){
        echo json_encode($this->users);
    }

    public function postUser(){
        $this->bodyJson['id'] = time();
        $this->users[] = $this->bodyJson;
        
        header("HTTP/1.0 201");

        echo json_encode($this->bodyJson);
        file_put_contents($this->jsonFile, json_encode($this->users));
    }

    public function getUser($id){
        $i = $this->getUserIndex($id);
        if($i != -1){
            echo json_encode($this->users[$i]);
        }
        else{
            header("HTTP/1.0 404");
        }
    }

    public function updateUser($id = false){
        if($id == false || $this->bodyJson == ""){
            header("HTTP/1.0 204");
            exit;
        }
        $i = $this->getUserIndex($id);
        if($i != -1){
            $this->bodyJson['id'] = $id;
            $this->users[$i] = $this->bodyJson;
            echo json_encode($this->bodyJson);
            file_put_contents($this->jsonFile, json_encode($this->users));
        }
        else{
            header("HTTP/1.0 404");
        }
    }

    public function deleteUser($id = false){
        if($id == false){
            header("HTTP/1.0 204");
            exit;
        }
        $i = $this->getUserIndex($id);
        if($i != -1){
            echo json_encode($this->users[$i]);
            unset($this->users[$i]);
            file_put_contents($this->jsonFile, json_encode($this->users));
        }
        else{
            header("HTTP/1.0 404");
        }
    }

    public function getUserIndex($id){
        $found = -1;
        foreach($this->users as $k => $u){
            if($u['id'] == $id){
                $found = $k;
                break;
            }
        }
        return $found;
    }
}