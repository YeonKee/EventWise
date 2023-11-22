@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout);

<style>
    .verifyEmail {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Success icon animation */
    .success-checkmark {
        width: 80px;
        height: 115px;
        margin: 0 auto;

        .check-icon {
            width: 80px;
            height: 80px;
            position: relative;
            border-radius: 50%;
            box-sizing: content-box;
            border: 4px solid #4CAF50;

            &::before {
                top: 3px;
                left: -2px;
                width: 30px;
                transform-origin: 100% 50%;
                border-radius: 100px 0 0 100px;
            }

            &::after {
                top: 0;
                left: 30px;
                width: 60px;
                transform-origin: 0 50%;
                border-radius: 0 100px 100px 0;
                animation: rotate-circle 4.25s ease-in;
            }

            &::before,
            &::after {
                content: '';
                height: 100px;
                position: absolute;
                background: #FFFFFF;
                transform: rotate(-45deg);
            }

            .icon-line {
                height: 5px;
                background-color: #4CAF50;
                display: block;
                border-radius: 2px;
                position: absolute;
                z-index: 10;

                &.line-tip {
                    top: 46px;
                    left: 14px;
                    width: 25px;
                    transform: rotate(45deg);
                    animation: icon-line-tip 0.75s;
                }

                &.line-long {
                    top: 38px;
                    right: 8px;
                    width: 47px;
                    transform: rotate(-45deg);
                    animation: icon-line-long 0.75s;
                }
            }

            .icon-circle {
                top: -4px;
                left: -4px;
                z-index: 10;
                width: 80px;
                height: 80px;
                border-radius: 50%;
                position: absolute;
                box-sizing: content-box;
                border: 4px solid rgba(76, 175, 80, .5);
            }

            .icon-fix {
                top: 8px;
                width: 5px;
                left: 26px;
                z-index: 1;
                height: 85px;
                position: absolute;
                transform: rotate(-45deg);
                background-color: #FFFFFF;
            }
        }
    }

    @keyframes rotate-circle {
        0% {
            transform: rotate(-45deg);
        }

        5% {
            transform: rotate(-45deg);
        }

        12% {
            transform: rotate(-405deg);
        }

        100% {
            transform: rotate(-405deg);
        }
    }

    @keyframes icon-line-tip {
        0% {
            width: 0;
            left: 1px;
            top: 19px;
        }

        54% {
            width: 0;
            left: 1px;
            top: 19px;
        }

        70% {
            width: 50px;
            left: -8px;
            top: 37px;
        }

        84% {
            width: 17px;
            left: 21px;
            top: 48px;
        }

        100% {
            width: 25px;
            left: 14px;
            top: 45px;
        }
    }

    @keyframes icon-line-long {
        0% {
            width: 0;
            right: 46px;
            top: 54px;
        }

        65% {
            width: 0;
            right: 46px;
            top: 54px;
        }

        84% {
            width: 55px;
            right: 0px;
            top: 35px;
        }

        100% {
            width: 47px;
            right: 8px;
            top: 38px;
        }
    }
</style>

@section('body')
    <section class="verifyEmail">
        <div class="card mb-4 shadow-sm verify-email-success">
            {{-- <img src="https://i.ibb.co/qjSrdf6/logo.png" width=250 height=250 style="margin-bottom: 13px"> --}}

            <h2 style="margin-bottom: 15px;font-family:'Poppins';text-align:center;">Successfully Verified!</h2>
            {{-- <img src="/img/successVerify.png" width=120 height=120 style="margin-bottom: 13px"> --}}
            <div class="success-checkmark">
                <div class="check-icon">
                    <span class="icon-line line-tip"></span>
                    <span class="icon-line line-long"></span>
                    <div class="icon-circle"></div>
                    <div class="icon-fix"></div>
                </div>
            </div>
            <p style="padding: 0 50px; margin-bottom: 25px;text-align:center;">You had successfully verified your email!</p>
            <p style="padding: 0 50px; margin-bottom: 15px;text-align:center;">Click the button below to go login page.</p>
            <a href="/students/loginPage" style="margin-bottom: 5px;" class="form-submit btn btn-primary">Continue</a>
        </div>
    </section>
@endsection
