@extends("layout")
@section("content")
<div class="row main-div">
    <h1 class="main-title">Válasz módosítása</h1>
    <div class="row form-container">
    <div class = "question-div container" style="border-width: 3px;">
                <div class="row">
                    <div class="col-4 title-div">
                        <h4>{{$question->question_title}}</h4>
                    </div>
                </div>
                <h5>{{$question->question_body}}</h5>
            </div>
        <form method="get" action="{{url('updateAnswer/'.$answer->id)}}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <div class = "form-group row">
                <textarea name="body" id="body" class="form-control col" placeholder="kötelező adat">{{$answer->answer_body}}</textarea>
            </div>
            <div class="row submit-holder">
                <div class="col-3">
                    <button class="btn btn-primary" type="submit">Módosít</button>
                </div>
                <div class="col-2">
                    <a class="btn btn-danger" href="/">Mégse</a>
                </div>
            </div>
        </form>
    </div>
</div>