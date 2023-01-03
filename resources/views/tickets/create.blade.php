@extends('layout.app')

@section('title', 'Open Ticket')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Open New Ticket</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST">
                        { !! csrf_field() !! }

                        <div class="form-group{{ $errors->has('title') ? ' has-error ' : '' }} ">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                                @if ($errors-has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category') ? ' has-error ' : '' }}">
                            <label for="category" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <select name="category" id="category" type="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('priority') ? ' has-error ' : '' }}">
                            <label for="priority" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <select name="priority" id="priority" type="" class="form-control">
                                    <option value="">Select Priority</option>
                                    <option value="">Low</option>
                                    <option value="">Medium</option>
                                    <option value="">High</option>
                                </select>
                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('message') ? ' has-error ' : '' }}">
                            <label for="message" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <textarea name="message" id="message" rows="10" class="form-control"></textarea>
                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-btn fa-ticket"></i>Open Ticket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection