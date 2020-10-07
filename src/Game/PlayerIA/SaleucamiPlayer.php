<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class SaleucamiPlayers
 * @package Hackathon\PlayerIA
 * @author DYLAN MEETUN
 * My strategy is to counter the opponent's previous move and change strategy every third round if I am losing to my opponent
 */
class SaleucamiPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    function counter ($opponentChoice) {
        if ($opponentChoice == parent::rockChoice())
            $choice = parent::paperChoice();
        else if ($opponentChoice == parent::paperChoice())
            $choice = parent::scissorsChoice();
        else if ($opponentChoice == parent::scissorsChoice())
            $choice = parent::rockChoice();
        return $choice;
    }

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        $strategy = 0;
        $choice = parent::scissorsChoice();
        $prevOpponent = $this->result->getLastChoiceFor($this->opponentSide);
        if ($this->result->getNbRound() % 3 != 0) {
            if ($this->result->getLastScoreFor($this->mySide) < $this->result->getLastScoreFor($this->opponentSide)) {
                $strategy++;
            }
        }
        if ($strategy % 2 == 0)
            return $this->counter($prevOpponent);
        else
            return $this->counter($this->counter($this->counter($prevOpponent)));

    }
};
