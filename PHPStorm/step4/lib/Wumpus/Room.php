<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 1/27/2019
 * Time: 10:04 PM
 */

namespace Wumpus;


class Room
{
    /**
     * Constructor
     *
     * Every room has an index into the array in the Wumpus class.
     * These are values starting at 1. They also have an assigned
     * room number, which is what the user sees.
     *
     * @param int $ndx Index into the array of rooms
     * @param int $num The assigned room number
     */
    public function __construct($ndx, $num) {
        $this->ndx = $ndx;
        $this->num = $num;
    }
    /**
     * Get the index into the wumpus cave array of rooms
     * @return int Index value starting at 1
     */
    public function getNdx() {
        return $this->ndx;
    }

    /**
     * The assigned room number
     * @return int Room number
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Add a neighboring room
     * @param Room $room The neighboring room to add
     */
    public function addNeighbor(Room $room) {
        $this->neighbors[] = $room;
    }

    /**
     * Get a room's neighbors
     * @return array An array of room neighbors
     */
    public function getNeighbors() {
        return $this->neighbors;
    }

    /**
     * Add content to this room
     * @param int $c Content (integer constant)
     */
    public function addContent($c) {
        $this->contents[]=$c;
    }

    /**
     * Is this room empty (no contents)?
     * @return true if empty
     */
    public function isEmpty() {
        if(count($this->contents) > 0){
            return false;
        }
        else{
            return true;
        }
    }

    /**
     * Test to see if a room contains an item
     * @param int $item Item we are testing (integer constant)
     * @param int $recurse How many levels away we test
     * @return true if room or neighbors contain the item
     */
    public function contains($item, $recurse=0) {
        if(in_array($item , $this->contents)){
            return true;
        }

        if ($recurse > 0){
            $recurse = $recurse - 1;
            foreach($this->neighbors as $neighbor) {
                if($neighbor->contains($item, $recurse)) {
                    return true;
                }
            }
        }
        return false;

    }
    private $ndx;       // The room index in the Wumpus game
    private $num;       // The assigned room number
    private $neighbors = [];   // Neighbors of this room
    private $contents = [];    // Contents of a room
}