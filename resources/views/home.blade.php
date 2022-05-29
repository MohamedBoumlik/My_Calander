@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <br />
            <h1 class="text-center text-danger"><u>My Calendar</u></h1>
            <br />
            <form action="{{ url('event/store') }}" method='POST'>
                @csrf
                <div class="row">
                    <input type="hidden" id="event_id" name="event_id">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Event Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter the name"
                                required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Event Color</label>
                            <select name="color" id="color" class="form-control" required>
                                <option value="">Choose</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                <option style="color:#008000;" value="#008000">&#9724; Green</option>
                                <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                <option style="color:#000;" value="#000">&#9724; Black</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea name="event_description" id="event_description" class="form-control" placeholder="Event Description"
                                required></textarea>
                        </div>
                    </div>
                    <button id="action">Add Event</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        hayaad
                    </button>
                </div>
            </form>
            <div id="calendar"></div>

            <!-- Confirm Delete Modal -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ url('event/delete/') }}" method="Post">
                            @csrf
                            <input type="text" id="event_id_delete" name="event_id">
                            <button class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('start_date').valueAsDate = new Date();
        // $('#staticBackdrop').modal('show');

        $(document).ready(function() {

            var ev = @json($events);
            var calendar = $('#calendar').fullCalendar({
                eventClick: (event) => {
                    $('#start_date').val(event.start.format('YYYY-MM-DD'));
                    $('#end_date').val(event.end.format('YYYY-MM-DD'));
                    $('#name').val(event.title);
                    $('#event_description').val(event.description);
                    $('#color').val(event.color);
                    $('#event_id').val(event.id);
                    $('#event_id_delete').val(event.id);
                },

                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: ev,
                selectable: true,
                selectHelper: true,
            });

        });
    </script>
@endsection
