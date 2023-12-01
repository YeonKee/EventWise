@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Rating</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/chats/appointment/viewAppointment">Automated Chat</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/chats/rating/viewRating">Rating</a></li>
                    <li class="breadcrumb-item active">Average Score</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="d-flex align-items-center" method="GET" action="/staffs/chats/rating/ratingScoreMonthly"
                    id="ratingForm">
                    @csrf
                    <select class="form-select" name="year" id="year">
                        <?php
                        $currentYear = date('Y');
                        $selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;
                        
                        for ($i = 0; $i < 5; $i++) {
                            $year = $currentYear - $i;
                            $selected = $year == $selectedYear ? 'selected' : ''; // Check if it's the current year
                            echo "<option value='$year' $selected>$year</option>";
                        }
                        ?>
                    </select>

                    <select class="form-select" name="type" id="type">
                        <option value="monthly" <?php echo !isset($_GET['type']) || $_GET['type'] === 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                        <option value="yearly" <?php echo isset($_GET['type']) && $_GET['type'] === 'yearly' ? 'selected' : ''; ?>>Yearly</option>
                    </select>
                </form>
            </div>
        </div><!-- End Search Bar -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rating <span>(Total Rating: {{ $totalRating }})</span></h5>
                        @php
                            $count = 1;
                        @endphp
                        <table class="table" id="ratingTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><?php echo $_GET['type'] === 'monthly' ? 'Month' : 'Year'; ?></th>
                                    <th scope="col">Total Rating</th>
                                    <th scope="col">Average Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($averageRatings as $avg)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>
                                            @if ($_GET['type'] === 'monthly')
                                                {{ date('F', mktime(0, 0, 0, $avg->month, 1)) }}
                                            @else
                                                {{ $avg->year }}
                                            @endif
                                        </td>
                                        <td>{{ $avg->total_count }}</td>
                                        <td>{{ number_format(($avg->sum_rating / ($avg->total_count * 5)) * 100, 2) }}</td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#chatNav').removeClass('collapsed');
            $('#rating').addClass('active');
            $('#chat-nav').addClass('show');

            $('#ratingTable').DataTable({
                paging: false, // Disable pagination
                searching: false, // Disable search
                info: false // Disable information display
            });
        });

        const selectYear = document.getElementById('year');
        const typeSelect = document.getElementById('type');
        const ratingForm = document.getElementById('ratingForm');
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();

        // Set initial disable state based on selected type
        selectYear.disabled = (typeSelect.value === 'yearly');

        // Event listener for type change
        typeSelect.addEventListener('change', function() {
            const selectedType = typeSelect.value;

            // Update year select disable state based on selected type
            selectYear.disabled = (selectedType === 'yearly');

            // Set action based on selected type and year
            if (selectedType === 'monthly') {
                ratingForm.action = '/staffs/chats/rating/ratingScoreMonthly?type=monthly&year=' + currentYear;
            } else if (selectedType === 'yearly') {
                ratingForm.action = '/staffs/chats/rating/ratingScoreYearly';
            }

            ratingForm.submit(); // Submit the form with the updated action
        });

        // Event listener for year change
        selectYear.addEventListener('change', function() {
            ratingForm.submit(); // Submit the form when the year changes
        });
    </script>
@endsection
