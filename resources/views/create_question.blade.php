@extends("layout")
@section("content")
<div class="row main-div">
    <h1 class="main-title">Kérdés létrehozása</h1>
    <div class="row form-container">
        <form method="post" action="{{route('insertQuestion')}}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <div class = "form-group row">
                <label class="form-label col-1" for="questionTitle">Cím</label>
                <input class="form-control col" type = "text" name = "questionTitle" placeholder="kötelező adat">
            </div>
            <div class = "form-group row">
                <label class="form-label col-1" for="questionBody">Kérdés</label>
                <textarea name="questionBody" class="form-control col" placeholder="kötelező adat"></textarea>
            </div>
            <div class="row submit-holder">
                <div class="col-3">
                    <button class="btn btn-primary" type="submit">Létrehoz</button>
                </div>
                <div class="col-2">
                    <a class="btn btn-danger" href="/">Mégse</a>
                </div>
            </div>
        </form>
    </div>
</div>