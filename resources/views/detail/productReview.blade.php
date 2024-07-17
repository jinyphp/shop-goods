<div>

    @foreach($rows as $row)
        {{-- {{dd($row)}} --}}
        <div style="text-align: left; padding-left: 20px; border-bottom: 1px solid grey;">
            <h4 style="display : inline"> {{$row['title']}} </h4>
            <img src="https://cdn-icons-png.flaticon.com/512/6326/6326226.png" width="20px" height="20px" wire:click="increaseLike()">
            {{$likeCount}}
            <p>생성일자 : {{$row['created_at']}}<br> <strong>별점</strong> : {{$row['rating']}}</p>
            <p>{{$row['comment']}}</p>
        </div>
    @endforeach
</div>
