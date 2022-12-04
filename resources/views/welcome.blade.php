
@extends("layout")
@section("content")
<div class="row main-div">
<h1 class="main-title">Kérdések</h1>
<div class = "col-md-8 offset-md-2">
    @if(count($listItems) != 0)
        @foreach($listItems as $item)
            <div class = "question-div question_{{$item->id}} container">
                <div class="row">
                    <div class="col-4 title-div">
                        <h4>{{$item->question_title}}</h4>
                    </div>
                    <div class="col modify-icons">
                        <a href="{{url('updateQuestion/'.$item->id)}}"><i class="bi bi-pencil-fill" title="Módosítás"></i></a><a href=""><i id="delete_{{$item->id}}" class="bi bi-trash3-fill"></i></a>
                    </div>
                </div>
                <p>{{$item->question_body}}</p>
                <div class="row">
                    <div class="col submit-holder">
                        <form method="post" action="{{route('listAnswers')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name = "questionId" value = "{{$item->id}}">
                            <button type="submit" class = "btn btn-primary">Válaszok</button>
                        </form>
                    </div>
                    <div class="col answer-icon">
                        <i class="bi bi-chat-right-text-fill" title="Válaszok">{{$item->getAnswersNumber()}}</i>
                    </div>
                </div>
                
            </div>
        @endforeach
    @else
        <p>Jelenleg nem található egyetlen kérdés sem az adatbázisban!</p>
    @endif
</div>
<div>
    <a href="/newQuestion" class="btn btn-primary home">Kérdezek</a>
</div>

<script>
    document.querySelectorAll(".bi-trash3-fill").forEach(item => {
        item.addEventListener("click", function(){
            var id = item.id.split("_")[1];
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            jQuery.ajax({
                url: "{{ url('/deleteQuestion') }}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(result){
                    if(result.success){
                        document.querySelector(".question_"+id).remove();
                    }else{
                        console.log("rip");
                    }
                }
            });
        });
    })
</script>
</div>