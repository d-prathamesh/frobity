<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class JobSubmissionFile extends Model
{
    protected $table = 'job_submissions_files';

    protected $fillable = ['job_submission_id','file_name','file_id','file_size'];

    public function getFileIdAttribute($value){
        return $value ? asset(Storage::url('attachments/'.$value)) : "";
    }
}
