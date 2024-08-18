@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
    @include('vendor.sweetalert')
    <div class="container mt-5 mb-5 d-flex justify-content-center align-items-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card" data-aos="fade-up" data-aos-duration="1500">
                <div class="card-header  text-white">
                    <h1 class="text-center">Edit Event</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-1">
                            <div class="col-md-12" data-aos="fade-right" data-aos-duration="1200">
                                <div class="form-group">
                                    <input type="text" id="title" name="title" class="form-control form-control-lg"
                                        value="{{ old('title', $event->title) }}" placeholder="Event Title" required>
                                    @error('title')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12" data-aos="fade-left" data-aos-duration="1200">
                                <div class="form-group">
                                    <input type="text" id="location" name="location"
                                        class="form-control form-control-lg" value="{{ old('location', $event->location) }}"
                                        placeholder="Event Location" required>
                                    @error('location')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
                                <div class="form-floating">
                                    <input type="date" id="event_date" name="event_date"
                                        class="form-control form-control-lg" value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d')) }}"
                                        placeholder="Event Date" required>
                                    <label for="event_date">Event Date</label>
                                    @error('event_date')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
                                <div class="form-group">
                                    <input type="number" id="quota" name="quota" class="form-control"
                                        value="{{ old('quota', $event->quota) }}" placeholder="Participant Quota" required>
                                    @error('quota')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
                                <div class="form-floating">
                                    <input type="time" id="event_time" name="event_time" class="form-control"
                                        value="{{ old('event_time', \Carbon\Carbon::parse($event->event_time)->format('H:i')) }}" placeholder="Event Time" required>
                                    <label for="event_time">Event Start Time</label>
                                    @error('event_time')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-left" data-aos-duration="1200">
                                <div class="form-floating">
                                    <input type="time" id="event_end_time" name="event_end_time" class="form-control"
                                        value="{{ old('event_end_time', \Carbon\Carbon::parse($event->event_end_time)->format('H:i')) }}" placeholder="Event End Time" required>
                                    <label for="event_end_time">Event End Time</label>
                                    @error('event_end_time')
                                        <div class="alert alert-danger mt-1 p-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3" data-aos="fade-up" data-aos-duration="1200">
                            <div class="input-group">
                                <label class="input-group-text bg-secondary text-white" for="image">Image Upload</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <p class="mt-2">Current Image: <img src="{{ asset('storage/images/events/' . $event->image) }}" alt="Event Image" style="width: 100px;"></p>
                            @error('image')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3" data-aos="fade-up" data-aos-duration="1200">
                            <textarea id="description" name="description" class="form-control tinymce-editor" placeholder="Event Description"
                                style="height: 150px;" required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success btn-lg btn-block w-100" data-aos="fade-up"
                                data-aos-duration="1400">Update Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/3dmrntbli8t1zzxix2pwy7thuxdamzxr1t3g3rguqamz6sqq/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            forced_root_block: false, // This prevents TinyMCE from adding <p> tags around blocks
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave(); // Ensure the textarea is updated
                });
            }
        });
    </script>
@endsection
