@extends('v1.master.master_app')

@section('content')

@include('v1/views/faculty/evaluation_summary/content_header')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      @include('v1/components/errors/flash_message')
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">My Evaluation Summary | Semester: {{$sem->name}} | Students evaluated you: {{$totalStudentsEvaluated}}</h3>
        </div>
        <div class="card-body">

            @forelse($evaluationSummary as $index => $evaluationSummary1)
                <h4>Topic: {{$evaluationSummary1->name}}</h4>
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Rating</th>
                    <th>Score/Total Points</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($evaluationSummary1->choices as $choice)
                    <tr>
                        <td>{{$choice->name}}</td>
                        <td>{{$choice->total}}</td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
                <br>

            @empty
                <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>No evaluation results available. <br>
                        What went wrong?
                        <li>
                            <i>It's either the evaluation module is locked, or none of you students evaluated you.</i>
                        </li>
                    </strong>
                </div>
            @endforelse
        </div>
      </div>
    </div>
  </div>
</section>

@stop
