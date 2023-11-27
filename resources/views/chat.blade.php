@extends('layoutFrontChat')
@section('body')
    <div class="chat">
        <!-- Header -->
        <div class="top">
            <img src="/img/staffProfile.png" alt="Avatar" height="80" width="80">
            <div>
                <p>EventWise Staffs</p>
                @if (session('studID') != null)
                    <small>Always on coffee break :)</small>
                @else
                    <small style="color: red !important;">Don't refresh your page or we might not be able to reach you
                        again!!</small>
                @endif

            </div>
        </div>
        <!-- End Header -->

        <!-- Chat -->
        <div class="messages">
            @include('receive', ['message' => 'Hey there! We are currently on break!'])
            @include('receive', [
                'message' => 'Please leave a message and we will get back to you as soon as possible!',
            ])
            <!-- Display staff-specific messages -->
            @foreach ($messages as $message)
                @if ($message->sender_type === 'student')
                    @include('broadcast', ['message' => $message->message])
                @else
                    @include('receive', ['message' => $message->message])
                @endif
            @endforeach
        </div>
        <!-- End Chat -->

        <!-- Footer -->
        <div class="bottom">
            <form class="chat-form">
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit">
                    <i class="fas fa-paper-plane"></i>
                </button>
                <button type="button" id="click_to_record">
                    <i class="fas fa-microphone"></i>
                </button>
            </form>
        </div>
        <!-- End Footer -->

    </div>
    </body>
@endsection
