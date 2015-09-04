<form role="form" action="/holidays/{{ $holiday->id }}" method="POST" enctype="multipart/form-data">
    {!! method_field('PUT') !!}
    {!! csrf_field() !!}
    <div class="form-group">
        <label>Title</label>
        <input class="form-control" name="title" placeholder="ex. Christmas day" value="{{ $holiday->title }}">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" name="description" placeholder="ex. Birth of Jesus Christ">{{ $holiday->description }}</textarea>
    </div>
    <div class="form-group">
        <label>Date from</label>
        <input type="text" class="form-control" id="" name="start" placeholder="Date from" value="{{ $holiday->start }}"/>
    </div>
    <div class="form-group">
        <label>Date to</label>
        <input type="text" class="form-control" id="" name="end" placeholder="Date to" value="{{ $holiday->end }}"/>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary"><i class="fa fa-calendar"></i> Update holiday</button>
    <a onclick="deleteHoliday({{ $holiday->id }})" class="btn btn-danger"><i class="fa fa-remove"></i> Delete holiday</a>
</form>