<div class="modal fade" id="addShift" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="/employees/add-shift/{{ $employee->employee_id }}" method="POST">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add new shift</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Shifts</label>
                        <select class="form-control" name="shift">
                            @foreach(App\Shift::orderBy('shift_from')->get() as $shift)
                            <option value="{{ $shift->id }}">{{ $shift->description.' - '.$shift->shift_from.' to '.$shift->shift_to }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Effectivity Date</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="dateFrom" name="date_from" class="form-control" placeholder="Date started"/>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="dateTo" name="date_to" class="form-control" placeholder="Date ended"/>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Days</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="days[]" value="mon">Monday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="days[]" value="tue">Tuesday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="days[]" value="wed">Wednesday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="days[]" value="thu">Thursday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="days[]" value="fri">Friday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="days[]" value="sat">Saturday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="days[]" value="sun">Sunday
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>