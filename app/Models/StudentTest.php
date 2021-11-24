<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTest extends Model
{
    protected $table = 'student_test_table';
    protected $casts = [
        'tests_passed' => 'array'
    ];

    function addTest($test){
        if($this->tests_passed == null){
            $this->tests_passed =  [$test];
        } else {
            if(!in_array($test, $this->tests_passed)){
                $this->tests_passed = array_merge($this->tests_passed, [$test]);
            }
        }
    }
}
