<?php

namespace Drupal\hello\Controller;

class Hellocontroller {
	public function world(){
		
		return array(
		'#title' => 'hello world',
		'#markup' => 'this is some content .'
		
		
		);
	}
	
}