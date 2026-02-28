<?php

require_once __DIR__ . '/../app/models/vote.php';

class VoteController {

    private $vote;

    public function __construct($db){
        $this->vote = new Vote($db);
    }

    public function vote($id_user, $id_sub){

        // check if user already voted
        if($this->vote->checkUserVote($id_user, $id_sub) > 0){
            echo "You already voted";
            return;
        }

        // add vote
        if($this->vote->addVote($id_user, $id_sub)){
            echo "Vote added successfully";
        } else {
            echo "Error voting";
        }
    }

}