<?php

require_once __DIR__ . '/../app/models/Vote.php';

class VoteController {

    private $vote;

    public function __construct($db){
        $this->vote = new Vote($db);
    }

    public function vote($user_id, $submission_id){

        if($this->vote->checkUserVote($user_id, $submission_id) > 0){

            echo "You already voted";
            return;
        }

        if($this->vote->addVote($user_id, $submission_id)){
            echo "Vote added successfully";
        } else {
            echo "Error voting";
        }
    }

}