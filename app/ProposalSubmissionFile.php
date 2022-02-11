<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ProposalSubmissionFile extends Model
{
    protected $table = 'proposal_submissions_files';

    protected $fillable = ['proposal_submission_id','file_name','file_id','file_size'];

    public function getFileIdAttribute($value){
        return $value ? asset(Storage::url('attachments/'.$value)) : "";
    }
}
