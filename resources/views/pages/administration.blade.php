@extends('layouts.layout')

@section('title', 'Administration')

@section('content')
    <div class="container">
        <h2 class="page-title">Administration</h2>
        <div class="accordion mt-4" id="accordionAdmin">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTopic">
                    <button class="accordion-button fs-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTopic" aria-expanded="true" aria-controls="collapseTopic">
                        Topic Proposals
                    </button>
                </h2>
                <div id="collapseTopic" class="accordion-collapse collapse show" aria-labelledby="headingTopic"
                    data-bs-parent="#accordionAdmin">
                    <div class="accordion-body d-flex bg-dark flex-wrap justify-content-center">
                        @foreach ($topic_proposals as $topic_proposal)
                            @include('partials.administration.topic_proposal', ['user' => $topic_proposal->user])
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingUser">
                    <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                        User Reports
                    </button>
                </h2>
                <div id="collapseUser" class="accordion-collapse collapse" aria-labelledby="headingUser"
                    data-bs-parent="#accordionAdmin">
                    <div class="accordion-body d-flex bg-dark flex-wrap justify-content-center">
                        @foreach ($reports as $report)
                            @include('partials.administration.user_reports')
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEdit">
                    <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEdit" aria-expanded="false" aria-controls="collapseEdit">
                        Edit Proposal
                    </button>
                </h2>
                <div id="collapseEdit" class="accordion-collapse collapse" aria-labelledby="headingEdit"
                    data-bs-parent="#accordionAdmin">
                    <div class="accordion-body d-flex bg-dark flex-wrap justify-content-center">
                        @foreach ($edit_proposals as $edit_proposal)
                            @include('partials.administration.edit_proposal')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
