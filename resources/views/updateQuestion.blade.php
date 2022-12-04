@extends("layout")
@section("content")
<div class="row main-div">
    <h1 class="main-title">Kérdés módosítása</h1>
    <div class="row form-container">
        <form method="get" action="{{url('updateQuestion/'.$question->id)}}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <div class = "form-group row">
                <label class="form-label col-1" for="title">Cím</label>
                <input class="form-control col" id="title" type = "text" name = "title" placeholder="kötelező adat" value="{{$question->question_title}}">
            </div>
            <div class = "form-group row">
                <label class="form-label col-1" for="body">Kérdés</label>
                <textarea name="body" id="body" class="form-control col" placeholder="kötelező adat">{{$question->question_body}}</textarea>
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