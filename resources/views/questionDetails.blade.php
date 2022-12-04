@extends("layout")
@section("content")
<div class="row main-div">
<h1 class="main-title">Válaszok</h1>
<div class = "col-md-8 offset-md-2">
            <div class = "question-div container" style="border-width: 3px;">
                <div class="row">
                    <div class="col-4 title-div">
                        <h4>{{$question[0]->question_title}}</h4>
                    </div>
                </div>
                <h5>{{$question[0]->question_body}}</h5>
            </div>
            @if(count($answers) != 0)
    <br>
    <br>
        @foreach($answers as $item)
            <div class = "answer answer_{{$item->id}} container">
                <div class="row">
                    <div class="col-4 title-div">
                        <h6>{{$item->answer_body}}</h6>
                    </div>
                    <div class="col modify-icons">
                        <a href="{{url('updateAnswer/'.$item->id)}}"><i class="bi bi-pencil-fill" title="Módosítás"></i></a>
                        <a class="clickable" style="cursor: pointer;"><i id="delete_{{$item->id}}" class="bi bi-trash3-fill" title="Törlés"></i></a>
                    </div>
                </div>
                <div class="row like-holder">
                    <div class="col-10"></div>
                    <div class="col-1">
                    <button class = "likeManagement dislike"><i class="bi bi-hand-thumbs-down-fill">{{$item->dislike_count}}</i></button>
                    </div>
                    <div class="col-1"><button class="likeManagement like"><i class="bi bi-hand-thumbs-up-fill">{{$item->like_count}}</i></button></div>
                </div>
            </div>
        @endforeach
    @endif
    <br>
    <br>
    <div>
        <div><h5>Válasz küldése</h5></div>
        <div>
            <form method="post" action="{{route('createAnswer')}}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <input type="hidden" name = "questionId" value = "{{$question[0]->id}}">
                <textarea name="answerBody" class="form-control"></textarea>
                <div class="row send-holder">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Küldés</button>
                    </div>
                    <div class = "col-2">
                        <a href="/" class="btn btn-danger">Vissza</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".likeManagement").forEach(item =>{
        item.addEventListener("click", function(){
            var answerIdClass = item.closest(".answer").classList[1];
            var answerId = answerIdClass.split("_")[1];
            var type = item.classList[1];
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            jQuery.ajax({
                url: "{{ url('/likeHandle') }}",
                method: 'post',
                data: {
                    id: answerId,
                    type: type,
                },
                success: function(result){
                    if(result.success){
                        document.querySelector(".answer_"+result.id+" button."+result.type+" i").innerHTML = result.number;
                        console.log(result.number);
                        document.querySelectorAll(".answer_"+result.id+" button").forEach(item => {item.disabled = true;})
                    }else{
                        console.log("rip");
                    }
                }
            });
        });
    })

    document.querySelectorAll(".bi-trash3-fill").forEach(item => {
        item.addEventListener("click", function(){
            var id = item.id.split("_")[1];
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            jQuery.ajax({
                url: "{{route('deleteAnswer')}}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(result){
                    if(result.success){
                        document.querySelector(".answer_"+id).remove();
                    }else{
                        console.log("rip");
                    }
                }
            });
        });
    })
</script>

</div>