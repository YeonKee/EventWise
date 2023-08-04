@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Live Chat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Live Chat</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Chat Name</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Chats</h5>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <script>
        $(document).ready(function() {
            $('#livechatNav').removeClass('collapsed');
        });
    </script>
@endsection
