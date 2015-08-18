<div class="modal fade" id="viewShift" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Emplooyee Shift</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Shift description</th>
                            <th>Time</th>
                            <th>Working hours</th>
                            <th>Effective</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employee->employee_shifts()->orderBy('date_from', 'desc')->get() as $employee_shift)
                        <tr>
                        <td><a href="/shifts/{{ $employee_shift->shift->id }}">{{ $employee_shift->shift->description }}</a></td>
                        <td>{{ $employee_shift->shift->shift_from.' to '.$employee_shift->shift->shift_to }}</td>
                        <td>{{ $employee_shift->shift->working_hours }}</td>
                        <td>{{ date('M d Y', strtotime($employee_shift->date_from)).' to '.date('M d Y', strtotime($employee_shift->date_to)) }}</td>
                        </tr>
                        @empty
                        <tr>
                        <td colspan="11"><div class="alert alert-success">No shift yet.</div></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>