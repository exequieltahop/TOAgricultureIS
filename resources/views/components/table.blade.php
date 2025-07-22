<div {{$attributes->merge(['class' => 'table-responsive'])}}>
    <table class="table {{$tableClass}}" id="{{$tableId}}">
        <thead class="text-nowrap">
            @foreach ($ths as $th)
                <th>{{$th}}</th>
            @endforeach
        </thead>
        <tbody>
            {{$slot}}
        </tbody>
    </table>
</div>