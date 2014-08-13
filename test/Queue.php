<?php

namespace test;

class Queue {
	private $queue = array();

	public function enqueue($item){
		$this->queue[] = $item;
	}

	public function dequeue(){
		return array_shift($this->queue);
	}

	public function is_empty(){
		return empty($this->queue);
	}

	public function to_string(){
		return implode(" ",$this->queue);
	}
}