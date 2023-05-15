<!DOCTYPE html>
<html>
    @include('ViewSections.sectionHead')
    <body>
        <div class="container">
            <!-- navbar menu -->
            @include('ViewSections.sectionNavbar')
            <br>

            <!-- guestbook section -->
            <div class="card card-primary">
                <div class="card-header bg-primary text-light">
                    Guestbook form
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- form -->
                            <form method="post" name="form" class="fw-bold">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputText">Text</label>
                                    <textarea name="text" class="form-control" id="exampleInputText" placeholder="Enter text"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <!-- end form -->

                            @foreach($comments as $comment)
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ $comment->text }}</p>
                                        @if(isset($comment->created_at))
                                            <small class="text-muted">Posted on {{ $comment->created_at->format('F j, Y \a\t g:i a') }} by {{ $comment->name }}</small>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <br>

                            @if (!empty($infoMessage))
                                <div class="alert alert-danger" role="alert">
                                    {{ $infoMessage }}
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
