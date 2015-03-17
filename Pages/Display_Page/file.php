<?php

/**
 * This is a File class
 * each class contains the info of a file:
 * 1. file_name
 * 2. file_active
 * 3. file_is_folder
 * 4. file_id
 * 5. 
 */

class File {

	public $file_name; //string
	public $file_active; //bool
	public $file_is_folder; //bool
	public $file_id; //int

	public function __construct($fn, $fif, $fid){

		$this->file_name = $fn;
		$this->file_active = FALSE;
		$this->file_is_folder = $fif;
		$this->file_id = $fid;

	}

}

?>