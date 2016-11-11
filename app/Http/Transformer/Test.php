<?php
 
namespace App\Transformer;
 
class Test {
 
    public function transform($tasks) {
		foreach($tasks as $task){
			$res[]=array(
			'id' => $task->id,
            'categoryname' => $task->categoryname
            );
		}
        return $res;
    }
 
}