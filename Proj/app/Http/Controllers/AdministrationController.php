<?php

namespace App\Http\Controllers;

use App\Models\EditProposal;
use App\Models\Report;
use App\Models\TopicProposal;

class AdministrationController extends Controller
{
    public function show() {
        $reports = Report::pending()->get();
        $edit_proposals = EditProposal::pending()->get();
        $topic_proposals = TopicProposal::pending()->get();
        
        return view("pages.administration", ['reports' => $reports,
         'edit_proposals' => $edit_proposals, 'topic_proposals' => $topic_proposals]);
    }
}

